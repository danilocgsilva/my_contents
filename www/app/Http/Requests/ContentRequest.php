<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Domain\MetaData;

class ContentRequest extends FormRequest
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
            'metadatas' => 'required|array|min:1',
            'metadatas.*.name' => 'required|string',
            'metadatas.*.value' => 'required|string',
        ];
    }

    /**
     * Summary of getMetaDatas
     * @return MetaData[]
     */
    public function getMetaDatas(): array
    {
        $metadatas = [];
        foreach ($this->metadatas as $requestMetadata) {
            $value = null;
            if (filter_var($requestMetadata['value'], FILTER_VALIDATE_INT)) {
                $value = (int) $requestMetadata['value'];
            } else {
                $value = $requestMetadata['value'];
            }
            $metadatas[] = new MetaData($requestMetadata['name'], $value);
        }

        return $metadatas;
    }
}
