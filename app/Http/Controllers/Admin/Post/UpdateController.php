<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class UpdateController extends BaseController
{
	public function __invoke(UpdateRequest $request, Post $post) {
		$data = $request->validated();
		$post = $this->service->update($data, $post);
		return view('admin.post.show', compact('post'));
	}

	public function __invoke_prev(UpdateRequest $request, Post $post) {
		try {
			$data = $request->validated();
			//dd($data);

			$tagIds = $data['tag_ids'];
			unset($data['tag_ids']);

			// Если я не выбирал картинку для изменения, у меня вылетала ошибка. Потому что не приходили параметры $data['main_image', 'preview_image']. Сам поставил такие проверки:
			if (isset($data['main_image']))
				$data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
			if (isset($data['preview_image']))
				$data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
			// Данные после обработки, снова помещаются в массив $data, чтобы проще это добавлять в базу, одним обращением update($data)

			$post->update($data);

			// Здесь, вместо "attach()" используем метод "sync()", который удаляет абсолютно все привязки у поста с тегами, и добавляет только те, которые мы указали в $tagIds
			$post->tags()->sync($tagIds);
		} catch (\Exception $exception) {
			abort(404);	// Прекратить выполнение
		}

		return view('admin.post.show', compact('post'));
	}
}
