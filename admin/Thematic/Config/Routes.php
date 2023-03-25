<?php
namespace Admin\Thematic\Config;
if(!isset($routes))
{
    $routes = \Config\Services::routes(true);
}
$routes->group(env('app.adminROUTE'), ['namespace' => 'Admin','filter' => 'login'], function($routes)
{
    $routes->add('thematic', 'Thematic\Controllers\Thematic::index');
    $routes->post('thematic/search','Thematic\Controllers\Thematic::search');
    $routes->match(['get','post'],'thematic/add', 'Thematic\Controllers\Thematic::add');
    $routes->match(['get','post'],'thematic/edit/(:segment)', 'Thematic\Controllers\Thematic::edit/$1');
    $routes->get('thematic/delete/(:segment)',   'Thematic\Controllers\Thematic::delete/$1');
    $routes->post('thematic/delete','Thematic\Controllers\Thematic::delete');
    $routes->get('thematic/login/(:segment)','Thematic\Controllers\Thematic::login/$1');

    $routes->add('usergroup', 'Thematic\Controllers\Usergroup::index');
    $routes->post('usergroup/search','Thematic\Controllers\Usergroup::search');
    $routes->match(['get','post'],'usergroup/add', 'Thematic\Controllers\Usergroup::add');
    $routes->match(['get','post'],'usergroup/edit/(:segment)', 'Thematic\Controllers\Usergroup::edit/$1');
    $routes->get('usergroup/delete/(:segment)',   'Thematic\Controllers\Usergroup::delete/$1');
    $routes->post('usergroup/delete','Thematic\Controllers\Usergroup::delete');
    $routes->match(['get','post'],'usergroup/permission/(:segment)', 'Thematic\Controllers\Usergroup::permission/$1');

});
