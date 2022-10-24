<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts() {

        return $this->belongsToMany('App\Post'); // Passo 1 solo parametro perchè si sono rispettate le convenzioni di Laravel
    }
}
