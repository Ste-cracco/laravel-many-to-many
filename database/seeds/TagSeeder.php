<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['#carne','#pesce','#sicurezza', '#calcio', '#tennis', '#vetro', '#legno', '#audio' ];

        foreach($tags as $tagName) {
            $t = new Tag(); // Ricordare di importare namespace use App\Tag;

            $t->name = $tagName;
            $t->slug = Str::slug($tagName); // Ricordare di importare namespace use Illuminate\Support\Str;

            $t->save();
        }
    }
}
