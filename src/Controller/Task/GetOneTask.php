<?php
/**
 * Get One Task
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Get a single task (parameter 'id' from the API call)
 */
class GetOneTask extends BaseTask {
    /**
     * Process the request and returns the json payload to the user.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return Response
     * @throws \App\Exception\TaskException
     */
    public function __invoke(Request $request, Response $response, array $args): Response {
        $taskId = (int) $args['id'];
        $task = $this->getTaskService()->getTask($taskId);

        return $this->jsonResponse($response, 'success', $task, 200);
    }
}
