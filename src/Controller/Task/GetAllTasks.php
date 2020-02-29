<?php
/**
 * Get All Tasks
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Get all tasks from the database
 */
class GetAllTasks extends BaseTask {
    /**
     * Process the request and returns the json payload to the user.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $args): Response {
        $tasks = $this->getTaskService()->getTasks();

        return $this->jsonResponse($response, 'success', $tasks, 200);
    }
}
