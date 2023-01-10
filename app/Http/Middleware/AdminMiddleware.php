<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
		//dd(auth()->user()->name);
		// dd((int) auth()->user()->role);	//dd(auth()->user()->role);	//	http://blog/admin	http://blog/admin/posts
		// Хелпер auth() возвращает пользователя:
		// Из базы вытягивает пользователя который в данный момент заходит на сайт
		// Нужно подключить приведение типов (int) потому что из базы могут браться данные типа String. Хотя, у меня и без этого работало, в базе у меня тип Integer
		if ((int) auth()->user()->role !== User::ROLE_ADMIN) // 0 - admin
			abort(403);
		// Здесь такой недостаток обнаружился:	при создании колонки "role" не было задано значение по умолчанию. И если человека регистрировать на другой странице, там сохранится значение "NULL".
		// А с приведение типов (int) это значение превращается в 0 - и такой пользователь определяется как Админ.

        return $next($request);
    }
}
