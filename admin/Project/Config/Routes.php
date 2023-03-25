<?php
namespace Admin\Project\Config;
if(!isset($routes))
{
    $routes = \Config\Services::routes(true);
}
$routes->group(env('app.adminROUTE'), ['namespace' => 'Admin','filter' => 'login'], function($routes)
{
    $routes->add('project', 'Project\Controllers\Project::index');
    $routes->post('project/search','Project\Controllers\Project::search');
    $routes->match(['get','post'],'project/add', 'Project\Controllers\Project::add');
    $routes->match(['get','post'],'project/edit/(:segment)', 'Project\Controllers\Project::edit/$1');
    $routes->get('project/view/(:segment)', 'Project\Controllers\Project::view/$1');
    $routes->get('project/delete/(:segment)',   'Project\Controllers\Project::delete/$1');
    $routes->post('project/delete','Project\Controllers\Project::delete');
    
});
