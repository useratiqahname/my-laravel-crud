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
        if (!Schema::hasColumn('todos', 'user_id')) {
            Schema::table('todos', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->after('id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (Schema::hasColumn('todos', 'user_id')) {
            Schema::table('todos', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }
    }
};
