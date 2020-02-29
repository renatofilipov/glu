<?php
/**
 * Test Task Service
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

namespace Tests\integration;

/**
 * Class TaskServiceTest (Redis server is ignored)
 */
class TaskServiceTest extends BaseTestCase {
    /**
     * @var int $id The tested ID we created and will eventually delete later
     */
    private static $id;

    /**
     * @return \PDO
     */
    private function getDatabase() {
        $database = sprintf('mysql:host=%s;dbname=%s', getenv('DB_HOSTNAME'), getenv('DB_DATABASE'));
        return new \PDO($database, getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
    }

    /**
     * Test Get Task
     *
     * @throws \App\Exception\TaskException
     */
    public function testGetTask() {
        // $redisService = new \App\Service\RedisService(new \Predis\Client());
        // $taskService = new \App\Service\TaskService($taskDAO, $redisService);
        $taskDAO = new \App\DAO\TaskDAO($this->getDatabase());
        $taskService = new \App\Service\TaskService($taskDAO);
        $task = $taskService->getTask(1);
        $this->assertStringContainsString('8', $task->submitterId);
    }

    /**
     * Test Create Task
     *
     * @throws \App\Exception\TaskException
     */
    public function testCreateTask() {
        // $redisService = new \App\Service\RedisService(new \Predis\Client());
        // $taskService = new \App\Service\TaskService($taskDAO, $redisService);
        $taskDAO = new \App\DAO\TaskDAO($this->getDatabase());
        $taskService = new \App\Service\TaskService($taskDAO);
        $input = ['submitterId' => '8', 'processorId' => '1'];
        $task = $taskService->createTask($input);
        self::$id = $task->id;
        $this->assertStringContainsString('8', $task->submitterId);
    }

    /**
     * Test Create Task Without Required Fields
     *
     * @throws \App\Exception\TaskException
     */
    public function testCreateTaskWithoutRequiredFieldsExpectError() {
        $this->expectException(\App\Exception\TaskException::class);

        // $redisService = new \App\Service\RedisService(new \Predis\Client());
        // $taskService = new \App\Service\TaskService($taskDAO, $redisService);
        $taskDAO = new \App\DAO\TaskDAO($this->getDatabase());
        $taskService = new \App\Service\TaskService($taskDAO);
        $input = ['dummy' => 'field', 'another' => 'data'];
        $taskService->createTask($input);
    }

    /**
     * Test Delete Task
     *
     * @throws \App\Exception\TaskException
     */
    public function testDeleteTask() {
        // $redisService = new \App\Service\RedisService(new \Predis\Client());
        // $taskService = new \App\Service\TaskService($taskDAO, $redisService);
        $taskDAO = new \App\DAO\TaskDAO($this->getDatabase());
        $taskService = new \App\Service\TaskService($taskDAO);
        $taskId = self::$id;
        $task = $taskService->deleteTask((int) $taskId);
        $this->assertStringContainsString('The task was deleted.', $task);
    }
}
