<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummaryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_fiscals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->SoftDeletes();
        });

        Schema::create('doc_summary_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('granted_days');

            $table->timestamps();
            $table->SoftDeletes();
        });

        Schema::create('doc_summaries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('document_id')->unsigned()->nullable();
            $table->string('resolution_number')->nullable();
            $table->date('summary_date')->nullable();
            $table->string('type')->nullable(); //sumario administrativo o investigación sumaria
            $table->bigInteger('fiscal_id')->unsigned();
            $table->text('matter')->nullable();
            $table->foreignId('user_id');


            $table->foreign('document_id')->references('id')->on('documents');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('fiscal_id')->references('id')->on('doc_fiscals');
            $table->timestamps();
            $table->SoftDeletes();
        });

        Schema::create('doc_summary_events', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('summary_id')->unsigned();
            $table->bigInteger('status_id')->unsigned();
            $table->integer('granted_days');
            $table->string('observation')->nullable(); //unidad, departamento o establecimiento donde se encuentra el proceso

            $table->foreign('status_id')->references('id')->on('doc_summary_types');
            $table->foreign('summary_id')->references('id')->on('doc_summaries');
            $table->timestamps();
            $table->SoftDeletes();
        });
    }




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_summary_events');
        Schema::dropIfExists('doc_summaries');
        Schema::dropIfExists('doc_summary_types');
        Schema::dropIfExists('doc_fiscals');
    }
}
