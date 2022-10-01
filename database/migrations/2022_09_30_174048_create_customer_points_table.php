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
        Schema::create('customer_history_points', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->bigInteger('point')->default(0);
            $table->foreignUuid('customer_uuid')->nullable();
            $table->foreignUuid('transaction_uuid')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->timestamps();

            $table->foreign('customer_uuid')->references('uuid')->on('customers')->nullOnDelete();
            $table->foreign('transaction_uuid')->references('uuid')->on('customer_transactions')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_points');
    }
};
