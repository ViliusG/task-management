<?php

namespace App\Http\Requests;

use App\DTOs\TaskDto;
use Illuminate\Foundation\Http\FormRequest;

class TaskUpsertRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['string'],
            'due_date' => ['date'],
            'status' => ['string'],
            'priority' => ['integer'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }

    public function dto(): TaskDto
    {
        return new TaskDto(
            id: $this->route('task')?->id,
            title: $this->input('title'),
            description: $this->input('description'),
            status: $this->input('status'),
            category_id: $this->input('category_id'),
            user_id: auth()->user()->id,
        );
    }
}
