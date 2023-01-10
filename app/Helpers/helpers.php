<?php
if (! function_exists('userInfo')) {
	function userInfo() {
		// Вместо:	@php echo auth()->user()->name; @endphp
		return auth()->user()->name;
	}
}