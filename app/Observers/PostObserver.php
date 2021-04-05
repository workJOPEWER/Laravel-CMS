<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
	/**
	 * Handle the meal "creating" event.
	 *
	 * @param Post $post
	 * @return void
	 */
	public function creating(Post $post)
	{
		if (is_null($post->position)) {
			$post->position = Post::max('position') + 1;
			return;
		}

		$lowerPriorityPosts = Post::where('position', '>=', $post->position)
			->get();

		foreach ($lowerPriorityPosts as $lowerPriorityPost) {
			$lowerPriorityPost->position++;
			$lowerPriorityPost->saveQuietly();
		}
	}

	/**
	 * Handle the meal "updating" event.
	 *
	 * @param Post $post
	 * @return void
	 */
	public function updating(Post $post)
	{
		if ($post->isClean('position')) {
			return;
		}

		if (is_null($post->position)) {
			$post->position = Post::max('position');
		}

		if ($post->getOriginal('position') > $post->position) {
			$positionRange = [
				$post->position, $post->getOriginal('position')
			];
		} else {
			$positionRange = [
				$post->getOriginal('position'), $post->position
			];
		}

		$lowerPriorityPosts = Post::where('id', '!=', $post->id)
			->whereBetween('position', $positionRange)
			->get();

		foreach ($lowerPriorityPosts as $lowerPriorityPost) {
			if ($post->getOriginal('position') < $post->position) {
				$lowerPriorityPost->position--;
			} else {
				$lowerPriorityPost->position++;
			}
			$lowerPriorityPost->saveQuietly();
		}
	}

	/**
	 * Handle the meal "deleted" event.
	 *
	 * @param Post $post
	 * @return void
	 */
	public function deleted(Post $post)
	{
		$lowerPriorityPosts = Post::where('position', '>', $post->position)
			->get();

		foreach ($lowerPriorityPosts as $lowerPriorityPost) {
			$lowerPriorityPost->position--;
			$lowerPriorityPost->saveQuietly();
		}
	}
}