<?php

namespace App\Http\Requests;

use App\DTOs\TaskListRequestDto;
use Illuminate\Foundation\Http\FormRequest;

class TaskListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => ['string'],
            'category' => ['string', 'exists:categories,name'],
            'priority' => ['integer'],
        ];
    }

    public function dto(): TaskListRequestDto
    {
        return new TaskListRequestDto(
            status: $this->input('status'),
            category: $this->input('category'),
            priority: $this->input('priority'),
        );
    }
}
