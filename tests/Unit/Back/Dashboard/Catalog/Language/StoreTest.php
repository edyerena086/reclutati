<?php

namespace Tests\Unit\Back\Dashboard\Catalog\Language;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class StoreTest extends TestCase
{
	use RefreshDatabase, WithoutMiddleware, WithFaker;
	private $url = "/back/dashboard/catalogs/languages";

    public function test_send_no_data()
    {
    	$response = $this->json('POST', $this->url);

    	$response->assertStatus(422);
    }
}
