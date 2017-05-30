<?php

namespace App\Http\Requests;


class ComandRequest extends Request
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
            'deliveryname' => 'required',
            'deliveryphone' => 'required',
            'deliveryadress' => 'required',
            'deliveryjudet' => 'required',
            'deliveryjlocation' => 'required',
            'facturarename' => 'required',
            'facturarephone' => 'required',
            'facturareadress' => 'required',
            'facturarejudet' => 'required',
            'facturarelocation' => 'required',
            'cnp' => 'required|digits:13',
            'confirm' => 'required',
        ];
    }
}