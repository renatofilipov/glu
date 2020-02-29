<?php
/**
 * Load all services
 * For this project, only the jobs/task service will be necessary
 * Line 17 is commented because we are not using redis server here
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

use Psr\Container\ContainerInterface;
use App\Service\TaskService;

$container = $app->getContainer();

$container['task_service'] = function (ContainerInterface $container): TaskService {
    // return new TaskService($container->get('task_repository'), $container->get('redis_service'));
    return new TaskService($container->get('task_repository'));
};
