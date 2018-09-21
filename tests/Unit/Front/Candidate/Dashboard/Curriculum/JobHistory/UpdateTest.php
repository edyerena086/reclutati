<?php

namespace Tests\Unit\Front\Candidate\Dashboard\Curriculum\JobHistory;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/candidate/dashboard/curriculum/job-histories";
	private $candidateJobHistory;

	public function test_send_no_data()
    {
    	$this->init();

    	$response = $this->json('PUT', $this->url);

    	$response->assertStatus(422);
    }

    public function test_send_no_company_name()
    {
    	$this->init();

    	$response = $this->json('PUT', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'empresa' => [
	    				'El campo empresa es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_job_title()
    {
    	$this->init();

    	$response = $this->json('PUT', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'puesto' => [
	    				'El campo puesto es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_duration()
    {
    	$this->init();

    	$response = $this->json('PUT', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'duracion' => [
	    				'El campo duracion es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_duration_not_numeric()
    {
    	$this->init();

    	$response = $this->json('PUT', $this->url, ['duracion' => 'x10']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'duracion' => [
	    				'El campo duracion debe ser numérico.'
	    			]
    			]
    		]);
    }

    public function test_send_no_description()
    {
    	$this->init();

    	$response = $this->json('PUT', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'descripcion' => [
	    				'El campo descripcion es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_current()
    {
    	$this->init();

    	$response = $this->json('PUT', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'trabajoActual' => [
	    				'El campo trabajo actual es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_current_not_integer()
    {
    	$this->init();

    	$response = $this->json('PUT', $this->url, ['trabajoActual' => 'olh']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'trabajoActual' => [
	    				'El campo trabajo actual debe ser un número entero.'
	    			]
    			]
    		]);
    }

    public function test_send_current_not_in_range()
    {
    	$this->init();

    	$response = $this->json('PUT', $this->url, ['trabajoActual' => 3]);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'trabajoActual' => [
	    				'El campo trabajo actual es inválido.'
	    			]
    			]
    		]);
    }

	private function init()
	{
		$candidateJobHistory = factory(\ReclutaTI\CandidateJobHistory::class)->create(['current' => 1]);
		$this->candidateEducationHistory = $candidateJobHistory;
		$this->url = $this->url.'/'.$candidateJobHistory->id;
	}
}
