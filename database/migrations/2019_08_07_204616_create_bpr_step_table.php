<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBprStepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bpr_step', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bpr_id');
            $table->bigInteger('step_id');
            $table->bigInteger('performed_by')->nullable();
            $table->timestamp('performed_dt');
            $table->bigInteger('approved_by')->nullable();
            $table->timestamp('approved_dt');
            $table->boolean('is_completed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bpr_step');
    }
}
