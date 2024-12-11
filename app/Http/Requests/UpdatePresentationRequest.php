<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePresentationRequest extends FormRequest
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
        $presentation = $this->route('presentation');
        $featureId = $presentation->feature->id;

        return [
            'name' => 'required|max:60|unique:features,name,' . $featureId,
            'description' => 'nullable|string|max:255',
        ];

    }
}
