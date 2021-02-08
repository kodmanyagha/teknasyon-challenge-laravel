<?php

namespace App\Requests\MockPurchaseCheck;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionCheckRequest extends FormRequest
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
            'receipt' => 'required|string|min:3|max:255',
        ];
    }
}


