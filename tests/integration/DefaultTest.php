<?php
/**
 * Default Test Case
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

namespace Tests\integration;

/**
 * Tests the two main endpoints ("/" and "/status")
 */
class DefaultTest extends BaseTestCase {

    /**
     * Test that default endpoint ("/") shows the correct information
     */
    public function testApiHelp() {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('responseStatus', (string) $response->getBody());
        $this->assertStringContainsString('success', (string) $response->getBody());
        $this->assertStringContainsString('version', (string) $response->getBody());
        $this->assertStringContainsString('time', (string) $response->getBody());
        $this->assertStringContainsString('endpoints', (string) $response->getBody());
        $this->assertStringNotContainsString('ERROR', (string) $response->getBody());
        $this->assertStringNotContainsString('Failed', (string) $response->getBody());
    }

    /**
     * Test that status endpoint, show the API status.
     */
    public function testStatus() {
        $response = $this->runApp('GET', '/status');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('responseStatus', (string) $response->getBody());
        $this->assertStringContainsString('success', (string) $response->getBody());
        $this->assertStringContainsString('version', (string) $response->getBody());
        $this->assertStringContainsString('time', (string) $response->getBody());
        $this->assertStringContainsString('db', (string) $response->getBody());
        $this->assertStringNotContainsString('ERROR', (string) $response->getBody());
        $this->assertStringNotContainsString('Failed', (string) $response->getBody());
    }
}
