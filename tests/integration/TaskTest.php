<?php
/**
 * Task Tests
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

namespace Tests\integration;

/**
 * Test all task operations
 */
class TaskTest extends BaseTestCase {
    private static $id;

    /**
     * Test Get All Tasks.
     */
    public function testGetTasks() {
        $response = $this->runApp('GET', '/api/v1/task');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('submitterId', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Get One Task.
     */
    public function testGetTask() {
        $response = $this->runApp('GET', '/api/v1/task/1');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('submitterId', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Get Task Not Found.
     */
    public function testGetTaskNotFound() {
        $response = $this->runApp('GET', '/api/v1/task/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create Task.
     */
    public function testCreateTask() {
        $response = $this->runApp(
            'POST', '/api/v1/task', ['submitterId' => '8']
        );

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->message->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('submitterId', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Get Task Created.
     */
    public function testGetTaskCreated() {
        $response = $this->runApp('GET', '/api/v1/task/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('submitterId', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Create Task Without Name.
     */
    public function testCreateTaskWithOutTaskName() {
        $response = $this->runApp('POST', '/api/v1/task');

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create Task With Invalid TaskName.
     */
    public function testCreateTaskWithInvalidTaskName() {
        $response = $this->runApp(
            'POST', '/api/v1/task', ['name' => 'z', 'status' => 1]
        );

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create Task With Invalid Status.
     */
    public function testCreateTaskWithInvalidStatus() {
        $response = $this->runApp(
            'POST', '/api/v1/task', ['name' => 'ToDo', 'status' => 123]
        );

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Update Task.
     */
    public function testUpdateTask() {
        $response = $this->runApp(
            'PUT', '/api/v1/task/' . self::$id,
            ['status' => 1]
        );

        $result = (string) $response->getBody();

        echo $response->getBody();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('submitterId', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Update Task Without Send Data.
     */
    public function testUpdateTaskWithOutSendData() {
        $response = $this->runApp('PUT', '/api/v1/task/1');
        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Update Task Not Found.
     */
    public function testUpdateTaskNotFound() {
        $response = $this->runApp(
            'PUT', '/api/v1/task/123456789', ['name' => 'Task']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Delete Task.
     */
    public function testDeleteTask() {
        $response = $this->runApp('DELETE', '/api/v1/task/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Delete Task Not Found.
     */
    public function testDeleteTaskNotFound() {
        $response = $this->runApp('DELETE', '/api/v1/task/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringContainsString('error', $result);
    }
}
