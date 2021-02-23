<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('orderID');
            $table->enum('pickUpCountry', ['US', 'UK']);
            $table->text('pickUpAddress');
            $table->text('deliveryAddress');
            $table->date('pickUpDate');
            $table->date('deliveryDate');
            $table->enum('modeOfDelivery', ['Air', 'Sea']);
            $table->decimal('amount')->default(0.00);
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('orders');
    }
}
