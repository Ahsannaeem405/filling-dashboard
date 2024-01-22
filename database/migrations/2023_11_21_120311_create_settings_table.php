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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('accessToken_api')->nullable();
            $table->text('accessToken_header_api')->nullable();
            $table->text('getUser_api')->nullable();
            $table->text('getUser_header_api')->nullable();
            $table->text('getUserConv_api')->nullable();
            $table->text('getUserConvMsg_api')->nullable();
            $table->text('getUserConvImg_api')->nullable();
            $table->text('image_header_api')->nullable();
            $table->text('postMsg_api')->nullable();
            $table->text('delete_api')->nullable();
            $table->int('registration')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
