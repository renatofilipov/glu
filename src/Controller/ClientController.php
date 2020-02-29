<?php
/**
 * Client Controller
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */
namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Simply prepare a page to POST and create tasks without having to use Postman
 */
class ClientController {

    /**
     * This is a very simple client to POST and create tasks
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return Response
     */
    public function getCreateTaskPage(Request $request, Response $response, array $args): Response {
        $form = "
            <form method='POST' action='/api/v1/task'>
                <p>How many tasks do you want to create?</p>
                <p><input type='number' min='1' value='1' name='tasks' /></p>
                <br/>

                <p>Submitter ID</p>
                <p><input type='number' min='0' value='0' name='submitterId' /></p>
                <br/>

                <p><input type='submit' /></p>
            </form>
        ";

        $response->write($form);

        return $response;
    }
}
