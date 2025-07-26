<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    protected $guarded = [];

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class);
    }

    public function monthlyFinance()
    {
        return $this->belongsTo(MonthlyFinance::class);
    }
}
