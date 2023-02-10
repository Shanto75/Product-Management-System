<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('product_name');
            $table->text('details');
            $table->string('quantity', 50);
            $table->string('price_start', 50);
            $table->string('price_end', 50);
            $table->string('sold_price', 50)->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->bigInteger('buyer_id')->nullable();
            $table->bigInteger('rider_id')->nullable();
            $table->dateTime('bid_start');
            $table->dateTime('bid_end');
            $table->boolean('sold')->default(0);
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
        Schema::dropIfExists('bids');
    }
};
