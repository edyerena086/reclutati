<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vacancy_id');
            $table->string('job_title');
            $table->text('job_small_description')->nullable();
            $table->longText('job_description');
            $table->string('job_type')->nullable();
            $table->string('state')->nullable();
            $table->boolean('publish')->default(false);
            $table->double('salary_min', 8, 2)->nullable();
            $table->double('salary_max', 8, 2)->nullable();
            $table->boolean('salary_show')->default(false);
            $table->unsignedInteger('company_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_profile_picture')->nullable();
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
        Schema::dropIfExists('search_vacancies');
    }
}
