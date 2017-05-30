<?php
namespace App\Http\Controllers;

use App\Repositories\SubscribeRepository;
use Mail;
use Illuminate\Http\Request;
use Validator;

/**
 * Class ContactController
 * @package App\Http\Controllers
 */
class SubscribeController extends Controller
{
    /**
     * @var SubscribeRepository
     */
    protected $subscribe;

    /**
     * ContactController constructor.
     * @param SubscribeRepository $subscribeRepository
     */
    public function __construct(SubscribeRepository $subscribeRepository)
    {
        $this->subscribe = $subscribeRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribe(Request $request)
    {
        $email = $this->subscribe->findEmail($request->email);

        if ($email) {
            if ($email->active) {
                return response()->json(['subscribed' => 'subscribed']);
            } else {
                $email->fill([
                    'active' => (int)true
                ])->save();
                $this->sendEmail($request->all());

                return response()->json(['succes' => 'succes']);
            }

        } else {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:subscribers',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => 'error']);
            } else {
                $this->subscribe->addSubscriber($request);
                $this->sendEmail($request->all());

                return response()->json(['succes' => 'succes']);
            }
        }
    }

    /**
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unsuscribe($token)
    {
        $this->subscribe->unsuscribe($token);

        return redirect()->route('home')->with(['message' => 'You Have succesful Unsubscribed']);
    }

    /**
     * @param $request
     */
    public function sendEmail($request)
    {
        \Mail::send('emails.subscribe', $request, function ($message) use ($request) {
            $message->to($request['email']);
            $message->subject('You are Subscribed Succesful!');
        });

    }
}