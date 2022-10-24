<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id'
    ];

    public function category() {

        return $this->belongsTo('App\Category','category_id', 'id');
        // Questo metodo lo useremo come proprità per stampare i dati ($post->category->name) *Laravel's Trick*
    }

    public function tags() {

        return $this->belongsToMany('App\Tag'); // Passo 1 solo parametro perchè si sono rispettate le convenzioni di Laravel
    }



    // Aggiungo controllo nella quale lo slug del Post sia univoco:

    static public function getUniqueSlugFrom($title) {

        $slug_base = Str::slug($title);  // Ricordarsi di implementare -> use Illuminate\Support\Str;
        $slug = $slug_base;

        $post_esistente = Post::where('slug', $slug)->first();
        $slug_counter = 1;

        while($post_esistente) {
            $slug = $slug_base .'-'. $slug_counter;
            $post_esistente = Post::where('slug', $slug)->first();
            $slug_counter ++;
        }

        return $slug;
    }
}
