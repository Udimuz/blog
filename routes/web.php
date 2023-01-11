<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return '12345';	//view('welcome');
//});

// Корневая папка сайта:
Route::group(['namespace'=>'App\Http\Controllers\Main'], function(){
	Route::get('/', 'IndexController')->name('main.index');
});

Route::group(['namespace'=>'App\Http\Controllers\Post', 'prefix'=>'posts'], function(){
	Route::get('/', 'IndexController')->name('post.index');
	Route::get('/{post}', 'ShowController')->name('post.show');
});

// Админ-часть сайта:
// prefix добавит везде к ссылке впереди адрес "/admin/". Это чтобы не создавать такие роуты '/admin/post', '/admin/add', а сократить
Route::group(['namespace'=>'App\Http\Controllers\Admin', 'prefix'=>'admin', 'middleware'=>['auth','admin','verified']], function() {
	Route::group(['namespace'=>'Main'], function(){
		// Для запуска страницы по адресу "/admin/":
		Route::get('/', 'IndexController')->name('admin.main.index');
		// Это автоматически перекидывает в Вид:	'resources/views/admin/main/index.blade.php'
		// потому что так указано в контроллере IndexController
	});
	// Добавляется prefix:
	Route::group(['namespace'=>'Category', 'prefix'=>'categories'], function(){
		// Для запуска страницы по адресу "/admin/categories":
		Route::get('/', 'IndexController')->name('admin.category.index');
		//Route::get('/create', 'CreateController')->name('admin.category.create');
		// Попробовал создать ту же сборку роута только в стиле Ларавел 9:
		Route::get('/create', [App\Http\Controllers\Admin\Category\CreateController::class, '__invoke'])->name('admin.category.create');
		Route::post('/', 'StoreController')->name('admin.category.store');
		Route::get('/{category}', 'ShowController')->name('admin.category.show');
		Route::get('/{category}/edit', 'EditController')->name('admin.category.edit');
		Route::patch('/{category}', 'UpdateController')->name('admin.category.update');
		Route::delete('/{category}', 'DeleteController')->name('admin.category.delete');
		//Route::get('/', function() { return "Route work"; });
	});

	Route::group(['namespace'=>'Post', 'prefix'=>'posts'], function(){
		// Для запуска страницы по адресу "/admin/posts":
		Route::get('/', 'IndexController')->name('admin.post.index');
		Route::get('/create', 'CreateController')->name('admin.post.create');
		//Route::get('/create', function() { return "-2check2-"; })->name('admin.post.create');
		// Здесь стояло перенаправление на '/', но я решил указать '/store' чтобы точнее видеть. А то со страницей создания путал
		Route::post('/store', 'StoreController')->name('admin.post.store');
		//Route::post('/', function() { return "-check-"; });
		Route::get('/{post}', 'ShowController')->name('admin.post.show');
		Route::get('/{post}/edit', 'EditController')->name('admin.post.edit');
		Route::patch('/{post}', 'UpdateController')->name('admin.post.update');
		Route::delete('/{post}', 'DeleteController')->name('admin.post.delete');
	});

	Route::group(['namespace'=>'Tag', 'prefix'=>'tags'], function(){
		// Для запуска страницы по адресу "/admin/tags/":
		Route::get('/', 'IndexController')->name('admin.tag.index');
		Route::get('/create', 'CreateController')->name('admin.tag.create');
		Route::post('/', 'StoreController')->name('admin.tag.store');
		Route::get('/{tag}', 'ShowController')->name('admin.tag.show');
		Route::get('/{tag}/edit', 'EditController')->name('admin.tag.edit');
		Route::patch('/{tag}', 'UpdateController')->name('admin.tag.update');
		Route::delete('/{tag}', 'DeleteController')->name('admin.tag.delete');
		//Route::get('/', function() { return "Route work"; });
	});

	Route::group(['namespace'=>'User', 'prefix'=>'users'], function(){
		// Для запуска страницы по адресу "/admin/users/":
		Route::get('/', 'IndexController')->name('admin.user.index');
		Route::get('/create', 'CreateController')->name('admin.user.create');
		Route::post('/', 'StoreController')->name('admin.user.store');
		Route::get('/{user}', 'ShowController')->name('admin.user.show');
		Route::get('/{user}/edit', 'EditController')->name('admin.user.edit');
		Route::patch('/{user}', 'UpdateController')->name('admin.user.update');
		Route::delete('/{user}', 'DeleteController')->name('admin.user.delete');
	});

});


// Кабинет пользователя:
Route::group(['namespace'=>'App\Http\Controllers\Personal', 'prefix'=>'personal', 'middleware'=>['auth','verified']], function() {
	// Для запуска страницы по адресу "/personal/main":
	Route::group(['namespace'=>'Main', 'prefix'=>'main'], function(){
		Route::get('/', 'IndexController')->name('personal.main.index');
	});
	// Для страницы по адресу "/personal/liked":
	Route::group(['namespace'=>'Liked', 'prefix'=>'liked'], function(){
		Route::get('/', 'IndexController')->name('personal.liked.index');
		Route::delete('/{post}', 'DeleteController')->name('personal.liked.delete');
	});
	// Для страницы по адресу "/personal/comments":
	Route::group(['namespace'=>'Comment', 'prefix'=>'comments'], function(){
		Route::get('/', 'IndexController')->name('personal.comment.index');
		Route::get('/{comment}/edit', 'EditController')->name('personal.comment.edit');
		Route::patch('/{comment}', 'UpdateController')->name('personal.comment.update');
		Route::delete('/{comment}', 'DeleteController')->name('personal.comment.delete');
	});
});


//Auth::routes();
Auth::routes(['verify' => true]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
