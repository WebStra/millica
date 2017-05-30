<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRegisterRepository;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Mail;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $user;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct(UserRegisterRepository $userRegisterRepository)
    {
        $this->middleware('guest');
        $this->user = $userRegisterRepository;
    }

    public function restorePassGet()
    {

        return view('auth.passwords.email');
    }

    public function restorePassPost(Request $request)
    {

        $email = $request->email;
        $getUser = $this->user->getByEmail($email);
        $this->sendPasswordEmail($getUser);

        return view('auth.passwords.email')->withStatus('Emailul a fost trimis');
    }

    public function sendPasswordEmail($user)
    {
        \Mail::send('emails.password', compact('user'), function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Password link restore!');
        });

    }

    public function resetPassword(Request $request)
    {
        $code = $request->confirmation_code;

        return view('auth.passwords.reset', compact('code'));
    }

    public function changePassword(Request $request)
    {
        $this->user->updatePassword($request);

        return redirect()->route('get_login');
    }

}
