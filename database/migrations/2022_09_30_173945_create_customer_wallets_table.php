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
        Schema::create('customer_wallets', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('pin');
            $table->string('customer_code')->unique();
            $table->bigInteger('point')->default(0);
            $table->bigInteger('balance')->default(0);
            $table->foreignUuid('customer_uuid')->nullable();
            $table->timestamps();

            $table->foreign('customer_uuid')->references('uuid')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_wallets');
    }
};
