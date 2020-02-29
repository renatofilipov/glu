<?php
/**
 * Create Task
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

namespace App\Controller\Task;

use App\Exception\TaskException;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Create a single task
 */
class CreateTask extends BaseTask {
    /**
     * Process the request and returns the json payload to the user.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return Response
     * @throws TaskException
     */
    public function __invoke(Request $request, Response $response, array $args): Response {
        $input = $request->getParsedBody();
        if (empty($input)) {
            throw new TaskException('Input cannot be empty.', 400);
        }
        $task = $this->getTaskService()->createTask($input);

        return $this->jsonResponse($response, 'success', $task, 201);
    }
}
