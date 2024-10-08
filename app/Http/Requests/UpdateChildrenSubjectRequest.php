<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChildrenSubjectRequest extends FormRequest
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
            'children_id' => 'required|exists:childrens,id', 
            'classe_subject_id' => 'required|exists:classe_subject,id', 
            'score1.*.*' => 'nullable|numeric|min:0|max:10', 
            'score2.*.*' => 'nullable|numeric|min:0|max:10', 
            'score3.*.*' => 'nullable|numeric|min:0|max:10', 
            'score4.*.*' => 'nullable|numeric|min:0|max:10', 
        ];
    }
}
