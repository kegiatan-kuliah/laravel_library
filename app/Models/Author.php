<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';

    protected $fillable = [
        'name','nationality'
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'author_id');
    }
}
