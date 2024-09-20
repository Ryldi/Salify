<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'transaction_id', 
        'service_id', 
        'emp_id',
        'service_price', 
        'service_quantity',
        'post_commission'
    ];
}
