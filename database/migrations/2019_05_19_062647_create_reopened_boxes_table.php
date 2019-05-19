<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReopenedBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reopened_boxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('box_id');
            $table->timestamp('reopen_date');
            $table->integer('requested_by_id');
            $table->string('opened_by_id');
            $table->text('reason');
            $table->timestamp('close_date')->nullable();
            $table->integer('closed_by')->nullable();
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
        Schema::dropIfExists('reopened_boxes');
    }
}
