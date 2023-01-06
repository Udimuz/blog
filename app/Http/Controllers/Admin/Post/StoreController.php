<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class StoreController extends BaseController
{
	public function __invoke(StoreRequest $request) {
		$data = $request->validated();
		$this->service->store($data);
		return redirect()->route('admin.post.index');
	}

    public function __invoke_prev(StoreRequest $request) {
		try {
			//dd($request);
			$data = $request->validated();
			//dd($data);

			$tagIds = $data['tag_ids'];
			unset($data['tag_ids']);

			// 1 вариант - не законченный:
//		$previewImage = $data['preview_image'];
//		$mainImage = $data['main_image'];
//		$previewImagePath = Storage::put('/images', $previewImage);

			// 2 вариант:	Данные после обработки, снова помещаются в массив $data, чтобы проще это добавлять в базу, одним обращением firstOrCreate($data)
			$data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
			$data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);

			//$category = Category::firstOrCreate(['title'=>$data['title']], []);
			// Проверка что такая запись уже есть в базе. Если найдёт, то ничего делать не будет. Если не найдёт - добавит в базу.
//		Category::firstOrCreate(['title'=>$data['title']], [
//			'title'=>$data['title']
//		]);
			// Более оптимальный вариант:	Если все эти атрибуты уже есть в массиве $data, всё добавится автоматически
			$post = Post::firstOrCreate($data);
			$post->tags()->attach($tagIds);
		} catch (\Exception $exception) {
			abort(404);	// Прекратить выполнение
		}
		return redirect()->route('admin.post.index');
	}
}
