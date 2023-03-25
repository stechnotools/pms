<?php
namespace Admin\Team\Config;
if(!isset($routes))
{
    $routes = \Config\Services::routes(true);
}
$routes->group(env('app.adminROUTE'), ['namespace' => 'Admin','filter' => 'login'], function($routes)
{
    $routes->add('team', 'Team\Controllers\Team::index');
    $routes->post('team/search','Team\Controllers\Team::search');
    $routes->match(['get','post'],'team/add', 'Team\Controllers\Team::add');
    $routes->match(['get','post'],'team/edit/(:segment)', 'Team\Controllers\Team::edit/$1');
    $routes->match(['get','post'],'team/view/(:segment)', 'Team\Controllers\Team::view/$1');
    $routes->get('team/delete/(:segment)',   'Team\Controllers\Team::delete/$1');
    $routes->post('team/delete','Team\Controllers\Team::delete');

    $routes->add('team/user', 'Team\Controllers\TeamUser::index');
    $routes->post('team/user/search','Team\Controllers\TeamUser::search');
    $routes->match(['get','post'],'team/user/add', 'Team\Controllers\TeamUser::add');
    $routes->match(['get','post'],'team/user/edit/(:segment)', 'Team\Controllers\TeamUser::edit/$1');
    $routes->match(['get','post'],'team/user/view/(:segment)', 'Team\Controllers\TeamUser::view/$1');
    $routes->get('team/user/delete/(:segment)',   'Team\Controllers\TeamUser::delete/$1');
    $routes->post('team/user/delete','Team\Controllers\TeamUser::delete');
});
