<?php

namespace Tests\Unit\Front\Candidate\Dashboard\Curriculum\Address;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class StoreTest extends TestCase
{
	use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/candidate/dashboard/curriculum/addresses";

	public function test_send_no_data()
    {
    	$response = $this->json('POST', $this->url);

    	$response->assertStatus(422);
    }

    public function test_send_no_street()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'calle' => [
	    				'El campo calle es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_external_number()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'numeroExterior' => [
	    				'El campo numero exterior es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_colony()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'colonia' => [
	    				'El campo colonia es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_city()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'ciudad' => [
	    				'El campo ciudad es obligatorio.'
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

    public function test_send_state_not_integer()
    {
    	$response = $this->json('POST', $this->url, ['estado' => 'x01']);

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

    public function test_send_state_not_unique()
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

    public function test_send_no_zipcode()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'codigoPostal' => [
	    				'El campo codigo postal es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_success()
    {
    	$candidate = factory(\ReclutaTI\Candidate::class)->make();

    	Auth::attempt(['email' => $candidate->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'calle' => 'Las arboledas',
    		'numeroExterior' => '4646',
    		'colonia' => 'Vista sol',
    		'ciudad' => 'Monterrey',
    		'estado' => factory(\ReclutaTI\State::class)->create()->id,
    		'codigoPostal' => '66220'
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
