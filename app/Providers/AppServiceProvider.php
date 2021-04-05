<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Observers\CategoryObserver;
use App\Observers\PostObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		Schema::defaultStringLength(191);

		Category::observe(CategoryObserver::class);
		Post::observe(PostObserver::class);

		Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
			$page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

			return new LengthAwarePaginator(
				$this->forPage($page, $perPage),
				$total ?: $this->count(),
				$perPage,
				$page,
				[
					'path' => LengthAwarePaginator::resolveCurrentPath(),
					'pageName' => $pageName,
				]
			);
		});

    }
}
