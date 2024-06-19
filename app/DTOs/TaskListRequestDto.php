<?php

namespace App\DTOs;

readonly class TaskListRequestDto
{
    public function __construct(
        public ?string $status = null,
        public ?string $category = null,
        public ?int $priority = null,
    ) {
    }
}
