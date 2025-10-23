<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'instrument_id'=>['required','exists:instruments,id'],
            'side' => ['required','in:buy,sell'],
            'type' => ['required','in:limit,market'],
            'qty'  => ['required','integer','min:1'],
            'price'=> ['nullable','numeric','min:0', function($attr,$value,$fail){
                if($this->type==='limit' && is_null($value)) $fail('Limit order requires price.');
                if($this->type==='market' && !is_null($value)) $fail('Market order price must be null.');
            }],
        ];
    }
}
