<?php

namespace App\Http\Controllers\Auth;

use App\Repositories\UserRegisterRepository;
use App\Repositories\BasketRepository;
use App\Repositories\FavoriteRepository;
use App\Events\UserCreationRequestSent;
use App\Events\UserUpdateBasket;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests;
use Validator;
use Auth;
use Session;
use URL;
use Illuminate\Events\Dispatcher;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

/**
 * Class AuthController
 * @package App\Http\Controllers\Auth
 */
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * @var UserRegisterRepository
     */
    protected $user;

    /**
     * @var BasketRepository
     */
    protected $basket;

    /**
     * @var FavoriteRepository
     */
    protected $favorite;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(UserRegisterRepository $userRegisterRepository = null,
                                BasketRepository $basketRepository = null,
                                FavoriteRepository $favoriteRepository = null
    )
    {
        $this->user = $userRegisterRepository;
        $this->favorite = $favoriteRepository;
        $this->basket = $basketRepository;
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        Session::set('url', URL::previous());

        return view('auth.login');
    }

    /**
     * @param LoginUserRequest $request
     * @param Dispatcher $events
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function postLogin(LoginUserRequest $request, Dispatcher $events)
    {

        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

//        if (Auth::validate($credentials)) {
//            if (!$this->user->getByEmail($credentials['email'])->active) {
//                $user = $this->user->getByEmail($credentials['email']);
//                Auth::guard($this->getGuard())->login($user);
//
//                return redirect()->route('resend_verify_token')->with(['message' => 'activate your account']);
//            }
//        }

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            if ($throttles) {
                $this->clearLoginAttempts($request);
            }
            if (method_exists($this, 'authenticated')) {
                return $this->authenticated($request, Auth::guard($this->getGuard())->user());
            }
        }

        if ($throttles && !$lockedOut) {
            $this->incrementLoginAttempts($request);
        }
        $this->updateUserBasket();
        $this->updateFavorite();

        if (Session::has('url') && \Auth::user()) {
            return redirect()->intended(Session::get('url'))->with('message', 'Vati autentificat cu succes!');
        } else {
            return $this->sendFailedLoginResponse($request);
        }
    }

    /**
     * @param RegisterUserRequest $request
     * @param Dispatcher $events
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister(RegisterUserRequest $request, Dispatcher $events)
    {
        $user = $this->user->createSimpleUser($request->all());
        $events->fire(new UserCreationRequestSent($user));
        Auth::guard($this->getGuard())->login($user);
        $this->updateUserBasket();
        $this->updateFavorite();
        return redirect()->route('home')->with('message', 'Profilul a fost creat cu succes!');
    }

    /**
     *
     */
    public function updateUserBasket()
    {
        $placedItems = $this->basket->getByIpPublic();
        if (count($placedItems) > 0) {
            foreach ($placedItems as $item) {
                if (!$item->user_id) {
                    $item->fill([
                        'user_id' => Auth::user()->id
                    ])->save();
                }
            }
        }
    }

    /**
     *
     */
    public function updateFavorite()
    {
        $favoriteProduct = $this->favorite->getByIp();
        if (count($favoriteProduct) > 0) {
            foreach ($favoriteProduct as $item) {
                if (!$item->user_id) {
                    $item->fill([
                        'user_id' => \Auth::user()->id
                    ])->save();
                }
            }
        }
    }


}
