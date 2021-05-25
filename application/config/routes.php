<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//----------------------------- Web Services For User --------------------------------//
$route['user/createCategory']               = 'api/UserApi/createCategory';
$route['user/categoryList']                 = 'api/UserApi/categoryList';
$route['user/subCategoryList']              = 'api/UserApi/subCategoryList';
$route['user/updateCategory']               = 'api/UserApi/updateCategory';
$route['user/deleteCategory']               = 'api/UserApi/deleteCategory';

$route['user/createProduct']               = 'api/UserApi/createProduct';
$route['user/productList']                 = 'api/UserApi/productList';
$route['user/productDetail']               = 'api/UserApi/productDetail';
$route['user/updateProduct']               = 'api/UserApi/updateProduct';
$route['user/deleteProduct']               = 'api/UserApi/deleteProduct';

