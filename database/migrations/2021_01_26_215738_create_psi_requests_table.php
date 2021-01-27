<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsiRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psi_requests', function (Blueprint $table) {
            $table->id();            
            $table->date('start_date');
            $table->string('status');
            $table->boolean('disability');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('user_creator_id');
            $table->foreign('user_creator_id')->references('id')->on('users');
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
        Schema::dropIfExists('psi_requests');
    }
}
