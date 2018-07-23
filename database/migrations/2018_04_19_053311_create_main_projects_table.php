<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author');
            $table->string('moto');
            $table->string('title');
            $table->string('about_title');
            $table->string('title_description');
            $table->string('problem_context');
            $table->string('problem_description');
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
        Schema::dropIfExists('main_projects');
    }
}
