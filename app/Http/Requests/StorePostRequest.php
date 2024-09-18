<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'description' => ['string', 'max:5000', 'required'],
            'photo' => ['nullable', 'max:3072'],
            'user_id' => ['required', 'exists:users,id'],
            'classe_id' => ['required', 'exists:classes,id']
        ];
    }
}
