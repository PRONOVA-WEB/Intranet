<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSgSupervisionGuidelineOrganizationalUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sg_organizational_unit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sg_supervision_guideline_id')->constrained('sg_supervision_guidelines');
            $table->foreignId('organizational_unit_id')->constrained('organizational_units');
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
        Schema::dropIfExists('sg_supervision_guideline_organizational_unit');
    }
}
