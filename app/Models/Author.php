<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use CrudTrait;
    protected $table = 'authors';

    protected $fillable = [
        'name','nationality'
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'author_id');
    }
}
