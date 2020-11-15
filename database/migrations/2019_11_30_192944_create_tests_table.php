<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string( 'title', 100);
            $table->text('description');
            $table->unsignedBigInteger('time_limit')->nullable();
            $table->unsignedBigInteger('pass_rate');
            $table->unsignedbigInteger('created_by');
            $table->string('creator_token')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->nullable;
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
        Schema::dropIfExists('tests');
    }
}
