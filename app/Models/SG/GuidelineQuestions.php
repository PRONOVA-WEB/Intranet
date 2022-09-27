<?php

namespace App\Models\SG;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuidelineQuestions extends Model
{
    use HasFactory;

    protected $table = [
        'sg_guideline_questions'
    ];

    public function guideline()
    {
        return $this->belongsTo(SupervisionGuideline::class,'sg_supervision_guideline_id');
    }

}
