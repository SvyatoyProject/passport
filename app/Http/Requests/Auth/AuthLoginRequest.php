<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * @OA\Schema()
 */
class AuthLoginRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      property="email",
     *      type="string",
     *      example="typical@email.com"
     * ),
     *
     * @OA\Property(
     *      property="password",
     *      type="string",
     *      example="Qwerty!12345"
     * ),
     *
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $password = Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised();

        return [
            'email' => ['required', 'email', Rule::exists(User::class, 'email')],
            'password' => ['required', 'string', $password]
        ];
    }
}
