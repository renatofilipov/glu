<?php
/**
 * Task Model
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

namespace App\Model;

/**
 * Handles database CRUD operations for the "tasks" table
 */
class TaskModel extends BaseModel {
    const STATUS = [
        0 => "Unprocessed",
        1 => "In Progress",
        2 => "Completed"
    ];

    /**
     * @var int $id
     */
    private $id;

    /**
     * @var int $submitterId
     */
    private $submitterId;

    /**
     * @var int $processorId
     */
    private $processorId;

    /**
     * @var int $status
     */
    private $status;

    /**
     * @var string $dateTimeCreated
     */
    private $dateTimeCreated;

    /**
     * @var string $dateTimeStarted
     */
    private $dateTimeStarted;

    /**
     * @var string $dateTimeCompleted
     */
    private $dateTimeCompleted;

    /**
     * Setters & Getters to encapsulate Task Model
     */

    public function getId() {
        return $this->id;
    }
    public function setId(?int $id) {
        $this->id = $id;
    }

    public function getSubmitterId() {
        return $this->submitterId;
    }
    public function setSubmitterId(?int $submitterId) {
        $this->submitterId = $submitterId;
    }

    public function getProcessorId() {
        return $this->processorId;
    }
    public function setProcessorId(?int $processorId) {
        $this->processorId = $processorId;
    }

    public function getStatus() {
        return $this->status;
    }
    public function setStatus(?int $status) {
        $this->status = $status;
    }

    public function getDateTimeCreated() {
        return $this->dateTimeCreated;
    }
    public function setDateTimeCreated(?string $dateTimeCreated) {
        $this->dateTimeCreated = $dateTimeCreated;
    }

    public function getDateTimeStarted() {
        return $this->dateTimeStarted;
    }
    public function setDateTimeStarted(?string $dateTimeStarted) {
        $this->dateTimeStarted = $dateTimeStarted;
    }

    public function getDateTimeCompleted() {
        return $this->dateTimeCompleted;
    }
    public function setDateTimeCompleted(?string $dateTimeCompleted) {
        $this->dateTimeCompleted = $dateTimeCompleted;
    }

    /**
     * Populate this model with the $data provided
     * 
     * @param $data
     */
    public function populate($data) {
        if (gettype($data) === 'object') {
            $data = json_decode(json_encode($data), true);
        }
        if (!empty($data["id"])) {
            $this->setId($data["id"]);
        }
        if (!empty($data["submitterId"])) {
            $this->setSubmitterId($data["submitterId"]);
        }
        if (!empty($data["processorId"])) {
            $this->setProcessorId($data["processorId"]);
        }
        if (!empty($data["status"])) {
            $this->setStatus($data["status"]);
        }
        if (!empty($data["dateTimeCreated"])) {
            $this->setDateTimeCreated($data["dateTimeCreated"]);
        }
        if (!empty($data["dateTimeStarted"])) {
            $this->setDateTimeStarted($data["dateTimeStarted"]);
        }
        if (!empty($data["dateTimeCompleted"])) {
            $this->setDateTimeCompleted($data["dateTimeCompleted"]);
        }
    }
}
