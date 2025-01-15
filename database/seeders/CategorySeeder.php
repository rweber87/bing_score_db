<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $names = [
            'Music' => 'MUS',
            'Performance' => 'PER',
            'Singing' => 'SNG',
            'Musicality' => 'MUS',
        ];

        foreach ($names as $name => $abb) {
            $category = Category::firstOrCreate(['name' => $name, 'abbreviation' => $abb]);
            $category->save();
        }
    }
}
