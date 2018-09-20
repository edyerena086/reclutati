<?php

namespace Tests\Unit\Front\Candidate\Dashboard\Curriculum\Address;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/candidate/dashboard/curriculum/addresses";
	private $candidateAddress;

	public function test_send_no_data()
    {
    	$this->init();

    	$response = $this->json('PUT', $this->url);

    	$response->assertStatus(422);
    }

    public function test_send_no_street()
    {
    	$this->init();

    	$response = $this->json('PUT', $this->url);

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
    	$this->init();

    	$response = $this->json('PUT', $this->url);

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
    	$this->init();

    	$response = $this->json('PUT', $this->url);

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
    	$this->init();

    	$response = $this->json('PUT', $this->url);

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
    	$this->init();

    	$response = $this->json('PUT', $this->url);

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
    	$this->init();

    	$response = $this->json('PUT', $this->url, ['estado' => 'x01']);

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
    	$this->init();

    	$response = $this->json('PUT', $this->url, ['estado' => 1000]);

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
    	$this->init();

    	$response = $this->json('PUT', $this->url);

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
        $this->init();

        Auth::attempt(['email' => $this->candidateAddress->candidate()->first()->user()->first()->email, 'password' => 'secret']);

        $data = [
            'calle' => 'Las arboledas',
            'numeroExterior' => '4646',
            'colonia' => 'Vista sol',
            'ciudad' => 'Monterrey',
            'estado' => factory(\ReclutaTI\State::class)->create()->id,
            'codigoPostal' => '66220'
        ];


        $response = $this->json('PUT', $this->url, $data);

        $response
            ->assertStatus(200)
            ->assertJson([
                'errors' => false
            ]);

        Auth::logout();
    }

	private function init()
	{
		$candidateAddress = factory(\ReclutaTI\CandidateAddress::class)->create();
		$this->candidateAddress = $candidateAddress;
		$this->url = $this->url.'/'.$candidateAddress->id;
	}
}
