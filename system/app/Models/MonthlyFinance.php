<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyFinance extends Model
{
    protected $fillable = [
        'title',
        'installments',
        'billed_date',
        'type',
        'amount',
        'status',
    ];
}
