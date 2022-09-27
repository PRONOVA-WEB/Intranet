<?php

namespace App\Models\SG;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluated extends Model
{
    use HasFactory;

    protected $table = [
        'sg_evaluated'
    ];

    public function Evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'sg_evaluation_id');
    }
}
