<?php

namespace Tests\Unit\Front\Candidate\Dashboard\Curriculum\EducationHistory;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class StoreTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/candidate/dashboard/curriculum/educative-histories";

	public function test_send_no_data()
    {
    	$response = $this->json('POST', $this->url);

    	$response->assertStatus(422);
    }

    public function test_send_no_school_name()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'institucionEducativa' => [
	    				'El campo institucion educativa es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_educative_level()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'nivelEducativo' => [
	    				'El campo nivel educativo es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_educative_level_not_integer()
    {
    	$response = $this->json('POST', $this->url, ['nivelEducativo' => 'olh']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'nivelEducativo' => [
	    				'El campo nivel educativo debe ser un número entero.'
	    			]
    			]
    		]);
    }

    public function test_send_educative_level_not_exists()
    {
    	$response = $this->json('POST', $this->url, ['nivelEducativo' => 1000]);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'nivelEducativo' => [
	    				'El campo nivel educativo es inválido.'
	    			]
    			]
    		]);
    }

    public function test_send_no_degree()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'tituloObtenido' => [
	    				'El campo titulo obtenido es obligatorio.'
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
    				'estudiandoActualmente' => [
	    				'El campo estudiando actualmente es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_current_not_integer()
    {
    	$response = $this->json('POST', $this->url, ['estudiandoActualmente' => 'olh']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'estudiandoActualmente' => [
	    				'El campo estudiando actualmente debe ser un número entero.'
	    			]
    			]
    		]);
    }

    public function test_send_current_not_in_range()
    {
    	$response = $this->json('POST', $this->url, ['estudiandoActualmente' => 3]);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'estudiandoActualmente' => [
	    				'El valor ingresado es inválido.'
	    			]
    			]
    		]);
    }

    public function test_send_current_whit_previous()
    {
    	$candidate = factory(\ReclutaTI\Candidate::class)->create();

    	Auth::attempt(['email' => $candidate->user()->first()->email, 'password' => 'secret']);

    	$candidateEducation = factory(\ReclutaTI\CandidateEducationHistory::class)->create(['candidate_id' => $candidate->id, 'current' => 1]);

    	$data = [
    		'institucionEducativa' => 'Santiago Roel',
    		'nivelEducativo' => factory(\ReclutaTI\EducativeLevel::class)->create()->id,
    		'tituloObtenido' => 'Certificado de primaria.',
    		'descripcion' => $this->faker->paragraph(),
    		'estudiandoActualmente' => 2
    	];


    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'estudiandoActualmente' => [
	    				'Ya tienes otro historial educativo como actualmente estudiando.'
	    			]
    			]
    		]);

    	Auth::logout();
    }

    public function test_success_not_description()
    {
    	$candidate = factory(\ReclutaTI\Candidate::class)->create();

    	Auth::attempt(['email' => $candidate->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'institucionEducativa' => 'Santiago Roel',
    		'nivelEducativo' => factory(\ReclutaTI\EducativeLevel::class)->create()->id,
    		'tituloObtenido' => 'Certificado de primaria.',
    		'estudiandoActualmente' => 1
    	];


    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(200)
    		->assertJson([
    			'errors' => false
    		]);

    	Auth::logout();
    }

    public function test_success()
    {
    	$candidate = factory(\ReclutaTI\Candidate::class)->create();

    	Auth::attempt(['email' => $candidate->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'institucionEducativa' => 'Santiago Roel',
    		'nivelEducativo' => factory(\ReclutaTI\EducativeLevel::class)->create()->id,
    		'tituloObtenido' => 'Certificado de primaria.',
    		'descripcion' => $this->faker->paragraph(),
    		'estudiandoActualmente' => 1
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
