<?php
namespace App\Http\Controllers;
use App\Http\Requests\ContactsRequest;
use App\Contacts;
use Mail;

/**
 * Class ContactsController
 * @package App\Http\Controllers
 */
class ContactsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('contacts.index');
    }

    /**
     * @param ContactsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestData(ContactsRequest $request){

        Contacts::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->body,
        ]);

        return redirect()->back();
    }

    public function sendOnEmail(){

    }

}