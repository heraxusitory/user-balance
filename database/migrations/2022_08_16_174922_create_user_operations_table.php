<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_operations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_balance_id');
            $table->unsignedDouble('amount');
            $table->unsignedDouble('amount_total');
            $table->unsignedDouble('amount_total_usd');
            $table->string('currency');
            $table->enum('status', [
                'pending',
                'failed',
                'succeeded',
                'cancelled',
            ]);
            $table->unsignedDouble('vat_rate');
            $table->boolean('is_vat_inclusive');
            $table->enum('type', [
                'subscription_payment',
                'top-up',
                'payout'
            ]);
            $table->string('country_code');
            $table->string('country_name');
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
        Schema::dropIfExists('user_operations');
    }
}
