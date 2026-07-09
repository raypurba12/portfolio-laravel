<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'project_category_id' => ['nullable', 'exists:project_categories,id'],
            'description' => ['nullable', 'string'],
            'technology_stack' => ['nullable', 'string'],
            'github_url' => ['nullable', 'url'],
            'live_demo_url' => ['nullable', 'url'],
            'video_url' => ['nullable', 'url'],
            'client' => ['nullable', 'string', 'max:255'],
            'date' => ['nullable', 'date'],
            'status' => ['required', 'in:draft,published'],
            'featured' => ['boolean'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
        ];
    }
}
