<?php

namespace Tests\Unit\Front\Recruiter\Account;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class StoreTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/recruiter/account";

	public function test_send_no_data()
    {
    	$response = $this->json('POST', $this->url);

    	$response->assertStatus(422);
    }

    public function test_send_no_name()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'nombre' => [
	    				'El campo nombre es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_last_name()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'apellidoPaterno' => [
	    				'El campo apellido paterno es obligatorio.'
	    			]
    			]
    		]);
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

    public function test_send_no_email_unique()
    {
    	$user = factory(\ReclutaTI\User::class)->create();

    	$response = $this->json('POST', $this->url, ['correoElectronico' => $user->email]);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'correoElectronico' => [
	    				'El campo correo electronico ya ha sido registrado.'
	    			]
    			]
    		]);
    }

    public function test_send_no_password()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'password' => [
	    				'El campo contraseña es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_password_no_correct_length()
    {
    	$response = $this->json('POST', $this->url, ['password' => 'hola']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'password' => [
	    				'El campo contraseña debe contener al menos 8 carácteres.'
	    			]
    			]
    		]);
    }

    public function test_send_password_no_password_confirmed()
    {
    	$response = $this->json('POST', $this->url, ['password' => 'Huo0lpaw@']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'password' => [
	    				'La confirmación del campo nueva contraseña es inválido.'
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

    public function test_send_phone_not_correct_syntax()
    {
    	$response = $this->json('POST', $this->url, ['telefono' => '81mk362452']);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'telefono' => [
	    				'El formato de telefono es inválido.'
	    			]
    			]
    		]);
    }

    public function test_send_no_company()
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

    public function test_success()
    {
    	$data = [
    		'nombre' => $this->faker->firstName,
    		'apellidoPaterno' => $this->faker->lastName,
    		'correoElectronico' => $this->faker->safeEmail,
    		'password' => 'Huo0lpaw@',
    		'password_confirmation' => 'Huo0lpaw@',
    		'telefono' => '(81) 20921234',
    		'empresa' => 'ReclutaTI'
    	];

    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(200)
    		->assertJson([
    			'errors' => false
    		]);
    }
}
