<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfessionIdServiceRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('doc_service_requests', function (Blueprint $table) {
          $table->foreignId('profession_id')->after('establishment_id')->nullable();
          $table->foreign('profession_id')->references('id')->on('cfg_professions');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('doc_service_requests', function (Blueprint $table) {
          $table->dropForeign(['profession_id']);
          $table->dropColumn('profession_id');
      });
    }
}
