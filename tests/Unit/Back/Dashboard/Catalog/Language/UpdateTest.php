<?php

namespace Tests\Unit\Back\Dashboard\Catalog\Language;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/back/dashboard/catalogs/languages/";
	private $language;

    public function test_send_no_data()
    {
    	$this->init();

    	$response = $this->json('PUT', $this->url);

    	$response->assertStatus(422);
    }

    private function init()
    {
    	$this->language = factory(\ReclutaTI\Language::class)->create();
    	$this->url = $this->url.$this->language->id;
    }
}
