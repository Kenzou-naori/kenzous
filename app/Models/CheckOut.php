<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
    protected $fillable = ['transaction_id','product_id', 'total_qty'];
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    // public function user()
    // {
    //     return $this->belongsTo('App\Models\User');
    // }
    // public function product()
    // {
    //     return $this->belongsTo('App\Models\Checkout');
    // }
    public function transaction()
    {
return $this->belongsTo(Transaction::class);
    }
}
