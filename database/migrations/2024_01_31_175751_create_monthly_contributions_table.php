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
        Schema::create('monthly_contributions', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing primary key
            $table->unsignedBigInteger('member_no');
            $table->decimal('amount', 10, 2);
            $table->date('payment_date');
            $table->unsignedInteger('payment_month');
            $table->unsignedInteger('payment_year');
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_contributions');
    }
};
