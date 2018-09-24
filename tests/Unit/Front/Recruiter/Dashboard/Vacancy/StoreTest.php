<?php

namespace Tests\Unit\Front\Recruiter\Dashboard\Vacancy;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class StoreTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/recruiter/dashboard/vacancies";

	public function test_send_no_data()
    {
    	$response = $this->json('POST', $this->url);

    	$response->assertStatus(422);
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

    public function test_send_no_small_description()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'descripcionBreve' => [
	    				'El campo descripcion breve es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_small_description_correct_length()
    {
    	$response = $this->json('POST', $this->url, ['descripcionBreve' => $this->faker->text(500)]);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'descripcionBreve' => [
	    				'El campo descripcion breve no debe ser mayor que 300 carácteres.'
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

    public function test_send_no_job_type()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'tipoDeVacante' => [
	    				'El campo tipo de vacante es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_job_type_integer()
    {
    	$response = $this->json('POST', $this->url, ['tipoDeVacante' => 'hk10']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'tipoDeVacante' => [
	    				'El campo tipo de vacante es inválido.'
	    			]
    			]
    		]);
    }

    public function test_send_no_job_type_exists()
    {
    	$response = $this->json('POST', $this->url, ['tipoDeVacante' => 1000]);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'tipoDeVacante' => [
	    				'El campo tipo de vacante es inválido.'
	    			]
    			]
    		]);
    }

    public function test_send_no_state()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'estado' => [
	    				'El campo estado es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_state_integer()
    {
    	$response = $this->json('POST', $this->url, ['estado' => 'hk10']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'estado' => [
	    				'El campo estado es inválido.'
	    			]
    			]
    		]);
    }

    public function test_send_no_state_exists()
    {
    	$response = $this->json('POST', $this->url, ['estado' => 1000]);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'estado' => [
	    				'El campo estado es inválido.'
	    			]
    			]
    		]);
    }

    public function test_send_no_publish()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'publicar' => [
	    				'El campo publicar es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_publish_integer()
    {
    	$response = $this->json('POST', $this->url, ['publicar' => 'hk10']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'publicar' => [
	    				'El campo publicar es inválido.'
	    			]
    			]
    		]);
    }

    public function test_send_no_publish_in_range()
    {
    	$response = $this->json('POST', $this->url, ['publicar' => 3]);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'publicar' => [
	    				'El campo publicar es inválido.'
	    			]
    			]
    		]);
    }

    public function test_send_no_salary_min_not_numeric()
    {
    	$response = $this->json('POST', $this->url, ['salarioMinimo' => '$192.65']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'salarioMinimo' => [
	    				'El campo salario minimo debe ser numérico.'
	    			]
    			]
    		]);
    }

    public function test_send_no_salary_min_not_correct_syntax()
    {
    	$response = $this->json('POST', $this->url, ['salarioMinimo' => '1192.6542']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'salarioMinimo' => [
	    				'El formato de salario minimo es inválido.'
	    			]
    			]
    		]);
    }

    public function test_send_no_salary_max_not_numeric()
    {
    	$response = $this->json('POST', $this->url, ['salarioMaximo' => '$192.65']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'salarioMaximo' => [
	    				'El campo salario maximo debe ser numérico.'
	    			]
    			]
    		]);
    }

    public function test_send_no_salary_max_not_correct_syntax()
    {
    	$response = $this->json('POST', $this->url, ['salarioMaximo' => '1192.6542']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'salarioMaximo' => [
	    				'El formato de salario maximo es inválido.'
	    			]
    			]
    		]);
    }

    public function test_send_no_educative_level_id()
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

    public function test_send_no_educative_level_id_integer()
    {
        $response = $this->json('POST', $this->url, ['nivelEducativo' => 'hk10']);

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

    public function test_send_no_educative_level_id_exists()
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

    public function test_success()
    {
    	$recruiter = factory(\ReclutaTI\Recruiter::class)->create();

    	Auth::attempt(['email' => $recruiter->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'puesto' => $this->faker->jobTitle,
    		'descripcionBreve' => $this->faker->text(250),
    		'descripcion' => $this->faker->text(1000),
    		'tipoDeVacante' => factory(\ReclutaTI\JobType::class)->create()->id,
    		'estado' => factory(\ReclutaTI\State::class)->create()->id,
    		'publicar' => 1,
            'nivelEducativo' => factory(\ReclutaTI\EducativeLevel::class)->create()->id,
    		'salarioMinimo' => '10000',
    		'salarioMaximo' => '20000'
    	];


    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(200)
    		->assertJson([
    			'errors' => false
    		]);

    	Auth::logout();
    }

    public function test_success_published_vacancy()
    {
    	$recruiter = factory(\ReclutaTI\Recruiter::class)->create();

    	Auth::attempt(['email' => $recruiter->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'puesto' => $this->faker->jobTitle,
    		'descripcionBreve' => $this->faker->text(250),
    		'descripcion' => $this->faker->text(1000),
    		'tipoDeVacante' => factory(\ReclutaTI\JobType::class)->create()->id,
    		'estado' => factory(\ReclutaTI\State::class)->create()->id,
    		'publicar' => 2,
    		'nivelEducativo' => factory(\ReclutaTI\EducativeLevel::class)->create()->id,
    		'salarioMinimo' => '10000',
    		'salarioMaximo' => '20000'
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
