<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $thumbnail
 * @property int $user_id
 * @property int $position
 * @property int $name
 * @property string $slug
 * @property bool $is_published
 */

class Category extends Model
{
    use HasFactory;

	public $table = 'categories';

	protected $fillable = ['user_id', 'thumbnail', 'name', 'position', 'slug', 'is_published'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function posts()
	{
		return $this->belongsToMany(Post::class, 'category_posts');
	}


}
