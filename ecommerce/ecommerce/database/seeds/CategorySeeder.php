<?php
use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       foreach(range(1,15) as $i)
		{
			App\Image::create([
                'album_id' => 3,
                'name' => 'image of first album',
                'path' => '1471867277',
                'active' => false
                ]);
		}

    }
}
