<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use CrudTrait;
    protected $table = 'members';

    protected $fillable = [
        'name','email','phone','address','membership_date','status'
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'book_id');
    }

    public function guestBooks(): HasMany
    {
        return $this->hasMany(GuestBook::class, 'member_id');
    }
}
