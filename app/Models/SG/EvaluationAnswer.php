<?php

namespace App\Models\SG;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationAnswer extends Model
{
    use HasFactory;

    protected $table = [
        'sg_evaluation_answers'
    ];

    public function Evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'sg_evaluation_id');
    }

    public function question()
    {
        return $this->belongsTo(GuidelineQuestions::class,'sg_guideline_question_id');
    }

    public function Evaluated()
    {
        return $this->belongsTo(Evaluated::class, 'sg_evaluated_id');
    }
}
