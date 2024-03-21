<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use App\Enums\Role;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255', 'required'],
            'email' => ['email', 'max:255', 'required', 'unique:App\Models\User,email'],
            'password' => ['string', 'required'],
            'role' => ['required',Rule::enum(Role::class)],
            'photo' => ['nullable', 'max:3072'],
            'birth_date' => ['date', 'required'],
            'document_cpf'=> ['size:11','string','numeric'],
            'gender' => [Rule::enum(Gender::class)],
            'cellphone' => ['min:8','string','required'],
            'emergency_name' => ['string', 'max:255', 'nullable'],
            'emergency_cellphone' => ['min:8','string','nullable'],
        ];
    }
}
