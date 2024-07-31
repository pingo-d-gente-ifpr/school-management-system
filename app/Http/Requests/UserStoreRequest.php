<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use App\Enums\Role;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

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
            'password' => ['string', 'required', Password::defaults()],
            'role' => ['required',Rule::enum(Role::class)],
            'photo' => ['nullable', 'max:3072'],
            'birth_date' => ['date', 'required'],
            'document_cpf'=> ['string'],
            'gender' => [Rule::enum(Gender::class)],
            'cellphone' => ['min:8','string','required'],
            'emergency_name' => ['string', 'max:255', 'nullable'],
            'emergency_cellphone' => ['min:8','string','nullable'],

            //children validations
            'childrens.*.name' => 'nullable|string|max:255',
            'childrens.*.birth_date' => 'nullable|date',
            'childrens.*.document' => 'nullable|string|max:255|unique:childrens,document',
            'childrens.*.gender' => 'nullable|in:masculino,feminino',
            'childrens.*.status' => 'nullable|boolean',
            'childrens.*.register_number' => 'nullable|string|max:255',
            'childrens.*.photo' => 'nullable|string',
            'childrens.*.user_id' => 'nullable|exists:users,id',
        ];
    }
}
