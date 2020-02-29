<?php
/**
 * Abstract Base Controller
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

namespace App\Controller;

use Slim\Container;
use Slim\Http\Response;

/**
 * All controllers/endpoints will extend from this class
 */
abstract class BaseController {
    /**
     * @var Container
     */
    protected $container;

    /**
     * Parses the result and returns to the user
     *
     * @param Response $response
     * @param string $status
     * @param string|array $message
     * @param int $code
     *
     * @return Response
     */
    protected function jsonResponse(Response $response, string $status, $message, int $code):  Response {
        $result = [
            'responseCode' => $code,
            'responseStatus' => $status,
            'message' => $message,
        ];

        return $response->withJson($result, $code, JSON_PRETTY_PRINT);
    }
}
