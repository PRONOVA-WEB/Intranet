<?php

namespace App\Models\Parameters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocTemplate extends Model
{
    use HasFactory;

    protected $fillable=[
        'type',
        'body',
        'description',
        'status',
        'prefix'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function getStatusAttribute($value)
    {
        return ($value == 'active') ? 'ACTIVA' : 'INACTIVA';
    }
}
