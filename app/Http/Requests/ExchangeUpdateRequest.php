<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExchangeUpdateRequest extends FormRequest
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
            'spot_buy' => 'numeric',
            'spot_sell' => 'numeric',
        ];
    }

    public function message()
    {
        return [
            'currency' => '幣別',
            'spot_buy' => '即期買入',
            'spot_sell' => '即期賣出',
        ];
    }
}
