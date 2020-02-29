<?php
/**
 * Abstract Base Task
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

namespace App\Controller\Task;

use App\Controller\BaseController;
use App\Service\TaskService;
use Slim\Container;

/**
 * All task function/endpoint will extend from this class
 */
abstract class BaseTask extends BaseController {
    /**
     * Sets the parameter into the BaseController->container variable
     *
     * @param Container $container
     */
    public function __construct(Container $container) {
        $this->container = $container;
    }

    /**
     * Get global 'task_service' from the container
     *
     * @return TaskService
     */
    protected function getTaskService() : TaskService {
        return $this->container->get('task_service');
    }
}
