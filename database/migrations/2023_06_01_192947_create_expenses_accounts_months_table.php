<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesAccountsMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses_accounts_months', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('month_id');
            $table->unsignedBigInteger('account_id');
            $table->year('year');
            $table->timestamps();

            $table->unique(['account_id', 'month_id', 'year']);
            $table->foreign('month_id')->references('id')->on('lookup_months')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses_accounts_months');
    }
}
