<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory;


class FileUploadRequest extends FormRequest
{

    public function __construct(Factory $validationFactory)
    {
        // Mimes is not working for large json files so created a custom validation rule
        $validationFactory->extend(
            'is_json',
            function ($attribute, $value, $parameters) {
                return 'json' === $value->getClientOriginalExtension();
            },
            'The :attribute must be a JSON file.'
        );
    }
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
            'file' => 'required|file|is_json'
        ];
    }

}
