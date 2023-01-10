<?php

namespace App\Http\Controllers\Personal\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostUserLike;
use App\Models\Tag;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke() {
		//return 111;
		//$user = auth()->user();
		//return view('personal.main.index');

		$data = [
			'postLikesCount' => PostUserLike::all()->count(),
			'commentsCount' => auth()->user()->comments->count(),
		];

		return view('personal.main.index', compact('data'));
	}
}
