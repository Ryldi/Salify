<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'transaction_id';
    protected $fillable = ['transaction_id', 'customer_name', 'transaction_date'];
}
