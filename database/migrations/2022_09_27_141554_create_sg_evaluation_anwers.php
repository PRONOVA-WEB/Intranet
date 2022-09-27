<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSgEvaluationAnwers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sg_evaluation_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sg_evaluation_id')->constrained('sg_evaluations');
            $table->foreignId('sg_guideline_question_id')->constrained('sg_guideline_questions');
            $table->foreignId('sg_evaluated_id')->constrained('sg_evaluated');
            $table->boolean('answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sg_evaluation_anwers');
    }
}
