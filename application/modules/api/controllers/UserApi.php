<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserApi extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        unset($_REQUEST['ci_session']);
    }
    
    public function index() {
        $this->load->view('index');
    }
    

    public function createCategory() {
        $this->load->view('UserView/create_category');
    }

    public function categoryList() {
        $this->load->view('UserView/get_category_list');
    }

    public function subCategoryList() {
        $this->load->view('UserView/get_subcategory_list');
    }

    public function updateCategory() {
        $this->load->view('UserView/update_category');
    }
    public function deleteCategory() {
        $this->load->view('UserView/delete_category');
    }

    public function createProduct() {
        $this->load->view('UserView/create_product');
    }

    public function productList() {
        $this->load->view('UserView/product_list');
    }

    public function productDetail() {
        $this->load->view('UserView/product_detail');
    }

    public function updateProduct() {
        $this->load->view('UserView/update_product');
    }

    public function deleteProduct() {
        $this->load->view('UserView/delete_product');
    }

    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
}
