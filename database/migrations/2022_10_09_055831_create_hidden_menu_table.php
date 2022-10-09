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
        Schema::create('hidden_menu', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('image');
            $table->datetime('published_at');
            $table->foreignUuid('card_uuid')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->timestamps();

            // $table->foreign('card_uuid')->references('uuid')->on('card')->nullOnDelete();
            // $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hidden_menu');
    }
};
