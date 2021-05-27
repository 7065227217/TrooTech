<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Kolkata");
        $this->load->model('Admin_model');
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->base_url="http://localhost/projects/task/user/";
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin');
        }
    }

    public function index() {
        $returnData = $this->Admin_model->apiCallHeader('allCategoryList', []);
        $returnData= json_decode($returnData,TRUE);
        if($returnData['error_code']==200){
            $data['category_list'] = $returnData['result'];
        }else{
            $data['category_list'] = array();
        }
        $data['base_url'] = $this->base_url;
        $data['view_link'] = 'index';
        $this->load->view('layout/template',$data);
    }

    public function category_list() {
        $returnData = $this->Admin_model->apiCallHeader('allCategoryList', []);
        $returnData= json_decode($returnData,TRUE);
        if($returnData['error_code']==200){
            $data['category_list'] = $returnData['result'];
        }else{
            $data['category_list'] = array();
        }

        $returnData = $this->Admin_model->apiCallHeader('categoryList', []);
        $returnData= json_decode($returnData,TRUE);
        if($returnData['error_code']==200){
            $data['parent_category_list'] = $returnData['result'];
        }else{
            $data['parent_category_list'] = array();
        }

        
        $this->form_validation->set_rules('category', 'Category', 'required');
        if ($this->form_validation->run() == False) {
            
            $data['base_url'] = $this->base_url;
            $data['view_link'] = 'category/category_list';
            $this->load->view('layout/template', $data);
        } else {
            // echo '<pre/>';print_r($_POST);exit;
            if(isset($_POST['parent_id']) and $_POST['parent_id']){
                $count=count($_POST['parent_id']);
                if($_POST['parent_id'][$count-1]){
                    $parent_id=$_POST['parent_id'][$count-1];
                }else{
                    $parent_id=$_POST['parent_id'][$count-2];
                }
                
            }else{
                $parent_id=0;
            }
    
            $insertArr = [
                'name' => ucwords($this->input->post('category')),
                'parent_id' => $parent_id
            ];
            // echo '<pre/>';print_r($insertArr);exit;
            $returnData = $this->Admin_model->apiCallHeader('createCategory', $insertArr);
            $returnData= json_decode($returnData,TRUE);
            // echo '<pre/>';print_r($insertArr);exit;
            if ($returnData['error_code']==200) {
                $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Added Successfully.</div>');
                redirect('admin/category-list');
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while adding.</div>');
                redirect('admin/category-list');
            }
        }
    }

    public function product_list() {
        $returnData = $this->Admin_model->apiCallHeader('productList', []);
        $returnData= json_decode($returnData,TRUE);
        if($returnData['error_code']==200){
            $data['product_list'] = $returnData['result'];
        }else{
            $data['product_list'] = array();
        }

        $returnData = $this->Admin_model->apiCallHeader('categoryList', []);
        $returnData= json_decode($returnData,TRUE);
        if($returnData['error_code']==200){
            $data['parent_category_list'] = $returnData['result'];
        }else{
            $data['parent_category_list'] = array();
        }

        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        if ($this->form_validation->run() == False) {
            
            $data['base_url'] = $this->base_url;
            $data['view_link'] = 'category/product_list';
            $this->load->view('layout/template', $data);
        } else {
            $category_id=$_POST['parent_id'][0];
            $parent_id=0;
            $count=count($_POST['parent_id']);
            if($count>1){
                for($i=1;$i<$count;$i++){
                    if($_POST['parent_id'][$i]){
                        $parent_id=$_POST['parent_id'][$i];
                    }
                }
            }
            
            $insertArr = [
                'name' => ucwords($this->input->post('name')),
                'price' => ucwords($this->input->post('price')),
                'category_id' => $category_id,
                'sub_category_id' => $parent_id
            ];
            // echo '<pre/>';print_r($insertArr);exit;
            $returnData = $this->Admin_model->apiCallHeader('createProduct', $insertArr);
            $returnData= json_decode($returnData,TRUE);
            if($returnData['error_code']==200){
                $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Added Successfully.</div>');
                redirect('admin/product-list');
            }else{
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while adding.</div>');
                redirect('admin/product-list');
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata('admin_logged_in');
        redirect('admin');
    }
}

?>
    