<?php
/**
 * Task Service -> Redis Server
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

namespace App\Service;

/**
 * THIS FILE IS NOT BEING USED FOR THIS PROJECT
 * IN CASE WE WANT TO USE CACHE (REDIS), IT COULD BE USEFUL...
 */

/*
class TaskService extends BaseService {
    const REDIS_KEY = 'task:%s';

    protected $taskDAO;

    protected $redisService;

    public function __construct(TaskDAO $taskDAO, RedisService $redisService) {
        $this->taskDAO = $taskDAO;
        $this->redisService = $redisService;
    }

    protected function getTaskDAO() : TaskDAO {
        return $this->taskDAO;
    }

    protected function checkAndGetTask(int $taskId) {
        return $this->getTaskDAO()->checkAndGetTask($taskId);
    }

    public function getTasks() : array {
        return $this->getTaskDAO()->getTasks();
    }

    public function getTask(int $taskId) {
        $key = $this->redisService->generateKey("task:$taskId");
        if ($this->redisService->exists($key)) {
            $task = $this->redisService->get($key);
        } else {
            $task = $this->checkAndGetTask($taskId);
            $this->redisService->setex($key, $task);
        }

        return $task;
    }

    public function createTask(array $input) {
        $task = new \stdClass();
        $data = json_decode(json_encode($input), false);
        if (empty($data->name)) {
            throw new TaskException('The field "name" is required.', 400);
        }
        $task->name = self::validateTaskName($data->name);
        $task->description = null;
        if (isset($data->description)) {
            $task->description = $data->description;
        }
        $task->status = 0;
        if (isset($data->status)) {
            $task->status = self::validateTaskStatus($data->status);
        }
        $tasks = $this->getTaskDAO()->createTask($task);
        $redisKey = sprintf(self::REDIS_KEY, $tasks->id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $tasks);

        return $tasks;
    }

    public function updateTask(array $input, int $taskId) {
        $task = $this->checkAndGetTask($taskId, (int) $input['decoded']->sub);
        $data = json_decode(json_encode($input), false);
        if (!isset($data->name) && !isset($data->status)) {
            throw new TaskException('Enter the data to update the task.', 400);
        }
        if (isset($data->name)) {
            $task->name = self::validateTaskName($data->name);
        }
        if (isset($data->description)) {
            $task->description = $data->description;
        }
        if (isset($data->status)) {
            $task->status = self::validateTaskStatus($data->status);
        }
        $tasks = $this->getTaskDAO()->updateTask($task);
        $redisKey = sprintf(self::REDIS_KEY, $tasks->id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $tasks);

        return $tasks;
    }

    public function deleteTask(int $taskId): string {
        $this->checkAndGetTask($taskId);
        $data = $this->getTaskDAO()->deleteTask($taskId);
        $redisKey = sprintf(self::REDIS_KEY, $taskId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->del($key);

        return $data;
    }
}
*/