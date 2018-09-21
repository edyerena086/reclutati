<?php

namespace Tests\Unit\Front\Candidate\Dashboard\Curriculum\JobHistory;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class StoreTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/candidate/dashboard/curriculum/job-histories";

	public function test_send_no_data()
    {
    	$response = $this->json('POST', $this->url);

    	$response->assertStatus(422);
    }

    public function test_send_no_company_name()
    {
    	$response = $this->json('POST', $this->url);

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
    	$response = $this->json('POST', $this->url);

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
    	$response = $this->json('POST', $this->url);

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
    	$response = $this->json('POST', $this->url, ['duracion' => 'x10']);

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
    	$response = $this->json('POST', $this->url);

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
    	$response = $this->json('POST', $this->url);

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
    	$response = $this->json('POST', $this->url, ['trabajoActual' => 'olh']);

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
    	$response = $this->json('POST', $this->url, ['trabajoActual' => 3]);

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

    public function test_success()
    {
    	$candidate = factory(\ReclutaTI\Candidate::class)->create();

    	Auth::attempt(['email' => $candidate->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'empresa' => $this->faker->company,
    		'puesto' => $this->faker->jobTitle,
    		'duracion' => rand(1,3),
    		'descripcion' => $this->faker->paragraph(),
    		'trabajoActual' => 1
    	];


    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(200)
    		->assertJson([
    			'errors' => false
    		]);

    	Auth::logout();
    }
}
