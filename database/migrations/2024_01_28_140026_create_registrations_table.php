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
            $table->integer('reg_no')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('district')->nullable();
            $table->integer('tickets');
            $table->integer('amount')->nullable();
            $table->string('bkash_number')->nullable();
            $table->string('trx_id')->nullable();
            $table->string('payer_ref')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('pay_id');
            $table->string('status');
            $table->string('status_code')->nullable();
            $table->string('intent')->nullable();
            $table->string('trx_status')->nullable();
            $table->string('pay_execute_time')->nullable();
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
