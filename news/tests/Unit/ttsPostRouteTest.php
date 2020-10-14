<?php

namespace Tests\Unit;

use Tests\TestCase;

class ttsPostRouteTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->postJson('api/tts', ['text' => 'Mì tôm']);

        $response->assertStatus(200);
    }
}
