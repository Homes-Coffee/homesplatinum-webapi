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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('email')->unque();
            $table->string('whatsapp', 20)->unque();
            $table->string('photo')->nullable();
            $table->string('fcm')->nullable();
            $table->boolean('is_active')->default(false);
            $table->datetime('phone_verified_at')->nullable();
            $table->foreignUuid('card_uuid')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->timestamps();

            $table->foreign('card_uuid')->references('uuid')->on('cards')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });

        // Schema::create('identity_numbers', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('identity_type');
        //     $table->string('identity_number');
        //     $table->string('identity_number_file')->nullable();
        //     $table->foreignUuid('customer_uuid')->nullable();
        //     $table->timestamps();

        //     $table->foreign('customer_uuid')->references('uuid')->on('customers')->onDelete('cascade');
        // });

        Schema::create('customer_aggrements', function (Blueprint $table) {
            $table->id();
            $table->string('type_of_aggrement');
            $table->boolean('is_agree')->default(true);
            $table->datetime('agreed')->nullable();
            $table->foreignUuid('customer_uuid')->nullable();
            $table->foreignUuid('policy_uuid')->nullable();
            $table->timestamps();

            $table->foreign('customer_uuid')->references('uuid')->on('customers')->onDelete('cascade');
            $table->foreign('policy_uuid')->references('uuid')->on('policy')->nullOnDelete();
        });

        Schema::create('customer_student', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('school_name')->nullable();
            $table->string('semester')->nullable();
            $table->foreignUuid('customer_uuid')->nullable();
            $table->timestamps();

            $table->foreign('customer_uuid')->references('uuid')->on('customers')->onDelete('cascade');
        });

        Schema::create('customer_loyalty', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('struct')->nullable();
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
        Schema::dropIfExists('customer_student');
        Schema::dropIfExists('customer_loyalty');
        Schema::dropIfExists('customer_aggrements');
        // Schema::dropIfExists('identity_numbers');
        Schema::dropIfExists('customers');
    }
};
