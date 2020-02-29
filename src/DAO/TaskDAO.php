<?php
/**
 * Task DAO (data access object)
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

namespace App\DAO;

use App\Exception\TaskException;
use App\Model\TaskModel;

/**
 * Handles database CRUD operations for the "tasks" table
 */
class TaskDAO extends BaseDAO {
    /**
     * Set the database handler to the parent class
     *
     * @param \PDO $database
     */
    public function __construct(\PDO $database) {
        $this->database = $database;
    }

    /**
     * Check if the given task exists, and returns it to the caller
     *
     * @param int $taskId
     * @return mixed
     * @throws TaskException
     */
    public function checkAndGetTask(int $taskId) {
        $query = "
            SELECT *,
                   CASE
                       WHEN status = 0 THEN '" . TaskModel::STATUS[0] . "'
                       WHEN status = 1 THEN '" . TaskModel::STATUS[1] . "'
                       WHEN status = 2 THEN '" . TaskModel::STATUS[2] . "'
                   END AS statusDescription, 
                   TIMEDIFF(dateTimeCompleted,dateTimeStarted) AS timeToRun
            FROM `tasks`
            WHERE `id` = :id
        ";
        $statement = $this->getDatabase()->prepare($query);
        $statement->bindParam('id', $taskId);
        $statement->execute();
        $task = $statement->fetchObject();
        if (empty($task)) {
            throw new TaskException('Task not found.', 404);
        }

        return $task;
    }

    /**
     * Get all tasks from the database
     *
     * @return array
     */
    public function getTasks() : array {
        $query = "
        SELECT *,
               CASE
                   WHEN status = 0 THEN '" . TaskModel::STATUS[0] . "'
                   WHEN status = 1 THEN '" . TaskModel::STATUS[1] . "'
                   WHEN status = 2 THEN '" . TaskModel::STATUS[2] . "'
               END AS statusDescription,
               TIMEDIFF(dateTimeCompleted,dateTimeStarted) AS timeToRun
        FROM `tasks`
        ORDER BY id
        ";
        $statement = $this->getDatabase()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Get next unprocessed task from the database
     *
     * @return array
     */
    public function getNextTask() : array {
        $query = "
            SELECT *
            FROM `tasks`
            WHERE `processorId` IS NULL
            ORDER BY `dateTimeCreated` LIMIT 1
        ";
        $statement = $this->getDatabase()->prepare($query);
        $statement->execute();

        return $statement->fetch();
    }
    /**
     * Create a new task based on the payload ($task)
     *
     * @param TaskModel $task
     * @return mixed
     * @throws TaskException
     */
    public function createTask(TaskModel $task) {
        $query = '
            INSERT INTO `tasks` (`submitterId`, `status`)
            VALUES (:submitterId, :status)
        ';

        $submitterId = $task->getSubmitterId();
        $status = $task->getStatus();

        $statement = $this->getDatabase()->prepare($query);
        $statement->bindParam('submitterId', $submitterId);
        $statement->bindParam('status', $status);
        $statement->execute();

        return $this->checkAndGetTask((int) $this->database->lastInsertId());
    }

    /**
     * Update the given task based on the payload
     *
     * @param TaskModel $task
     * @return mixed
     * @throws TaskException
     */
    public function updateTask(TaskModel $task) {
        $query = '
            UPDATE `tasks`
            SET `submitterId` = :submitterId,
                `processorId` = :processorId,
                `dateTimeStarted` = :dateTimeStarted,
                `dateTimeCompleted` = :dateTimeCompleted,
                `status` = :status
            WHERE `id` = :id
        ';
        
        $id = $task->getId();
        $submitterId = $task->getSubmitterId();
        $processorId = $task->getProcessorId();
        $dateTimeStarted = $task->getDateTimeStarted();
        $dateTimeCompleted = $task->getDateTimeCompleted();
        $status = $task->getStatus();
        
        $statement = $this->getDatabase()->prepare($query);
        $statement->bindParam('id', $id);
        $statement->bindParam('submitterId', $submitterId);
        $statement->bindParam('processorId', $processorId);
        $statement->bindParam('dateTimeStarted', $dateTimeStarted);
        $statement->bindParam('dateTimeCompleted', $dateTimeCompleted);
        $statement->bindParam('status', $status);
        $statement->execute();

        return $this->checkAndGetTask((int) $task->getId());
    }

    /**
     * Delete a single task
     *
     * @param int $taskId
     * @return string
     */
    public function deleteTask(int $taskId): string {
        $query = 'DELETE FROM `tasks` WHERE `id` = :id';
        $statement = $this->getDatabase()->prepare($query);
        $statement->bindParam('id', $taskId);
        $statement->execute();

        return 'The task was deleted.';
    }
}
