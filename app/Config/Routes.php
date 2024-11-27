<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');
$routes->post('/company-registration', 'LoginController::company_registration');
$routes->post('/login', 'LoginController::login');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/logout', 'DashboardController::logout');

// Master Management
$routes->group('master', function ($routes) {
	// Category master
    $routes->get('category-list', 'CategoryController::index');
    $routes->post('get-category-list', 'CategoryController::get_category_list');
    $routes->post('store-category-data', 'CategoryController::store_category_data');
    $routes->post('update-category-data', 'CategoryController::update_category_data');
    $routes->post('delete-category-data', 'CategoryController::delete_category_data');
    $routes->post('category-store', 'CategoryController::store');

    // Component master
    $routes->get('component-list', 'ComponentController::index');
    $routes->post('get-component-list', 'ComponentController::get_component_list');
    $routes->post('store-component-category-data', 'ComponentController::store_component_category_data');
    $routes->post('update-component-category-data', 'ComponentController::update_component_category_data');
    $routes->post('delete-component-category-data', 'ComponentController::delete_component_category_data');
    $routes->post('component-store', 'ComponentController::store');
});

$routes->group('product', function ($routes) {
    // Category master
    $routes->get('list', 'ProductController::index');
    $routes->post('get-product-list', 'ProductController::get_product_list');
    $routes->get('new', 'ProductController::new_product');
    $routes->post('store-product-data', 'ProductController::store_product_data');
    $routes->get('edit/(:num)', 'ProductController::edit_product/$1');
    $routes->get('upload-documents/(:num)', 'ProductController::upload_documents/$1');
    $routes->post('store-upload-doccuments', 'ProductController::store_upload_product_documents');
    $routes->get('download-documents/(:num)', 'ProductController::download_documents/$1');
    $routes->post('delete-product-document', 'ProductController::delete_product_documents');
    $routes->post('update-product-data', 'ProductController::update_product_data');
});
