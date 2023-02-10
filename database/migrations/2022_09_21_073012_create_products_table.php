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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_id', 20);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->bigInteger('buyer_id')->nullable();
            $table->bigInteger('rider_id')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('sold')->default(0);

            $table->string('product_name');
            $table->text('details');
            $table->string('quantity', 50);
            $table->string('price_start', 50);
            $table->string('price_end', 50);
            $table->string('sold_price', 50)->nullable();
            $table->date('production_start')->nullable();
            $table->date('production_end')->nullable();
            $table->dateTime('sold_date')->nullable();
            $table->string('total_produced', 50)->nullable();
            $table->string('production_cost', 50)->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('products');
    }
};
