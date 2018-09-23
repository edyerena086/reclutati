<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('recruiter_id');
            $table->string('job_title');
            $table->text('job_small_description')->nullable();
            $table->longText('job_description');
            $table->unsignedInteger('job_type_id')->nullable();
            $table->unsignedInteger('state_id')->nullable()->default(0);
            $table->boolean('publish')->default(false);
            $table->double('salary_min', 8, 2)->nullable();
            $table->double('salary_max', 8, 2)->nullable();
            $table->boolean('salary_show')->default(false);
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
        Schema::dropIfExists('vacancies');
    }
}
