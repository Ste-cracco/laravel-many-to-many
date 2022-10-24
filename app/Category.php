<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model

// Recupero i dati dei Posts
{
    public function posts() { 
        return $this->hasMany('App\Post','category_id','id'); // 1° parametro = Model collegato 
                                                              // Se rispettate le convenzioni, il 2° e 3° parametro non sono obbligatori 
    }
}
