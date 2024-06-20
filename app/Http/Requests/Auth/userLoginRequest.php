<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class userLoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'    => ['required', 'string', 'email:dns'],
            'password' => ['required', 'string'],
        ];
    }


    public function messages()
    {
        return [
            'email.required'    => __('名前を入力してください。'),
            'email.string'      => __('名前を入力してください。'),
            'email.email'       => __('名前を入力してください。'),
            'email.min'         => __('名前を入力してください。'),
            'password.required' => __('パスワードを入力してください。'),
            // 'password.regex'    => config('validation.regex'),
            // 'password.min'      => config('validation.min'),
            // 'password.max'      => config('validation.max'),
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Eメールアドレスの送信に失敗しました。',
            'errors'  => $validator->errors()
        ], 422));
    }
}
