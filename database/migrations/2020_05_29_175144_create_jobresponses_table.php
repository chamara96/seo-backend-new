<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobresponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobresponses', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('jobposts_id')->unsigned();
            $table->string('users_email');
            $table->string('users_telephone')->nullable();
            $table->string('users_cv')->nullable();
            $table->string('users_firstname')->nullable();
            $table->string('users_lastname')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('reviewed_by')->unsigned()->nullable();

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
        Schema::dropIfExists('jobresponses');
    }
}
