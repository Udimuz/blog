<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
	protected $table = 'comments';
	protected $guarded = false;

	// 11.01.2023 Здесь собрал привязку, к какому Сообщению принадлежит комментарий:
	// Обращаюсь к этому в контроллере "app/Http/Controllers/Personal/Comment/IndexController.php"
	// И в шаблоне редактирования сообщения "resources/views/personal/comment/edit.blade.php"
	public function post() {
		// - имеет один -
		return $this->hasOne(Post::class, 'id', 'post_id');
	}

	public function user()
	{
		//	Один ко многим:		- так назвал учитель
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	public function getDateAsCarbonAttribute()
	{
		//return $this->created_at;
		return Carbon::parse($this->created_at);
	}
}
