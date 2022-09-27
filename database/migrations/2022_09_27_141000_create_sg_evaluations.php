<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSgEvaluations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sg_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sg_supervision_guideline_id')->constrained('sg_supervision_guidelines');
            $table->foreignId('user_id')->constrained('users');
            $table->date('date');
            $table->date('expire_on');
            $table->foreignId('approved_by')->constrained('users');
            $table->text('observations');
            $table->string('signed_file');
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
        Schema::dropIfExists('sg_evaluations');
    }
}
