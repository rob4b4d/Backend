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
        Schema::create('fare_locations', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('fare_location'); // The fare_location column
            $table->decimal('regular_price', 8, 2);
            $table->decimal('discounted_price', 8, 2);
            $table->foreignId('fare_id')->constrained('fares')->onDelete('cascade');
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
        Schema::dropIfExists('fare_locations');
    }
};
