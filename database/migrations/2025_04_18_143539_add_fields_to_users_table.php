<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nickname')->nullable();
            $table->string('avatar')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('city')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nickname');
            $table->dropColumn('avatar');
            $table->dropColumn('phone_no');
            $table->dropColumn('city');
        });
    }
};
