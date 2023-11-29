<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('telegram')->after('name')->nullable();
            $table->text('last_login')->after('email')->nullable();
            $table->text('rank')->after('email')->nullable();
            $table->text('role')->after('email')->nullable();
            $table->text('status')->after('email')->nullable();
            $table->text('image')->after('email')->nullable();
            $table->bigInteger('limit')->after('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('telegram');
            $table->dropColumn('last_login');
            $table->dropColumn('rank');
            $table->dropColumn('role');
            $table->dropColumn('status');
            $table->dropColumn('image');
        });
    }
};
