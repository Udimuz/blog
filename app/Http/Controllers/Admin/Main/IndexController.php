<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke() {
		//return 111;
		//$user = auth()->user();

		$users = User::all();
		$posts = Post::all();
		$categories = Category::all();
		$tags = Tag::all();

		$data = [
			'usersCount' => User::all()->count(),
			'postsCount' => Post::all()->count(),
			'categoriesCount' => Category::all()->count(),
			'tagsCount' => Tag::all()->count(),
		];

		return view('admin.main.index', compact('data'));
	}
}
