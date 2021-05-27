<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'admin/Login/index';
$route['404_override'] = "errors/page_missing";

$route['admin']											= 'admin/Login/index';
$route['admin/dashboard']                    			= 'admin/Admin/index';
$route['admin/category-list']                    		= 'admin/Admin/category_list';
$route['admin/product-list']                    		= 'admin/Admin/product_list';
$route['admin/logout']                    		        = 'admin/Admin/logout';


//----------------------------- Web Services For User --------------------------------//
$route['user/createCategory']               = 'api/UserApi/createCategory';
$route['user/allCategoryList']              = 'api/UserApi/allCategoryList';
$route['user/categoryList']                 = 'api/UserApi/categoryList';
$route['user/subCategoryList']              = 'api/UserApi/subCategoryList';
$route['user/updateCategory']               = 'api/UserApi/updateCategory';
$route['user/deleteCategory']               = 'api/UserApi/deleteCategory';

$route['user/createProduct']               = 'api/UserApi/createProduct';
$route['user/productList']                 = 'api/UserApi/productList';
$route['user/productDetail']               = 'api/UserApi/productDetail';
$route['user/updateProduct']               = 'api/UserApi/updateProduct';
$route['user/deleteProduct']               = 'api/UserApi/deleteProduct';

