<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
		// ! 04.01.2023 заметил, если в параметр включить значение 'string' то оно тоже становится обязательным для заполнения. Словно поставлено "required". Мучался полчаса, не мог понять, почему меня обратно на прошлую страницу перекидывает.
		return [
			'title' => 'string',	// 'required|string'
			'content' => 'string',
			'main_image' => 'required|file',
			'preview_image' => 'required|file',
			'category_id' => 'required|integer|exists:categories,id',
			'tag_ids' => 'nullable|array',
			'tag_ids.*' => 'nullable|integer|exists:tags,id',
		];
    }
}
