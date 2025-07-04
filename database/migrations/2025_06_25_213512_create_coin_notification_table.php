<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_notification', function (Blueprint $table) {
            $table->id();
            $table->integer('uid')->default(0); // 0 for admin/global, or user id
            $table->timestamp('date')->useCurrent();
            $table->text('message');
            $table->boolean('read')->default(0); // 0 = unread, 1 = read
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coin_notification');
    }
}
