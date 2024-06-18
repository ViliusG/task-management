<?php

namespace App\Repositories;

use App\DTOs\UserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository
{
    public function create(UserDTO $userDTO): UserDto
    {
        $user = User::create([
            'name' => $userDTO->name,
            'email' => $userDTO->email,
            'password' => $userDTO->password,
            'remember_token' => $userDTO->remember_token,
        ]);

        return new UserDTO(
            email: $user->email,
            name: $user->name,
            id: $user->id,
            created_at: $user->created_at,
            updated_at: $user->updated_at,
        );
    }

    /**
     * @throws ModelNotFoundException
     */
    public function findUserByEmailOrFail(string $email): User
    {
        return User::where('email', $email)
            ->firstOrFail();
    }
}
