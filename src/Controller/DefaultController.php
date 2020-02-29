<?php
/**
 * Default Controller
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */
namespace App\Controller;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Called when user hits "/" or "/status" endpoints
 */
class DefaultController extends BaseController {
    const API_VERSION = '1.0';

    /**
     * Sets the parameter into the BaseController->container variable
     *
     * @param Container $container
     */
    public function __construct(Container $container) {
        $this->container = $container;
    }

    /**
     * This endpoint will be hit when user access "/" url
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return Response
     */
    public function getEndpoints(Request $request, Response $response, array $args): Response {
        $url = getenv('APP_DOMAIN');
        $endpoints = [
            'read me' => 'https://github.com/renatofilipov/glu/blob/master/README.md',
            'show all tasks' => $url . '/api/v1/task',
            'get task id = 1' => $url . '/api/v1/task/1',
            'process next task' => $url . '/api/v1/task/next',
            'client to create tasks' => $url . '/client/task/create',
            'API status' => $url . '/status',
            'this page' => $url . '',
        ];
        $message = [
            'endpoints' => $endpoints,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $this->jsonResponse($response, 'success', $message, 200);
    }

    /**
     * This endpoint will be hit when user access "/status" url
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return Response
     */
    public function getStatus(Request $request, Response $response, array $args): Response {
        $taskService = $this->container->get('task_service');
        $db = [
            'tasks' => count($taskService->getTasks()),
        ];
        $status = [
            'db' => $db,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $this->jsonResponse($response, 'success', $status, 200);
    }
}
