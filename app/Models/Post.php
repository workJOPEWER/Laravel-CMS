<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $thumbnail
 * @property string $title
 * @property int $user_id
 * @property int $position
 * @property int $name
 * @property string $slug
 * @property string $short_describe
 * @property string $post_content
 * @property bool $is_published
 * @property string post_type
 */


class Post extends Model
{
	use HasFactory;

	protected $fillable = ['user_id', 'thumbnail', 'title', 'slug', 'short_describe', 'position', 'post_content', 'sort_id', 'is_published'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class, 'category_posts');
	}


}