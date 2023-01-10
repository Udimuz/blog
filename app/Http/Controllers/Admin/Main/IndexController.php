<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke() {
		//return 111;
		$user = auth()->user();
		return view('admin.main.index', compact('user'));
	}
}
