<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use App\Enums\Role;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserUpdateRequest extends FormRequest
{
     /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255', 'required'],
            'email' => ['email', 'max:255', 'required', Rule::unique(User::class)->ignore($this->user()->id)],
            'password' => ['nullable','string', Password::defaults()],
            'role' => ['required',Rule::enum(Role::class)],
            'photo' => ['nullable', 'max:3072'],
            'birth_date' => ['date', 'required'],
            'document_cpf'=> ['string'],
            'gender' => [Rule::enum(Gender::class)],
            'cellphone' => ['min:8','string','required'],
            'emergency_name' => ['string', 'max:255', 'nullable'],
            'emergency_cellphone' => ['min:8','string','nullable'],
            'zip_code' => 'nullable',
            'street' => 'nullable',
            'neighborhood' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'number' => 'nullable',
            'complement' => 'nullable',

             //children validations
             'childrens.*.id' => 'nullable',
             'childrens.*.name' => 'nullable|string|max:255',
             'childrens.*.birth_date' => 'nullable|date',
             'childrens.*.document' => 'nullable|string|max:255|unique:childrens,document',
             'childrens.*.gender' => 'nullable|in:masculino,feminino',
             'childrens.*.status' => 'nullable|boolean',
             'childrens.*.photo' => 'nullable|string',
             'childrens.*.user_id' => 'nullable|exists:users,id',
        ];
    }
}
