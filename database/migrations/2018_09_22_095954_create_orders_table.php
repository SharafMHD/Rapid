<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateordersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_code');
            $table->date('order_date');
            $table->date('shipping_date');
            $table->date('delivery_date');
            $table->string('recipient');
            $table->string('recipient_phone');
            $table->string('recipient_address');
            $table->string('pickup_location');
            $table->string('drop_location');
            $table->Integer('bill_id');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
