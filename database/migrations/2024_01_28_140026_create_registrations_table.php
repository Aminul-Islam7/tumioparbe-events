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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->integer('reg_no');
            $table->string('name');
            $table->string('phone');
            $table->string('district')->nullable();
            $table->integer('tickets');
            $table->integer('amount');
            $table->string('bkash_number');
            $table->string('trx_id');
            $table->string('payer_ref');
            $table->string('invoice_no');
            $table->string('pay_id');
            $table->string('status');
            $table->string('status_code');
            $table->string('intent');
            $table->string('trx_status');
            $table->string('pay_execute_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
