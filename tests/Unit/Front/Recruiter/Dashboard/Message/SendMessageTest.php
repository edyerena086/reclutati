<?php

namespace Tests\Unit\Front\Recruiter\Dashboard\Message;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SendMessageTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "recruiter/dashboard/vacancies/cadndidates/message/";
	private $candidate;

	public function test_send_no_data()
    {
    	$this->init();

    	$response = $this->json('POST', $this->url);

    	$response->assertStatus(422);
    }

    public function test_send_no_title()
    {
    	$this->init();

    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'title' => [
	    				'El campo título es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_message()
    {
    	$this->init();

    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'message' => [
	    				'El campo mensaje es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_success()
    {
    	$this->init();

    	$recruiter = factory(\ReclutaTI\Recruiter::class)->create();

    	Auth::attempt(['email' => $recruiter->user->email, 'password' => 'secret']);

    	$data = [
    		'title' => $this->faker->realText(35),
    		'message' => $this->faker->realText(250)
    	];

    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(200)
    		->assertJson([
    			'errors' => false
    		]);

    	Auth::logout();

    }

	private function init()
	{
		$this->candidate = factory(\ReclutaTI\Candidate::class)->create();

		$this->url .= $this->candidate->id;
	}
}
