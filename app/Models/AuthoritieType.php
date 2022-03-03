<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthoritieType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $table = 'authorities_types';

}
