<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;

class IndexController extends Controller
{
    public function __invoke() {
		$categories = Category::all();
		//dd(2222);
		return view('admin.category.index', compact('categories'));
	}
}
