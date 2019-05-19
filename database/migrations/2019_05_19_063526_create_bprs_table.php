<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBprsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bprs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('mpr_id');
            $table->integer('project_id');
            $table->string('lot_number');
            $table->integer('run_count')->default(1);
            $table->integer('bottle_count')->unsigned();
            $table->integer('created_by');
            $table->integer('approved_by')->nullable();
            $table->string('status')->default('quarantine');
            $table->text('reason')->nullable();

            $table->unique(['mpr_id', 'run_count']);

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
        Schema::dropIfExists('bprs');
    }
}
