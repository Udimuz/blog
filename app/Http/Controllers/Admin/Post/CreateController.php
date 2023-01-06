<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;

class CreateController extends BaseController
{
    public function __invoke() {
		//dd('-Create-');
		$categories = Category::all();
		$tags = Tag::all();
		return view('admin.post.create', compact('categories', 'tags'));
	}
}
