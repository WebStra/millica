<?php
namespace App\Http\Controllers;

use Auth;
use App\Repositories\SettingsRepository;
use App\Repositories\ComandRepository;
use App\Repositories\ProductComandRepository;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;

/**
 * Class SettingsController
 * @package App\Http\Controllers
 */
class SettingsController extends Controller
{

    /**
     * @var SettingsRepository
     */
    protected $profile;

    /**
     * @var ComandRepository
     */
    protected $comand;

    /**
     * @var ProductComandRepository
     */
    protected $comandproduct;

    /**
     * SettingsController constructor.
     * @param SettingsRepository $settingsRepository
     */
    public function __construct(SettingsRepository $settingsRepository,
                                ComandRepository $comandRepository,
                                ProductComandRepository $productComandRepository
    )
    {
        $this->profile = $settingsRepository;
        $this->comand = $comandRepository;
        $this->comandproduct = $productComandRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profileData()
    {
        return view('auth.settings.partials.profile', ['cityes' => $this->sortCity(), 'location' => $this->sortLocation()]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profilePassword()
    {
        return view('auth.settings.partials.password');
    }

    /**
     * @param ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(ProfileRequest $request)
    {
        $this->profile->updateProfile($request->all());

        return redirect()->back()->with(['message' => 'Datele au fost modificate cu succes!']);
    }

    /**
     * @param PasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(PasswordRequest $request)
    {
        $this->profile->updatePassword($request->password);

        return redirect()->back()->with(['message' => 'Parola a fost modificata cu succes!']);

    }

    /**
     * @return array
     */
    public function sortCity()
    {
        $request = \FanCourier::city();
        $sorted = [];
        foreach ($request as $city) {
            $cityes = $city->judet;
            if (isset($sorted[$cityes])) {
                $sorted[$cityes] = $city->judet;
            } else {
                $sorted[$cityes] = $city->judet;
            }
        }
        return array_values($sorted);
    }

    /**
     * @return array
     */
    public function sortLocation()
    {
        $locations = \FanCourier::city(['judet' => \Auth::user()->judet, 'language' => 'RO']);
        $sorted = [];
        foreach ($locations as $location) {
            $sorted[] = $location->localitate;
        }

        return $this->renderLocation($sorted);
    }


    /**
     * @param $sortedLocation
     * @return mixed
     */
    public function renderLocation($sortedLocation)
    {
        $returnHTML = view('render.location')->with('locations', $sortedLocation)->render();
        return $returnHTML;
    }

    /**
     * @return mixed
     */
    public function commandUser() {

        $command = $this->comand->getByUser();

        return view('auth.settings.partials.command',['comand'=>$command]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function singleComand($id)
    {
        $command = $this->comand->getByConfirmCodeAdmin($id);

        $basketProducts = $this->comandproduct->getByComandId($command->id);

        ($this->comandproduct->sumProductPrice($command->id)) ? $sumPriceProducts = $this->comandproduct->sumProductPrice($command->id) : $sumPriceProducts = '0';

        if ($sumPriceProducts > 200) {
            $price = $sumPriceProducts;
        } else {
            $price = $sumPriceProducts + 15;
        }

        return view('auth.settings.partials.single-command',['comand'=>$command,'basketProducts'=>$basketProducts, 'sumPriceProducts'=>$sumPriceProducts]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function cancelComand($id) {
       $comand =  $this->comand->getByConfirmCode($id);

        $query = $comand->fill([
           'active'=> 0
        ]);

        $query->save();

        return redirect()->back();
    }

}