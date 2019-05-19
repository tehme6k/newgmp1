<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMprsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mprs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id');
            $table->double('gpb', 9, 2)->unsigned()->nullable();
            $table->integer('version')->default(1);
            $table->integer('serving_size');
            $table->integer('created_by');
            $table->integer('approved_by')->nullable();
            $table->string('status')->default('quarantine');  //quarantine, approved, rejected, retired
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
        Schema::dropIfExists('mprs');
    }
}
