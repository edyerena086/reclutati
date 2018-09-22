<?php

namespace Tests\Unit\Front\Candidate\Account;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PasswordRecoverTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/candidate/account/password/recover";

	public function test_send_no_data()
    {
    	$response = $this->json('POST', $this->url);

    	$response->assertStatus(422);
    }

    public function test_send_no_email()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'correoElectronico' => [
	    				'El campo correo electronico es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_email_correct_syntax()
    {
    	$response = $this->json('POST', $this->url, ['correoElectronico' => 'no-reply@recluta']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'correoElectronico' => [
	    				'El campo correo electronico no es un correo válido.'
	    			]
    			]
    		]);
    }

    public function test_send_no_email_exist()
    {
    	$response = $this->json('POST', $this->url, ['correoElectronico' => 'no-reply@recluta.com']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'correoElectronico' => [
	    				'El campo correo electronico es inválido.'
	    			]
    			]
    		]);
    }

    public function test_success()
    {
    	$candidate = factory(\ReclutaTI\Candidate::class)->create();

    	$data = [
    		'correoElectronico' => $candidate->user()->first()->email
    	];


    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(200)
    		->assertJson([
    			'errors' => false
    		]);
    }
}
