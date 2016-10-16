<?php
use Illuminate\Database\Seeder;
use App\Album;
use App\Category;
class AlbumsTableSeeder extends Seeder
{
	
	public function run()
	{
		foreach(range(1,2) as $i)
		{
			Album::create([
				
				'category_id' => Category::find(1),
				'description' => 'This is Album nr: '. $i,

				'thumbnail' => 'Cover Photo '.$i,
				'active' => true
				]);
		}
	}
}