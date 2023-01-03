<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
	protected $table = 'posts';
	// Это правило нужно, чтобы изменять данные в таблице:
	protected $guarded = false;
}
