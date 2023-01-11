<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke() {
		// Пока сделаем перекидывание с главной страницы на страницу с постами:
		return redirect()->route('post.index');
	}
}
