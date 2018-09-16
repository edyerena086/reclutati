<?php

namespace Tests\Unit\Front\Candidate\Dashboard\Curriculum\ContactInfo;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SocialMediaTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/candidate/dashboard/curriculum/social-media";

	public function test_send_no_data()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(200)
    		->assertJson([
    			'errors' => true,
    			'message' => 'No hay nada que actualizar.',
    			'error_code' => 'sm0001'
    		]);
    }

    public function test_send_website_incorrect_syntax()
    {
    	$response = $this->json('POST', $this->url, ['website' => 'www.google.com']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'website' => [
	    				'El formato de website es inválido.'
	    			]
    			]
    		]);
    }

    public function test_success_not_website()
    {
    	$candidate = factory(\ReclutaTI\Candidate::class)->create();

    	Auth::attempt(['email' => $candidate->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'facebook' => 'reclutati',
    		'twitter' => 'reclutatiMx',
    		'linkedin' => 'reclutati'
    	];


    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(200)
    		->assertJson([
    			'errors' => false
    		]);

    	Auth::logout();
    }

    public function test_success_not_facebook()
    {
    	$candidate = factory(\ReclutaTI\Candidate::class)->create();

    	Auth::attempt(['email' => $candidate->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'website' => 'http://reclutati.com',
    		'twitter' => 'reclutatiMx',
    		'linkedin' => 'reclutati'
    	];


    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(200)
    		->assertJson([
    			'errors' => false
    		]);

    	Auth::logout();
    }

    public function test_success_not_twitter()
    {
    	$candidate = factory(\ReclutaTI\Candidate::class)->create();

    	Auth::attempt(['email' => $candidate->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'website' => 'http://www.reclutati.com',
    		'facebook' => 'reclutatiMx',
    		'linkedin' => 'reclutati'
    	];


    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(200)
    		->assertJson([
    			'errors' => false
    		]);

    	Auth::logout();
    }

    public function test_success_not_linkedin()
    {
    	$candidate = factory(\ReclutaTI\Candidate::class)->create();

    	Auth::attempt(['email' => $candidate->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'website' => 'http://www.reclutati.com',
    		'facebook' => 'reclutatiMx',
    		'twitter' => 'reclutati'
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
    		'website' => 'http://www.reclutati.com',
    		'facebook' => 'reclutatiMx',
    		'twitter' => 'reclutatiMx',
    		'linkedin' => 'reclutati'
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
