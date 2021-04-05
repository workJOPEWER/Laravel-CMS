<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];


	public function posts()
	{
		return $this->hasMany(Post::class);
	}

	public function articles()
	{
		return $this->hasMany(Article::class);
	}

	public function news()
	{
		return $this->hasMany(News::class);
	}

	public function information()
	{
		return $this->hasMany(Information::class);
	}

	public function categories()
	{
		return $this->hasMany(Category::class);
	}

	public function galleries()
	{
		return $this->hasMany(Gallery::class);
	}
}
