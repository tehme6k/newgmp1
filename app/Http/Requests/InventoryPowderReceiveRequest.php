<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryPowderReceiveRequest extends FormRequest
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
        return [
            'product_id' => 'required',
            'amount' => 'required',
            'unit' => 'required',
            'file' => 'mimes:pdf|max:10000',
            'lot' => 'required',
            'expiration_date' => 'required'
        ];
    }
}
