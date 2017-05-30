<?php

namespace App\Http\Requests;


class ProfileRequest extends Request
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

     public function getRules()

    {
        return [
            'firstname' => 'required|max:16|min:3',
            'lastname' => 'required|max:20|min:3',
            'email' => 'required|email|max:255',
        ];
    }
}