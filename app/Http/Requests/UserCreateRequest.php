<?php

namespace App\Http\Requests;

use App\DTOs\UserDTO;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                'max:254',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'min:8',
                'max:255',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ];
    }

    public function dto(): UserDTO
    {
        return new UserDTO(
            email: $this->input('email'),
            name: $this->input('name'),
            password: $this->input('password'),
            remember_token: $this->input('remember_token'),
        );
    }
}
