<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('type_id');
            $table->integer('created_by');
            $table->string('flavor');
            $table->integer('country_id');
            $table->string('status')->default('quarantine'); //quarantine, approved, rejected, retired
            $table->integer('batch_count')->default(0);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE projects AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
