<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('candidate_id');
            $table->string('name')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('location')->nullable();
            $table->string('civil_status')->nullable();
            $table->text('labor_goal')->nullable();
            $table->longText('languages')->nullable();
            $table->longText('education')->nullable();
            $table->longText('job_history')->nullable();
            $table->longText('skills')->nullable();
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
        Schema::dropIfExists('search_candidates');
    }
}
