<?php

namespace Tests\Unit\Front\Recruiter\Dashboard\Company;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/recruiter/dashboard/company/update";

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

    public function test_send_no_phone()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'telefono' => [
	    				'El campo telefono es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_phone_correct_syntax()
    {
    	$response = $this->json('POST', $this->url, ['telefono' => '83d342043']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'telefono' => [
	    				'El formato de teléfono es inválido.'
	    			]
    			]
    		]);
    }

    public function test_success()
    {
    	$recruiter = factory(\ReclutaTI\Recruiter::class)->create();
    	$companyContact = factory(\ReclutaTI\CompanyContact::class)->create(['recruiter_id' => $recruiter->id]);

    	Auth::attempt(['email' => $recruiter->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'empresa' => $this->faker->company,
    		'telefono' => '(81) 20921234'
    	];


    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(200)
    		->assertJson([
    			'errors' => false
    		]);

    	Auth::logout();
    }

    public function test_success_complete()
    {
    	$recruiter = factory(\ReclutaTI\Recruiter::class)->create();
    	$companyContact = factory(\ReclutaTI\CompanyContact::class)->create(['recruiter_id' => $recruiter->id]);

    	Auth::attempt(['email' => $recruiter->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'empresa' => $this->faker->company,
    		'telefono' => '(81) 20921234',
    		'acercaDe' => $this->faker->text(150)
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
