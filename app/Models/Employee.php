<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'emp_id';
    protected $keyType = 'string';

    public static function boot()
{
    parent::boot();
    static::creating(function ($model) {
        $model->emp_id = (string) Str::uuid();
    });
}
}
