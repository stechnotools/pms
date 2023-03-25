<?php
namespace Admin\Task\Config;
if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}
$routes->group(env('app.adminROUTE'), ['namespace' => 'Admin','filter' => 'login'], function($routes)
{
    $routes->get('task', 'Task\Controllers\Task::index');
    $routes->post('task/add', 'Task\Controllers\Task::add');
    $routes->get('task/view', 'Task\Controllers\Task::view');
    $routes->post('task/delete', 'Task\Controllers\Task::delete');
    $routes->post('task/sort', 'Task\Controllers\Task::sort');
    $routes->post('task/edit', 'Task\Controllers\Task::edit');
    $routes->post('task/comment', 'Task\Controllers\Task::addComment');
    $routes->post('task/addfiles', 'Task\Controllers\Task::addFiles');
    $routes->post('task/deleteFile', 'Task\Controllers\Task::deleteFile');
    $routes->post('task/adduser', 'Task\Controllers\Task::addUser');
    $routes->post('task/deleteuser', 'Task\Controllers\Task::deleteUser');
    $routes->post('task/checklist', 'Task\Controllers\Task::checkList');
    $routes->get('task/test', 'Task\Controllers\Task::test');

});
$routes->group(env('app.adminROUTE').'/api', ['namespace' => 'Admin'], function($routes)
{
    $routes->get('tasks', 'Task\Controllers\Api::getTasks');
    $routes->post('task/add', 'Task\Controllers\Api::addTask');

});
