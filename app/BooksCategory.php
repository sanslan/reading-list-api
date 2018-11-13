<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BooksCategory extends Model
{
    public $timestamps = false;

    public function books(){
        return $this->hasMany(Book::class);
    }
}
