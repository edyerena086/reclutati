<?php

namespace Tests\Unit\Front\Candidate\Dashboard\Settings;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PasswordTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/candidate/dashboard/settings/password";

	public function test_send_no_data()
    {
    	$response = $this->json('POST', $this->url);

    	$response->assertStatus(422);
    }

    public function test_send_no_current_password()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'currentPassword' => [
	    				'El campo contraseña actual es obligatorio.'
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
                        'El campo nueva contraseña es obligatorio.'
                    ]
                ]
            ]);
    }

    public function test_send_no_correct_password_length()
    {
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
        $response = $this->json('POST', $this->url, ['password' => 'Mku8njdro0@']);

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

    public function test_success()
    {
        $candidate = factory(\ReclutaTI\Candidate::class)->create();

        Auth::attempt(['email' => $candidate->first()->user()->first()->email, 'password' => 'secret']);

        $data = [
            'currentPassword' => 'secret',
            'password' => 'Huo0lpaw@',
            'password_confirmation' => 'Huo0lpaw@'
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
