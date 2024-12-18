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
        Schema::create('history', function (Blueprint $table) {
            $table->id(); // Primary key with auto-increment
            $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP')); // Default to current timestamp
            $table->unsignedBigInteger('fcollection_id'); // Foreign key to fare_collections table
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // User foreign key
            $table->foreign('fcollection_id')->references('id')->on('fare_collections')->onDelete('cascade'); // Foreign key constraint
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history');
    }
};
