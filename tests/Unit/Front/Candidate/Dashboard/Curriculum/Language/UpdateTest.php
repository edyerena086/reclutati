<?php

namespace Tests\Unit\Front\Candidate\Dashboard\Curriculum\Language;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/candidate/dashboard/curriculum/languages";
	private $candidateLanguage;

	public function test_send_no_data()
    {
    	$this->init();

    	$response = $this->json('POST', $this->url);

    	$response->assertStatus(422);
    }

    public function test_send_no_language()
    {
    	$this->init();

    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'idioma' => [
	    				'El campo idioma es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_language_no_integer()
    {
    	$this->init();

        Auth::attempt(['email' => $this->candidateLanguage->candidate()->first()->user()->first()->email, 'password' => 'secret']);

    	$response = $this->json('POST', $this->url, ['idioma' => 'x001']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'idioma' => [
	    				'El campo idioma debe ser un número entero.'
	    			]
    			]
    		]);

        Auth::logout();
    }

    public function test_send_language_no_exist()
    {
    	$this->init();

        Auth::attempt(['email' => $this->candidateLanguage->candidate()->first()->user()->first()->email, 'password' => 'secret']);

    	$response = $this->json('POST', $this->url, ['idioma' => 10000]);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'idioma' => [
	    				'El campo idioma es inválido.'
	    			]
    			]
    		]);

        Auth::logout();
    }

    public function test_send_no_percent()
    {
    	$this->init();

    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'porcentaje' => [
	    				'El campo porcentaje es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_percent_no_integer()
    {
    	$this->init();

    	$response = $this->json('POST', $this->url, ['porcentaje' => 'x001']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'porcentaje' => [
	    				'El campo porcentaje debe ser un número entero.'
	    			]
    			]
    		]);
    }

    public function test_send_percent_not_in_range()
    {
    	$this->init();

    	$response = $this->json('POST', $this->url, ['porcentaje' => 102]);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'porcentaje' => [
	    				'El porcentaje debe de estar en 1 y 100.'
	    			]
    			]
    		]);
    }

    public function test_success()
    {
    	$this->init();

    	Auth::attempt(['email' => $this->candidateLanguage->candidate()->first()->user()->first()->email, 'password' => 'secret']);

    	$data = [
    		'idioma' => factory(\ReclutaTI\Language::class)->create()->id,
    		'porcentaje' => rand(1, 100)
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
		$candidateLanguage = factory(\ReclutaTI\CandidateLanguage::class)->create();
		$this->candidateLanguage = $candidateLanguage;
		$this->url = $this->url.'/'.$candidateLanguage->id;
	}
}
