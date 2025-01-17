<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class GuestBook extends Model
{
    use CrudTrait;
    protected $table = 'guest_books';

    protected $fillable = [
        'visited_date','member_id'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
