<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use CrudTrait;
    protected $table = 'books';

    protected $fillable = [
        'title','publication_year','genre','total_copies','available_copies','author_id'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'book_id');
    }
}
