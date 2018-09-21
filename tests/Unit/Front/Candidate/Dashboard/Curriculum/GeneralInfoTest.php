<?php

namespace Tests\Unit\Front\Candidate\Dashboard\Curriculum;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class GeneralInfoTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/candidate/dashboard/curriculum/general-info";

	public function test_send_no_data()
    {
    	$response = $this->json('POST', $this->url);

    	$response->assertStatus(422);
    }

    public function test_send_no_first_name()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'primerNombre' => [
	    				'El campo primer nombre es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_last_name()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'apellidoPaterno' => [
	    				'El campo apellido paterno es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_age_alpha()
    {
    	$response = $this->json('POST', $this->url, ['edad' => 'h1l']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'edad' => [
	    				'El campo edad debe ser un número entero.'
	    			]
    			]
    		]);
    }

    public function test_send_age_out_of_range()
    {
    	$response = $this->json('POST', $this->url, ['edad' => 12]);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'edad' => [
	    				'Debes de tener entre 16 y 85 años de edad.'
	    			]
    			]
    		]);
    }

    public function test_send_gender_alpha()
    {
    	$response = $this->json('POST', $this->url, ['genero' => 'h1l']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'genero' => [
	    				'El campo genero debe ser un número entero.'
	    			]
    			]
    		]);
    }

    public function test_send_gender_not_exists()
    {
    	$response = $this->json('POST', $this->url, ['genero' => 1000]);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'genero' => [
	    				'El campo genero es inválido.'
	    			]
    			]
    		]);
    }

    public function test_send_civil_status_alpha()
    {
        $response = $this->json('POST', $this->url, ['estadoCivil' => 'h1l']);

        $response
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'estadoCivil' => [
                        'El campo estado civil debe ser un número entero.'
                    ]
                ]
            ]);
    }

    public function test_send_civil_status_not_exists()
    {
        $response = $this->json('POST', $this->url, ['estadoCivil' => 1000]);

        $response
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'estadoCivil' => [
                        'El campo estado civil es inválido.'
                    ]
                ]
            ]);
    }

    public function test_success_with_no_second_name()
    {
    	$candidate = factory(\ReclutaTI\Candidate::class)->create();

    	Auth::attempt(['email' => $candidate->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'primerNombre' => $candidate->user()->first()->name,
    		'apellidoPaterno' => $candidate->last_name,
    		'apellidoMaterno' => $this->faker->lastName,
    		'edad' => rand(16, 85),
    		'genero' => factory(\ReclutaTI\Gender::class)->create()->id
    	];


    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(200)
    		->assertJson([
    			'errors' => false
    		]);

    	Auth::logout();
    }

    public function test_success_with_no_second_last_name()
    {
    	$candidate = factory(\ReclutaTI\Candidate::class)->create();

    	Auth::attempt(['email' => $candidate->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'primerNombre' => $candidate->user()->first()->name,
    		'segundoNombre' => $this->faker->firstName,
    		'apellidoPaterno' => $candidate->last_name,
    		'edad' => rand(16, 85),
    		'genero' => factory(\ReclutaTI\Gender::class)->create()->id
    	];


    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(200)
    		->assertJson([
    			'errors' => false
    		]);

    	Auth::logout();
    }

    public function test_success_with_no_second_age()
    {
    	$candidate = factory(\ReclutaTI\Candidate::class)->create();

    	Auth::attempt(['email' => $candidate->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'primerNombre' => $candidate->user()->first()->name,
    		'segundoNombre' => $this->faker->firstName,
    		'apellidoPaterno' => $candidate->last_name,
    		'apellidoMaterno' => $this->faker->lastName,
    		'genero' => factory(\ReclutaTI\Gender::class)->create()->id
    	];


    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(200)
    		->assertJson([
    			'errors' => false
    		]);

    	Auth::logout();
    }

    public function test_success_with_no_second_gender()
    {
    	$candidate = factory(\ReclutaTI\Candidate::class)->create();

    	Auth::attempt(['email' => $candidate->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'primerNombre' => $candidate->user()->first()->name,
    		'segundoNombre' => $this->faker->firstName,
    		'apellidoPaterno' => $candidate->last_name,
    		'apellidoMaterno' => $this->faker->lastName,
    		'edad' => rand(16, 85)
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
    		'primerNombre' => $candidate->user()->first()->name,
    		'segundoNombre' => $this->faker->firstName,
    		'apellidoPaterno' => $candidate->last_name,
    		'apellidoMaterno' => $this->faker->lastName,
    		'edad' => rand(16, 85),
    		'genero' => factory(\ReclutaTI\Gender::class)->create()->id,
            'estadoCivil' => factory(\ReclutaTI\CivilStatus::class)->create()->id
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
