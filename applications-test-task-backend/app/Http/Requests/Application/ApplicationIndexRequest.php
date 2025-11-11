<?php

namespace App\Http\Requests\Application;

use App\Http\Requests\BaseRequest;

class ApplicationIndexRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'page'      => 'required|integer|min:1',
        ];
    }
}
