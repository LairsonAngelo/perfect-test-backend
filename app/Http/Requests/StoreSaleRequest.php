<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'cpf' => 'required',
            'product_id' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'discount' => 'required',
            'status' => 'required',
        ];
    }


       /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.required' => 'Campo obrigatório',
            '*.max' => 'Excedeu a quantidade máxima de caracteres',
            '*.min' => 'Poucos caracteres',
        ];
    }
}
