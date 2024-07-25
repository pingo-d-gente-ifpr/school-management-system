<?php

namespace App\Http\Requests;

use App\Enums\Period;
use App\Enums\Stage;
use Illuminate\Foundation\Http\FormRequest;

class StoreClasseRequest extends FormRequest
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
            'name' => ['string', 'max:255', 'required'],
            'photo' => ['nullable', 'max:3072'],
            'period' => ['required', Period::cases()],
            'stage' => ['required', Stage::cases()],
        ];
    }
}
