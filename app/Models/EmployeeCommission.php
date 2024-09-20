<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCommission extends Model
{
    use HasFactory;

    protected $table = 'employees_commission';

    public $timestamps = false;
    protected $primaryKey = 'emp_id';
    protected $fillable = ['emp_id', 'month_year', 'total_commission'];
}
