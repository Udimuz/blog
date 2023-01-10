<?php
if (! function_exists('userInfo')) {
	function userInfo() {
		// Вместо:	@php echo auth()->user()->name; @endphp
		$user = auth()->user();		//dd($user);
		return !empty($user) ? $user->id." - ".$user->name : "-|-";
	}
}