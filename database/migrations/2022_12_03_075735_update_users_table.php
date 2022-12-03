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
        $sex = ['MAN', 'WOMAN'];
        $roles = ['USER', 'ADMIN'];
        Schema::table('users', function (Blueprint $table) use ($sex, $roles) {
            $table->string('phone', 20);
            $table->string('address', 100);
            $table->enum('sex', $sex)->nullable();
            $table->boolean('active')->default(false);
            $table->enum('role', $roles);
            $table->boolean('del')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
