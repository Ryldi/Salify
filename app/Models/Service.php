<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'service_id';
    protected $keyType = 'string';

    public static function boot()
{
    parent::boot();
    static::creating(function ($model) {
        $model->service_id = (string) Str::uuid();
    });
}
}
