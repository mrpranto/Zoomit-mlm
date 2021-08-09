<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        switch (strtolower($this->method())) {
            case 'post':
                return $this->createRules();
            case 'patch':
            case 'put':
                return $this->updateRules();
            default:
                return [];
        }
    }
}
