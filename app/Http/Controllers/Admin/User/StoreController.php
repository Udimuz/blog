<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StoreController extends Controller
{
	// Для проверки завёл пользователя с параметрами	user:123123
    public function __invoke(StoreRequest $request) {
		$data = $request->validated();

		try {
			Db::beginTransaction();
			$password = Str::random(6);	// Создание случайного пароля из 10 символов длиной

			$data['password'] = Hash::make($password);	// Переназначаем данные, зашифровав полученные данные
			$user = User::firstOrCreate(['email' => $data['email']], $data);	// Проверять наличие по email-адресу, так как он в базе уникальный (ключ users_email_unique)

			//dd($data['email']);

			//dd(new PasswordMail($password));
			// с помощью методов фасада Mail отправляем новый объект класса PasswordMail передав в его конструктор сгенерированный пароль
			Mail::to($data['email'])->send(new PasswordMail($data['name'], $password));

			// Запуск сценария связанный с тем, что мы только что зарегистрировали пользователя:	который принимает аргумент который должен быть обязательно Моделью
			// Это нужно чтобы после регистрации у нас было отправлено письмо на почту которая у данного пользователя
			event(new Registered($user));

			Db::commit();
		} catch (\Exception $exception) {
			Db::rollBack();
			abort(500);	// Прекратить выполнение
		}

		return redirect()->route('admin.user.index');
	}


    public function __invoke_prev(StoreRequest $request) {
		$data = $request->validated();
		$data['password'] = Hash::make($data['password']);	// Переназначаем данные, зашифровав полученные данные
		User::firstOrCreate(['email' => $data['email']], $data);	// Проверять наличие по email-адресу, так как он в базе уникальный (ключ users_email_unique)
		return redirect()->route('admin.user.index');
	}
}
