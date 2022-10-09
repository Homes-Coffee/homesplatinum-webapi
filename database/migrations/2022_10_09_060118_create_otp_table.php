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
        Schema::create('otp', function (Blueprint $table) {
            $table->id();
            $table->string('send_with', 1)->comment('1 => WA, 2 => SMS, 3 => EMAIL, 0 => ALL');
            $table->string('code', 6);
            $table->integer('time_exp')->default(0);
            $table->boolean('has_been_used')->default(false);
            $table->foreignUuid('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('otp');
    }
};
