<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Models\Category;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request) {
		$data = $request->validated();
		//dd($data);
		//$category = Category::firstOrCreate(['title'=>$data['title']], []);
		// Проверка что такая запись уже есть в базе. Если найдёт, то ничего делать не будет. Если не найдёт - добавит в базу.
//		Category::firstOrCreate(['title'=>$data['title']], [
//			'title'=>$data['title']
//		]);
		// Более оптимальный вариант:
		Category::firstOrCreate($data);
		return redirect()->route('admin.category.index');
		//return view('admin.categories.index');
	}
}
