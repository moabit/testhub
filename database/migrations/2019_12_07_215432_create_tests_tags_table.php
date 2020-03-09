<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests_tags', function (Blueprint $table) {
            $table->bigInteger('test_id');
            $table->bigInteger('tag_id');

            $table->primary(['test_id','tag_id']);
            $table->foreign('test_id')->references('id')->on('tests');
            $table->foreign('tag_id')->references('id')->on('tags');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     *
     */
    public function down()
    {
        Schema::dropIfExists('tests_tags');
    }
}
