<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MlaProductos extends Model
{
    use HasFactory;
    protected $table = 'mla_productos';

    protected $fillable = [
        'MLA',
        'title',
        'ISBN',
    ];
}
