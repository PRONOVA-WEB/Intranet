<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocCustomSignatureFlowsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_custom_signature_flow', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ou_id');
            $table->string('flow_name');
            $table->bigInteger('creator_id')->unsigned();

            $table->foreign('ou_id')->references('id')->on('organizational_units');
            $table->foreign('creator_id')->references('id')->on('users');
            $table->timestamps();
            $table->SoftDeletes();
        });

        Schema::create('doc_custom_signature_flow_signatories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('doc_custom_signature_flow_id')->unsigned();
            $table->bigInteger('signator_id')->unsigned();
            $table->integer('order'); //para determinar el orden de firmado

            $table->foreign('doc_custom_signature_flow_id','signature_flow_has_signatories_foreign')->references('id')->on('doc_custom_signature_flow');
            $table->foreign('signator_id')->references('id')->on('users');
            
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
        Schema::dropIfExists('doc_custom_signature_flow_signatories');
        Schema::dropIfExists('doc_custom_signature_flow');
    }
}
