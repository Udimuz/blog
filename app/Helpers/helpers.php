<?php

use App\Models\User;

if (! function_exists('userInfo')) {
	function userInfo() {
		// Вместо:	@php echo auth()->user()->name; @endphp
		$user = auth()->user();		//dd($user);
		return !empty($user) ? $user->id." - ".$user->name.
			(((int) auth()->user()->role === User::ROLE_ADMIN) ? " (Admin)" : " (Reader)")
			: "-|-";
	}
}