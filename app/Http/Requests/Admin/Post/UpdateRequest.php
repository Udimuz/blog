<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        return [
//            'title' => 'required|string',
//            'content' => 'required|string'
			'title' => 'string',	// 'required|string'
			'content' => 'string',
			'main_image' => 'nullable|file',	// отмечаем nullable - потому что картинка может не прийти, значит, менять не хотели, оставится картинка старая
			'preview_image' => 'nullable|file',
			'category_id' => 'required|integer|exists:categories,id',
			'tag_ids' => 'nullable|array',
			'tag_ids.*' => 'nullable|integer|exists:tags,id',
        ];
    }

	// Для каждого атрибута (проверки) можно придумать свои правила-уведомления: Что мы хотим донести до пользователя, необходимые технические требования
	public function messages()
	{
		return [
			'title.string' => 'Данные должны соответствовать строчному типу',
			'content.string' => 'Данные должны соответствовать строчному типу',
			'main_image.required' => 'Это поле необходимо для заполнения',
			'main_image.file' => 'Необходимо выбрать файл',
			'preview_image.required' => 'Это поле необходимо для заполнения',
			'preview_image.file' => 'Необходимо выбрать файл',
			'category_id.integer' => 'ID категории должно быть числом',
			'category_id.exists' => 'ID категории должно быть в базе данных',
			'tag_ids.array' => 'Необходимо отправить массив данных',
		];
	}
}
