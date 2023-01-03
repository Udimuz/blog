<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke() {
		//return 111;
		return view('admin.main.index');
	}
}
