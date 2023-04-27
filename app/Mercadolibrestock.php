<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mercadolibrestock extends Model
{
    use HasFactory;
    protected $table = 'mercadolibrestock';

    protected $fillable = [
        'status',
        'item_id',
        'fecha',
    ];
}
