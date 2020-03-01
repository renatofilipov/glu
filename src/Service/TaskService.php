<?php
/**
 * Task Service
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

namespace App\Service;

use App\Exception\TaskException;
use App\DAO\TaskDAO;
use App\Model\TaskModel;

/**
 * Business logic for all task operations
 */
class TaskService extends BaseService {
    /**
     * @var TaskDAO $taskDAO
     */
    protected $taskDAO;

    /**
     * TaskService constructor
     *
     * @param TaskDAO $taskDAO
     */
    public function __construct(TaskDAO $taskDAO) {
        $this->taskDAO = $taskDAO;
    }

    /**
     * @return TaskDAO
     */
    protected function getTaskDAO() : TaskDAO {
        return $this->taskDAO;
    }

    /**
     * Check if the given task exists, and returns it to the caller
     *
     * @param int $taskId
     * @return mixed
     * @throws TaskException
     */
    protected function checkAndGetTask(int $taskId) {
        return $this->getTaskDAO()->checkAndGetTask($taskId);
    }

    /**
     * Get all tasks
     *
     * @return array
     */
    public function getTasks() : array {
        return $this->getTaskDAO()->getTasks();
    }

    /**
     * Get only the given task id
     *
     * @param int $taskId
     * @return mixed
     * @throws TaskException
     */
    public function getTask(int $taskId) {
        return $this->checkAndGetTask($taskId);
    }

    /**
     * Gets the first available task to be processed and start it
     *
     * @throws TaskException
     *
     * @return array
     */
    public function processNextTask() {
        $nextTask = $this->getTaskDAO()->getNextTask();

        $task = new TaskModel();
        $task->populate($nextTask);
        $task->setProcessorId(rand());
        $task->setStatus(self::STATUS_PROCESSING);
        $task->setDateTimeStarted((new \DateTime())->format('Y-m-d H:i:s'));

        /*
         * here is where the business logic would be placed
         * for this assessment, I'm setting a random "DateTimeCompleted",
         * simulating when the actual job would finish in order to have a "processed time statistics"
         */
        $dateCompleted = new \DateTime();
        $dateCompleted->add(new \DateInterval("PT" . rand(0, 3600) . "S"));
        $task->setDateTimeCompleted($dateCompleted->format('Y-m-d H:i:s'));
        $task->setStatus(self::STATUS_DONE);

        return $this->getTaskDAO()->updateTask($task);
    }

    /**
     * Create a new task
     *
     * @param array $input
     * @return mixed
     * @throws TaskException
     */
    public function createTask(array $input) {
        $task = new TaskModel();
        $data = json_decode(json_encode($input), false);
        if (empty($data->submitterId)) {
            throw new TaskException('The field "submitterId" is required.', 400);
        }
        $task->setSubmitterId($data->submitterId);
        if (!empty($data->processorId)) {
            $task->setProcessorId($data->processorId);
        }
        $task->setProcessorId(null);
        $task->setDateTimeCompleted(null);
        $task->setStatus(BaseService::STATUS_NEW);

        // create one or multiple tasks, depending on the client call
        $data->tasks = empty($data->tasks) ? 1 : intval($data->tasks);
        $lastTask = [];
        for ($i = 0; $i < $data->tasks; $i++) {
            $lastTask = $this->getTaskDAO()->createTask($task);
        }
        return $lastTask;
    }

    /**
     * Update the given task
     *
     * @param $input
     * @param int $taskId
     * @return mixed
     * @throws TaskException
     */
    public function updateTask($input, int $taskId) {
        $task = new TaskModel();
        $task->populate($this->checkAndGetTask($taskId));

        $data = json_decode(json_encode($input), false);
        if (!isset($data->processorId) && !isset($data->submitterId) && !isset($data->status)) {
            throw new TaskException('Enter the data to update the task.', 400);
        }
        if (isset($data->processorId)) {
            $task->setProcessorId($data->processorId);
        }
        if (isset($data->submitterId)) {
            $task->setSubmitterId($data->submitterId);
        }
        if (isset($data->status)) {
            $task->setStatus(self::validateTaskStatus($data->status));
        }
        if (isset($data->dateTimeStarted)) {
            $task->setDateTimeStarted($data->dateTimeStarted);
        }
        if (isset($data->dateTimeCompleted)) {
            $task->setDateTimeCompleted($data->dateTimeCompleted);
        }
        return $this->getTaskDAO()->updateTask($task);
    }

    /**
     * Delete the task id provided
     *
     * @param int $taskId
     * @return string
     * @throws TaskException
     */
    public function deleteTask(int $taskId): string {
        $this->checkAndGetTask($taskId);
        return $this->getTaskDAO()->deleteTask($taskId);
    }
}
