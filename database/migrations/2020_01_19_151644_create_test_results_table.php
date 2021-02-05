<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('test_id');
            $table->float('score');
            $table->bigInteger('user_id')->nullable();
            $table->string('guest_token')->nullable();
            $table->bigInteger('time_spent')->nullable();
            $table->json('user_answers')->nullable();;
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade')->nullable();;
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();;
            $table->dateTime('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
