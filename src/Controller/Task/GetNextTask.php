<?php
/**
 * Get Next Task
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

namespace App\Controller\Task;

use App\Exception\TaskException;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Get the next unprocessed task
 */
class GetNextTask extends BaseTask {
    /**
     * Get the first (FIFO) available task to be processed and mark it as "IN PROGRESS"
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $args): Response {
        try {
            $task = $this->getTaskService()->processNextTask();

            return $this->jsonResponse($response, 'success', $task, 200);
        } catch (TaskException $e) {
            return $this->jsonResponse($response, 'error', $e->getMessage(), 400);
        }
    }
}
