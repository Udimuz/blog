<?php

namespace App\Service;

use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
	public function store($data) {
		try {
			Db::beginTransaction();
			if (isset($data['tag_ids'])) {
				$tagIds = $data['tag_ids'];
				unset($data['tag_ids']); }
			$data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
			$data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
			$post = Post::firstOrCreate($data);
			if (isset($data['tag_ids']))
				$post->tags()->attach($tagIds);
			Db::commit();
		} catch (Exception $exception) {
			Db::rollBack();
			abort(500);	// Лучше выдавать ошибку 500, говорящую что это нарушение на стороне сервера, во время работы. А ошибка 404 - это Страница не найдена
		}
	}

	public function update($data, $post) {
		try {
			Db::beginTransaction();
			if (isset($data['tag_ids'])) {
				$tagIds = $data['tag_ids'];
				unset($data['tag_ids']);
			}

			// Если я не выбирал картинку для изменения, у меня вылетала ошибка. Потому что не приходили параметры $data['main_image', 'preview_image']. Сам поставил такие проверки:
			if (isset($data['main_image']))
				$data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
			if (isset($data['preview_image']))
				$data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
			// Данные после обработки, снова помещаются в массив $data, чтобы проще это добавлять в базу, одним обращением update($data)

			$post->update($data);

			if (isset($data['tag_ids'])) {
				// Здесь, вместо "attach()" используем метод "sync()", который удаляет абсолютно все привязки у поста с тегами, и добавляет только те, которые мы указали в $tagIds
				$post->tags()->sync($tagIds);
			}
			Db::commit();
		} catch (\Exception $exception) {
			Db::rollBack();
			abort(500);	// Прекратить выполнение
		}
		return $post;
	}

}