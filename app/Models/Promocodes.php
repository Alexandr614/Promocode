<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocodes extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $casts = ['date_close' => 'date:d-m-Y'];
    protected $fillable = [
        'code',
        'percent',
        'value_abs',
        'min_sum',
        'date_close',
        'number_of_uses',
        'active'
    ];
}
