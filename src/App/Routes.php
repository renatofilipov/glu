<?php
/**
 * Route set-up for our API endpoints
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

$app->get('/', 'App\Controller\DefaultController:getEndpoints');
$app->get('/status', 'App\Controller\DefaultController:getStatus');

$app->group('/api/v1', function () use ($app) {
    $app->group('/task', function () use ($app) {
        $app->get('', 'App\Controller\Task\GetAllTasks');
        $app->get('/next', 'App\Controller\Task\GetNextTask');
        $app->get('/[{id}]', 'App\Controller\Task\GetOneTask');
        $app->post('', 'App\Controller\Task\CreateTask');
        $app->put('/[{id}]', 'App\Controller\Task\UpdateTask');
        $app->delete('/[{id}]', 'App\Controller\Task\DeleteTask');
    });
});

$app->group('/client', function () use ($app) {
    $app->group('/task', function () use ($app) {
        $app->get('/create', 'App\Controller\ClientController:getCreateTaskPage');
    });
});