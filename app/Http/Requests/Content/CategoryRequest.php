<?php

namespace App\Http\Requests\Content;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => ["required", "string", "max:50", "min:10"],
            "slug" => ["required", "string", "max:50", "min:5", "unique:categories,slug"],
            "description" => ["nullable", "string", "max:150", "min:20"],
            "is_active" => ["in:0,1", "numeric"]
        ];
    }
}
