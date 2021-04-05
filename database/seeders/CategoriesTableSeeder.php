<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
	/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
	{
		DB::table('categories')->insert([
			[
				'user_id' => '1',
				'name' => 'Laravel',
				'slug' => 'laravel',
				'position' => '1',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'user_id' => '1',
				'name' => 'WordPress',
				'slug' => 'wordpress',
				'position' => '2',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'user_id' => '1',
				'name' => 'Python',
				'slug' => 'python',
				'position' => '3',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'user_id' => '1',
				'name' => 'Javascript',
				'slug' => 'javascript',
				'position' => '4',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'user_id' => '1',
				'name' => 'Django',
				'slug' => 'django',
				'position' => '5',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			]
		]);
	}
}
