<?php

namespace Tests\Unit\Front\Candidate\Account;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/candidate/account/password/reset";
	private $candidate;

	public function test_send_no_data()
    {
    	$this->init();

    	$response = $this->json('POST', $this->url);

    	$response->assertStatus(422);
    }

    public function test_send_no_password()
    {
    	$this->init();

    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'password' => [
	    				'El campo nueva contraseña es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_password_correct_length()
    {
    	$this->init();

    	$response = $this->json('POST', $this->url, ['password' => 'hola']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'password' => [
	    				'El campo nueva contraseña debe contener al menos 8 carácteres.'
	    			]
    			]
    		]);
    }

    public function test_send_no_password_confirmation()
    {
    	$this->init();

    	$response = $this->json('POST', $this->url, ['password' => 'Mku8njdro0@']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'password' => [
	    				'La confirmación del campo nueva contraseña es inválida.'
	    			]
    			]
    		]);
    }

    public function test_success()
    {
    	$this->init();

    	$data = [
    		'password' => 'Mku8njdro0@',
    		'password_confirmation' => 'Mku8njdro0@'
    	];


    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(200)
    		->assertJson([
    			'errors' => false
    		]);
    }

    private function init()
	{
		$candidate = factory(\ReclutaTI\Candidate::class)->create();
		$this->candidate = $candidate;
		$this->url = $this->url.'/'.$candidate->id;
	}
}
