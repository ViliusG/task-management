<?php

namespace App\Http\Requests;

use App\DTOs\UserDTO;
use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required'],
        ];
    }

    public function dto(): UserDTO
    {
        return new UserDTO(
            email: $this->input('email'),
            password: $this->input('password'),
        );
    }
}
