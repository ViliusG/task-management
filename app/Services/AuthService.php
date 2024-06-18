<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    public function __construct(
        public UserRepository $userRepository
    ){
    }
    public function createUser(UserDTO $userDTO): UserDTO
    {
        return $this->userRepository->create($userDTO);
    }

    /**
     * @throws Exception
     * @throws ModelNotFoundException
     */
    public function getAuthToken(UserDTO $userDTO): string
    {
        $user = $this->userRepository->findUserByEmailOrFail($userDTO->email);

        if (!Hash::check($userDTO->password, $user->password)) {
            throw new \Exception('The provided credentials are incorrect.', Response::HTTP_UNAUTHORIZED);
        }

        return $user->createToken('auth-token')->plainTextToken;
    }
}
