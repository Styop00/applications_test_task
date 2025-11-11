<?php

namespace App\Http\Requests\Application;

use App\Http\Requests\BaseRequest;

class CreateApplicationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'status_id'   => 'required|integer|exists:statuses,id',
            'city_id'     => 'required|integer|exists:cities,id',
        ];
    }
}
