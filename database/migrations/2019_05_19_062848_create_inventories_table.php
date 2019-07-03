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
            $table->string('input_unit');
            $table->decimal('input_amount', 25,6);
            $table->decimal('use_amount', 25,6);
            $table->bigInteger('vendor_id');
            $table->string('vendor_lot');
            $table->text('notes');
            $table->string('status')->default('quarantine');
            $table->timestamp('expiration_date')->nullable();
            $table->string('type');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->string('remove_on_reject')->default('no');
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
