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
	Route::get('/', 'IndexController');
//	Route::get('/posts/create', 'CreateController')->name('post.create');
//	Route::post('/posts', 'StoreController')->name('post.store');
//	Route::get('/posts/{post}', 'ShowController')->name('post.show');
//	Route::get('/posts/{post}/edit', 'EditController')->name('post.edit');
//	Route::patch('/posts/{post}', 'UpdateController')->name('post.update');
//	Route::delete('/posts/{post}', 'DestroyController')->name('post.delete');
});

// Админ-часть сайта:
// prefix добавит везде к ссылке впереди адрес "/admin/". Это чтобы не создавать такие роуты '/admin/post', '/admin/add', а сократить
Route::group(['namespace'=>'App\Http\Controllers\Admin', 'prefix'=>'admin'], function() {
	Route::group(['namespace'=>'Main'], function(){
		// Чтобы страница запускалась по адресу "/admin/"
		Route::get('/', 'IndexController');
	});
	// Добавляется prefix:
	Route::group(['namespace'=>'Category', 'prefix'=>'categories'], function(){
		// Чтобы страница запускалась по адресу "/admin/categories":
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

	Route::group(['namespace'=>'Tag', 'prefix'=>'tags'], function(){
		// Чтобы страница запускалась по адресу "/admin/tags":
		Route::get('/', 'IndexController')->name('admin.tag.index');
		Route::get('/create', 'CreateController')->name('admin.tag.create');
		Route::post('/', 'StoreController')->name('admin.tag.store');
		Route::get('/{tag}', 'ShowController')->name('admin.tag.show');
		Route::get('/{tag}/edit', 'EditController')->name('admin.tag.edit');
		Route::patch('/{tag}', 'UpdateController')->name('admin.tag.update');
		Route::delete('/{tag}', 'DeleteController')->name('admin.tag.delete');
		//Route::get('/', function() { return "Route work"; });
	});
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
