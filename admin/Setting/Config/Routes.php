<?php
namespace Admin\Setting\Config;
if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group(env('app.adminROUTE'), ['namespace' => 'Admin','filter' => 'login'], function($routes)
{
    $routes->add('setting', 'Setting\Controllers\Setting::index');
    $routes->get('setting/serverinfo', 'Setting\Controllers\Setting::serverinfo');

    $routes->add('setting/adashboard','Setting\Controllers\ADashboard::index');
    $routes->add('setting/adashboard/add','Setting\Controllers\ADashboard::add');
    $routes->add('setting/adashboard/edit/(:segment)','Setting\Controllers\ADashboard::edit/$1');
    $routes->add('setting/adashboard/delete/(:segment)','Setting\Controllers\ADashboard::delete/$1');

    $routes->add('setting/fdashboard','Setting\Controllers\FDashboard::index');
    $routes->add('setting/fdashboard/add','Setting\Controllers\FDashboard::add');
    $routes->add('setting/fdashboard/edit/(:segment)','Setting\Controllers\FDashboard::edit/$1');
    $routes->add('setting/fdashboard/delete/(:segment)','Setting\Controllers\FDashboard::delete/$1');

    $routes->post('setting/save_dashboard/(:segment)/(:segment)', 'Setting\Controllers\Setting::save_dashboard/$1/$2');
    $routes->add('msubmission','Setting\Controllers\Msubmission::index');

    $routes->get('msubmission/getForms/(:segment)', 'Setting\Controllers\Msubmission::getForms/$1');

});
    