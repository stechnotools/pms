<?php
namespace Admin\Report\Config;
if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}
$routes->group(env('app.adminROUTE'), ['namespace' => 'Admin','filter' => 'login'], function($routes)
{
    $routes->add('report', 'Report\Controllers\Report::index');
    $routes->add('report/tentativefarmer', 'Report\Controllers\Tentativefarmer::index');
    $routes->add('report/tentativefarmer/abstract', 'Report\Controllers\Tentativefarmer::tentative_abstract');
    $routes->add('report/tentativefarmer/map', 'Report\Controllers\Tentativefarmer::map');

    $routes->add('mvcluster', 'Report\Controllers\MActivity::mvcluster');
    $routes->add('mactivitycount', 'Report\Controllers\MActivity::mactivitycount');

});
