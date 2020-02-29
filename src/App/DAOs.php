<?php
/**
 * Load all DAO (data access objects)
 * For this project, only the jobs/task service will be necessary
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

use App\DAO\TaskDAO;
use Psr\Container\ContainerInterface;

$container = $app->getContainer();

$container['task_repository'] = function (ContainerInterface $container): TaskDAO {
    return new TaskDAO($container->get('db'));
};
