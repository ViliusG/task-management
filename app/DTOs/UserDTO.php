<?php

namespace App\DTOs;

readonly class UserDTO
{
    public function __construct(
        public string $email,
        public ?string $name = null,
        public ?string $password = null,
        public ?int $id = null,
        public ?string $remember_token = null,
        public ?string $created_at = null,
        public ?string $updated_at = null,
    ) {
    }
}
