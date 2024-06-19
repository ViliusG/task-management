<?php

namespace App\DTOs;

readonly class TaskDto
{
    public function __construct(
        public ?int $id,
        public string $title,
        public ?string $description,
        public ?string $status,
        public int $category_id,
        public ?int $user_id,
    ) {
    }
}
