<?php
use Illuminate\Database\Seeder;
use App\Category;
class CategoriesTableSeeder extends Seeder
{
	
	public function run()
	{
		foreach(range(1,5) as $i)
		{
			Image::create([
				'category_id' => 0,
				'description' => 'This is image nr: '. $i,
				'thumbnail' => '1471867277.jpg',
				'active' => true
				]);
		}
	}
}