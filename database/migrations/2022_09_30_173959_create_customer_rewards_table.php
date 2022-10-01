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
        Schema::create('customer_rewards', function (Blueprint $table) {
            $table->id();
            $table->integer('redeem_point')->default(0);
            $table->datetime('redeem_at')->nullable();
            $table->foreignUuid('reward_uuid')->nullable();
            $table->timestamps();

            $table->foreign('reward_uuid')->references('uuid')->on('rewards')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_rewards');
    }
};
