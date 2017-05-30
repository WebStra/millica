<?php

namespace App\Http\Requests;

class PasswordRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->getRules();
    }

    static public function getRules()
    {
        $hashed_password = \Auth::user()->password ;

        return [
            'old_password' => "old_password:$hashed_password|string|min:6",
            'password' => 'required|min:6|confirmed',
        ];
    }
}