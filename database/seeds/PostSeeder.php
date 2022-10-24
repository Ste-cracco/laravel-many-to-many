<?php

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $categoryIds = Category::all()->pluck('id'); // [Collecions->pluck()] Recuero dal Database gli ID di tutte le categorie
        $tags = Tag::all()->pluck('id'); // Recupero gli ID dei Tags | Importo namespace use App\Tag;

        for ($i = 0; $i < 50; $i++) {
            $post = new Post(); // Ricordarsi di importare il model Category (use App\Post;)
            $post->title = $faker->words(rand(5, 10), true);
            $post->content = $faker->paragraphs(rand(10, 20), true);
            $post->slug = Str::slug($post->title); // Ricordarsi di importare il namespace della classe Str (use Illuminate\Support\Str)
            // Assegno a category_id un valore Random di un'ID di una category
            $post->category_id = $faker->optional()->randomElement($categoryIds);

            $post->save();

            // I Tags li salvo dopo che avrà salvato il Post
            $tagsIds = $tags->shuffle()->take(3)->all(); // Randomizzo gli Ids e prendo i primi 3
            $post->tags()->sync($tagsIds);
        }
    }
}
