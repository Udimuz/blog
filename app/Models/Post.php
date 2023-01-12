<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

	protected $table = 'posts';
	// Это правило нужно, чтобы изменять данные в таблице:
	protected $guarded = false;
	protected $withCount = ['likedUsers'];	// Отношения которые должны быть посчитаны (что метод ниже в этом коде).
	// И это во всех записях с Сообщениями добавляет новый атрибут "liked_users_count"

	// Здесь может возникнуть путаница. Для вызова этого метода требуется обращаться "$post->tags()" со скобками.
	// Если обращаться без скобок "$post->tags" - это уже будет обращение к переменной tags, если такая подключена к этому объекту:
	// view('admin.post.edit', compact('post','categories', 'tags'));

	public function tags() {
		// Для того чтоб создать взаимоотношение "Многие ко многим" должны написать
		return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id'); //Связываем foreign - значит "кто", related - значит "с кем имеет отношение"
	}

	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}

	public function likedUsers()
	{
		return $this->belongsToMany(User::class, 'post_user_likes', 'post_id', 'user_id');
	}

	public function comments()
	{	// Один-ко-многим
		return $this->hasMany(Comment::class, 'post_id', 'id');
	}
}
