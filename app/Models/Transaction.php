<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id'];

    public function product()
    {
        return $this->belongsTo('App\Models\Transaction');
    }

    public function detail()
    {
        return $this->hasMany(CheckOut::class);
    }
}
