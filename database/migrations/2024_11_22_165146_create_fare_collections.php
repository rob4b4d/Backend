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
        Schema::create('fare_collections', function (Blueprint $table) {
            $table->id();
            $table->integer('route')->length(5); // Limiting route to 5 digits
            $table->string('name');
            $table->decimal('regular_total', 10, 2);
            $table->decimal('discounted_total', 10, 2);
            $table->integer('bus_num');
            $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP')); // Default to current timestamp
            $table->unsignedBigInteger('fare_id'); // Foreign key to fare table
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->foreign('fare_id')->references('id')->on('fares')->onDelete('cascade'); // Fare foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // User foreign key
            $table->timestamps(); // Creates created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fare_collections');
    }
};
