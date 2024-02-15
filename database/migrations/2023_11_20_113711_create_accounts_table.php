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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('buy_id')->nullable();
            $table->date('buy_date')->nullable();
            $table->integer('account_id')->nullable();
            $table->text('proxy')->nullable();
            $table->text('description')->nullable();
            $table->text('refreshToken')->nullable();
            $table->text('accessToken')->nullable();
            $table->text('adPic')->nullable();
            $table->text('adId')->nullable();
            $table->text('adLink')->nullable();
            $table->text('adTitle')->nullable();
            $table->text('adPrice')->nullable();
            $table->text('adStatus')->nullable();
            $table->text('reloadDate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
