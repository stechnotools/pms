<?php
namespace Admin\Localisation\Config;
if(!isset($routes))
{
    $routes = \Config\Services::routes(true);
}
$routes->group(env('app.adminROUTE'), ['namespace' => 'Admins','filter' => 'login'], function($routes)
{
    $routes->add('district', 'Localisation\Controllers\District::index');
    $routes->post('district/search','Localisation\Controllers\District::search');
    $routes->add('district/block/','Localisation\Controllers\District::block/');
    $routes->get('district/block/(:segment)','Localisation\Controllers\District::block/$1');
    $routes->match(['get','post'],'district/add', 'Localisation\Controllers\District::add');
    $routes->match(['get','post'],'district/edit/(:segment)', 'Localisation\Controllers\District::edit/$1');
    $routes->get('district/delete/(:segment)',   'Localisation\Controllers\District::delete/$1');
    $routes->post('district/delete','Localisation\Controllers\District::delete');

    $routes->add('block', 'Localisation\Controllers\Block::index');
    $routes->add('block/grampanchayat/','Localisation\Controllers\Block::grampanchayat/');
    $routes->get('block/grampanchayat/(:segment)','Localisation\Controllers\Block::grampanchayat/$1');
    $routes->get('block/grampanchayat/(:segment)/(:segment)','Localisation\Controllers\Block::grampanchayat/$1/$2');
    $routes->get('block/cluster/(:segment)','Localisation\Controllers\Block::cluster/$1');

    $routes->post('block/search','Localisation\Controllers\Block::search');

    $routes->match(['get','post'],'block/add', 'Localisation\Controllers\Block::add');
    $routes->match(['get','post'],'block/edit/(:segment)', 'Localisation\Controllers\Block::edit/$1');
    $routes->get('block/delete/(:segment)',   'Localisation\Controllers\Block::delete/$1');
    $routes->post('block/delete','Localisation\Controllers\Block::delete');

    $routes->add('grampanchayat', 'Localisation\Controllers\Grampanchayat::index');
    $routes->post('grampanchayat/search','Localisation\Controllers\Grampanchayat::search');
    $routes->get('grampanchayat/village/(:segment)','Localisation\Controllers\Grampanchayat::village/$1');

    $routes->match(['get','post'],'grampanchayat/add', 'Localisation\Controllers\Grampanchayat::add');
    $routes->match(['get','post'],'grampanchayat/edit/(:segment)', 'Localisation\Controllers\Grampanchayat::edit/$1');
    $routes->get('grampanchayat/delete/(:segment)',   'Localisation\Controllers\Grampanchayat::delete/$1');
    $routes->post('grampanchayat/delete','Localisation\Controllers\Grampanchayat::delete');

    $routes->add('village', 'Localisation\Controllers\Village::index');
    $routes->post('village/search','Localisation\Controllers\Village::search');
    $routes->match(['get','post'],'village/add', 'Localisation\Controllers\Village::add');
    $routes->match(['get','post'],'village/edit/(:segment)', 'Localisation\Controllers\Village::edit/$1');
    $routes->get('village/delete/(:segment)',   'Localisation\Controllers\Village::delete/$1');
    $routes->post('village/delete','Localisation\Controllers\Village::delete');

    $routes->add('cluster', 'Localisation\Controllers\Cluster::index');
    $routes->post('cluster/search','Localisation\Controllers\Cluster::search');
    $routes->get('cluster/grampanchayat/(:segment)','Localisation\Controllers\Cluster::grampanchayat/$1');
    $routes->match(['get','post'],'cluster/add', 'Localisation\Controllers\Cluster::add');
    $routes->match(['get','post'],'cluster/edit/(:segment)', 'Localisation\Controllers\Cluster::edit/$1');
    $routes->get('cluster/delete/(:segment)',   'Localisation\Controllers\Cluster::delete/$1');
    $routes->post('cluster/delete','Localisation\Controllers\Cluster::delete');
});
