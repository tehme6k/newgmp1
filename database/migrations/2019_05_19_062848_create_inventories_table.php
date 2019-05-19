<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->decimal('amount', 25,6);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->string('status')->default('quarantine');
            $table->text('reason')->nullable();
            $table->string('lot')->nullable();
            $table->timestamp('expiration_date')->nullable();
            $table->string('type');
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
        Schema::dropIfExists('inventories');
    }
}
