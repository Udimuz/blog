<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke() {
		//dd(2222);
		return view('admin.categories.create');
	}
}
