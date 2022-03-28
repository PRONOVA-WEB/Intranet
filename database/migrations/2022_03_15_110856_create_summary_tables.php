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

        Schema::create('doc_summary_status', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); //apertura - notificación al fiscal - formulación de cargos - solicita sobreseimiento - prorroga - cerrar el sumario reapertura.
            $table->integer('granted_days');

            $table->timestamps();
            $table->SoftDeletes();
        });

        Schema::create('doc_summaries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('document_id')->unsigned()->nullable();
            $table->string('resolution_number')->nullable();
            $table->dateTime('summary_date');
            $table->string('type')->nullable(); //sumario administrativo o investigación sumaria
            $table->bigInteger('fiscal_id')->unsigned();
            $table->text('matter')->nullable();
            $table->foreignId('creator_id');


            $table->foreign('document_id')->references('id')->on('documents');
            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('fiscal_id')->references('id')->on('doc_fiscals');
            $table->timestamps();
            $table->SoftDeletes();
        });

        Schema::create('doc_summary_events', function (Blueprint $table) {
            $table->id();
            $table->dateTime('event_date');
            $table->foreignId('creator_id');
            $table->bigInteger('summary_id')->unsigned();
            $table->bigInteger('status_id')->unsigned();
            $table->string('resolution_number')->nullable();
            $table->integer('granted_days');
            $table->string('observation')->nullable(); //unidad, departamento o establecimiento donde se encuentra el proceso

            $table->foreign('status_id')->references('id')->on('doc_summary_status');
            $table->foreign('summary_id')->references('id')->on('doc_summaries');
            $table->foreign('creator_id')->references('id')->on('users');
            $table->timestamps();
            $table->SoftDeletes();
        });

        Schema::create('doc_summary_files', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->string('document_type')->nullable();
            $table->bigInteger('summary_id')->unsigned()->nullable();
            $table->bigInteger('summary_event_id')->unsigned()->nullable();

            $table->foreign('summary_id')->references('id')->on('doc_summaries');
            $table->foreign('summary_event_id')->references('id')->on('doc_summary_events');
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('doc_summary_status');
        Schema::dropIfExists('doc_summary_files');
        Schema::dropIfExists('doc_fiscals');
    }
}
