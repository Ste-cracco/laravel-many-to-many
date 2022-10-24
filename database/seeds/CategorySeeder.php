<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Film', 'Serie TV', 'Food', 'Moda', 'Digitale', 'Sport'];

        foreach($categories as $category) {
            $c = new Category();    // Ricordarsi di importare il model Category (use App\Category;)

            $c->name = $category;
            $c->slug = Str::slug($category);  // Ricordarsi di importare il namespace della classe Str (use Illuminate\Support\Str)
            
            $c->save();
        }


    }
}
