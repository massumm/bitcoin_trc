<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_list', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('image');
            $table->string('title');
            $table->mediumText('description');
            $table->string('type');
            $table->double('price');
            $table->double('discount');
            $table->integer('stock_status');
            $table->integer('created_by');
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
        Schema::dropIfExists('medicine_list');
    }
}
