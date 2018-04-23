<?php

namespace Tests\Functional;

class HomepageTest extends BaseTestCase {
    
    public function testGetUsuario() {
        
        $response = $this->runApp('GET', '/usuario');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains("OK", $response->getReasonPhrase());
        $this->assertContains("1.1", $response->getProtocolVersion());
    }
}