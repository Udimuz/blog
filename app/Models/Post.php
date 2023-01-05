<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
	use SoftDeletes;

	protected $table = 'posts';
	// Это правило нужно, чтобы изменять данные в таблице:
	protected $guarded = false;

	// Здесь может возникнуть путаница. Для вызова этого метода требуется обращаться "$post->tags()" со скобками.
	// Если обращаться без скобок "$post->tags" - это уже будет обращение к переменной tags, если такая подключена к этому объекту:
	// view('admin.post.edit', compact('post','categories', 'tags'));

	public function tags() {
		// Для того чтоб создать взаимоотношение "Многие ко многим" должны написать
		return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id'); //Связываем foreign - значит "кто", related - значит "с кем имеет отношение"
	}

}
