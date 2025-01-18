<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use CrudTrait;
    protected $table = 'transactions';

    protected $fillable = [
        'transaction_type','transaction_date','due_date','return_date','late_fee','member_id','book_id'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function export($crud = false)
    {
        return '<a class="btn btn-primary" target="_blank" href="'.route('transaction.export').'">Download PDF</a>';
    }
}
