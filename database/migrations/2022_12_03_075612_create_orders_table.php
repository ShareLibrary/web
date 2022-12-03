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
        $status = [
            'CONFIRMING', 'CONFIRMED', 'DELIVERYING', 'RENTED', 'RETURNING', 'RETURNED'
        ];
        Schema::create('orders', function (Blueprint $table) use ($status) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('returned_date')->nullable();
            $table->enum('status', $status);
            $table->date('intended_return_date');
            $table->smallInteger('point')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
};
