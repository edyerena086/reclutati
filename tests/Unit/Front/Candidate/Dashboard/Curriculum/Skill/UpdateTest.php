<?php

namespace Tests\Unit\Front\Candidate\Dashboard\Curriculum\Skill;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/candidate/dashboard/curriculum/skills";
	private $candidateSkill;

	public function test_send_no_data()
    {
    	$this->init();

    	$response = $this->json('PUT', $this->url);

    	$response->assertStatus(422);
    }

    public function test_send_no_skill()
    {
    	$this->init();

    	$response = $this->json('PUT', $this->url);

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
    	$this->init();

    	$response = $this->json('PUT', $this->url);

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
    	$this->init();

    	$response = $this->json('PUT', $this->url, ['nivel' => 'x1l']);

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
    	$this->init();

    	$response = $this->json('PUT', $this->url, ['nivel' => 1000]);

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
    	$this->init();

    	$login = Auth::attempt(['email' => $this->candidateSkill->candidate()->first()->user()->first()->email, 'password' => 'secret']);

        $this->assertEquals($login, true);

    	$data = [
    		'habilidad' => 'PHP',
    		'nivel' => factory(\ReclutaTI\SkillLevel::class)->create()->id
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
		$candidateSkill = factory(\ReclutaTI\CandidateSkill::class)->create();
		$this->candidateSkill = $candidateSkill;
		$this->url = $this->url.'/'.$candidateSkill->id;
	}
}
