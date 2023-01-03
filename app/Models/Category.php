<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
	use SoftDeletes;

	// Делаем привязку к таблице:	Хотя Ларавел сам создаём у себя такую привязку.
	// Но так указать ещё, будет лучше, чтобы ориентироваться. А в некоторых компаниях это требование.
	protected $table = 'categories';
	// Это правило нужно, чтобы изменять данные в таблице:
	protected $guarded = false;

}
