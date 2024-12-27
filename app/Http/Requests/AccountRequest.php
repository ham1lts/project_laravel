<?php
/**
 * Copyright © Freire H. All rights reserved.
 */

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class AccountRequest extends FormRequest
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
        return [
            "numero_conta" => "required|numeric",
            "saldo" => "required|numeric",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException (
            response()->json([
                'success' => false,
                'errors' => $validator->errors()->first(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
