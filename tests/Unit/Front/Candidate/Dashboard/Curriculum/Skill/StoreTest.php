<?php

namespace Tests\Unit\Front\Candidate\Dashboard\Curriculum\Skill;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class StoreTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/candidate/dashboard/curriculum/skills";

	public function test_send_no_data()
    {
    	$response = $this->json('POST', $this->url);

    	$response->assertStatus(422);
    }

    public function test_send_no_skill()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'habilidad' => [
	    				'El campo habilidad es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_skill_level()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'nivel' => [
	    				'El campo nivel es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_skill_level_not_integer()
    {
    	$response = $this->json('POST', $this->url, ['nivel' => 'x1l']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'nivel' => [
	    				'El campo nivel es inválido.'
	    			]
    			]
    		]);
    }

    public function test_send_skill_level_not_exists()
    {
    	$response = $this->json('POST', $this->url, ['nivel' => 1000]);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'nivel' => [
	    				'El campo nivel es inválido.'
	    			]
    			]
    		]);
    }

    public function test_success()
    {
    	$candidate = factory(\ReclutaTI\Candidate::class)->create();

    	Auth::attempt(['email' => $candidate->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'habilidad' => 'PHP',
    		'nivel' => factory(\ReclutaTI\SkillLevel::class)->create()->id
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
