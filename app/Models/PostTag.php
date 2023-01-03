<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;
	protected $table = 'post_tags';
	// Это правило нужно, чтобы изменять данные в таблице:
	protected $guarded = false;
}
