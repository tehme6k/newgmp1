<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMprProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpr_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('mpr_id');
            $table->integer('product_id');
            $table->double('amount', 9, 2)->unsigned();
            $table->integer('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mpr_product');
    }
}
