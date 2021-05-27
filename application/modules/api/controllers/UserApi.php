<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserApi extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->error        = true;
        $this->error_code   = 99;
        $this->message      = "Something went wrong.";
        $this->result       = new stdClass();
        $this->model        = new User_model();
        unset($_REQUEST['ci_session']);
    }
    
    //create categroy
    public function createCategory() {
        $required = array ('name');
        $checkRequired=$this->check_requiredField($_POST,$required);
        if($checkRequired){
            $this->error_code = $checkRequired['error_code'];
            $this->message    = $checkRequired['message'];
        }else{
            $insertData       = $this->model->createCategory($_POST); 
            $this->error      = $insertData['error'];
            $this->error_code = $insertData['code'];
            $this->message    = $insertData['message'];
        }
        echo json_encode([ 'error' => $this->error, 'error_code' => $this->error_code, 'message' => $this->message, 'result' => $this->result ]);
    }


    //categroy data
    public function categoryList() {
        $list       = $this->model->categoryList(); 
        if($list){
            $this->error      = false;
            $this->error_code = 200;
            $this->message    = "Category List.";
            $this->result     = $list;
        }else{
            $this->error_code = 201;
            $this->message    = "Category Not Found.";
        }
        echo json_encode([ 'error' => $this->error, 'error_code' => $this->error_code, 'message' => $this->message, 'result' => $this->result ]);
    }

    public function allCategoryList() {
        $list       = $this->model->allCategoryList(); 
        if($list){
            $this->error      = false;
            $this->error_code = 200;
            $this->message    = "Category List.";
            $this->result     = $list;
        }else{
            $this->error_code = 201;
            $this->message    = "Category Not Found.";
        }
        echo json_encode([ 'error' => $this->error, 'error_code' => $this->error_code, 'message' => $this->message, 'result' => $this->result ]);
    }

    //sub-categroy data
    public function subCategoryList() {
        $required = array ('category_id');
        $checkRequired=$this->check_requiredField($_POST,$required);
        if($checkRequired){
            $this->error_code = $checkRequired['error_code'];
            $this->message    = $checkRequired['message'];
        }else{
            $list       = $this->model->subCategoryList($_POST); 
            if($list){
                $this->error      = false;
                $this->error_code = 200;
                $this->message    = "Sub-Category List.";
                $this->result     = $list;
            }else{
                $this->error_code = 201;
                $this->message    = "Sub-Category Not Found.";
            }
        }
        echo json_encode([ 'error' => $this->error, 'error_code' => $this->error_code, 'message' => $this->message, 'result' => $this->result ]);
    }

    public function updateCategory() {
        $required = array ('name','category_id');
        $checkRequired=$this->check_requiredField($_POST,$required);
        if($checkRequired){
            $this->error_code = $checkRequired['error_code'];
            $this->message    = $checkRequired['message'];
        }else{
            $getCategory       = $this->model->categoryDetail($_POST); 
            if($getCategory){
                $list       = $this->model->updateCategory($_POST); 
                if($list){
                    $this->error      = false;
                    $this->error_code = 200;
                    $this->message    = "Category Updated successfully.";
                }else{
                    $this->error      = true;
                    $this->error_code = 201;
                    $this->message    = "Some error found.";
                }
            }else{
                $this->error_code = 202;
                $this->message    = "Category not found.";
            }
        }
        echo json_encode([ 'error' => $this->error, 'error_code' => $this->error_code, 'message' => $this->message, 'result' => $this->result ]);
    }



    public function deleteCategory() {
        $required = array ('category_id');
        $checkRequired=$this->check_requiredField($_POST,$required);
        if($checkRequired){
            $this->error_code = $checkRequired['error_code'];
            $this->message    = $checkRequired['message'];
        }else{
            $getCategory       = $this->model->categoryDetail($_POST); 
            if($getCategory){
                $list       = $this->model->deleteCategory($_POST); 
                if($list){
                    $this->error      = false;
                    $this->error_code = 200;
                    $this->message    = "Category Deleted successfully.";
                }else{
                    $this->error      = true;
                    $this->error_code = 201;
                    $this->message    = "Some error found.";
                }
            }else{
                $this->error_code = 202;
                $this->message    = "Category not found.";
            }
        }
        echo json_encode([ 'error' => $this->error, 'error_code' => $this->error_code, 'message' => $this->message, 'result' => $this->result ]);
    }

    public function createProduct() {
        $required = array ('name','category_id','price');
        $checkRequired=$this->check_requiredField($_POST,$required);
        if($checkRequired){
            $this->error_code = $checkRequired['error_code'];
            $this->message    = $checkRequired['message'];
        }else{
            $list       = $this->model->createProduct($_POST); 
            if($list){
                $this->error      = false;
                $this->error_code = 200;
                $this->message    = "Product Created successfully.";
            }else{
                $this->error      = true;
                $this->error_code = 201;
                $this->message    = "Some error found.";
            }
        }
        echo json_encode([ 'error' => $this->error, 'error_code' => $this->error_code, 'message' => $this->message, 'result' => $this->result ]);
    }

    public function productList() {
        $list       = $this->model->productList(); 
        if($list){
            $this->error      = false;
            $this->error_code = 200;
            $this->message    = "Product List.";
            $this->result     = $list;
        }else{
            $this->error      = true;
            $this->error_code = 201;
            $this->message    = "Product not found.";
        }
        echo json_encode([ 'error' => $this->error, 'error_code' => $this->error_code, 'message' => $this->message, 'result' => $this->result ]);
    }

    public function productDetail() {
        $required = array ('product_id');
        $checkRequired=$this->check_requiredField($_POST,$required);
        if($checkRequired){
            $this->error_code = $checkRequired['error_code'];
            $this->message    = $checkRequired['message'];
        }else{
            $list       = $this->model->productDetail($_POST); 
            if($list){
                $this->error      = false;
                $this->error_code = 200;
                $this->message    = "Product Detail.";
            }else{
                $this->error      = true;
                $this->error_code = 201;
                $this->message    = "Product not found.";
            }
        }
        echo json_encode([ 'error' => $this->error, 'error_code' => $this->error_code, 'message' => $this->message, 'result' => $this->result ]);
    }

    public function updateProduct() {
        $required = array ('product_id','name','price');
        $checkRequired=$this->check_requiredField($_POST,$required);
        if($checkRequired){
            $this->error_code = $checkRequired['error_code'];
            $this->message    = $checkRequired['message'];
        }else{
            $list       = $this->model->productDetail($_POST); 
            if($list){
                $update       = $this->model->updateProduct($_POST); 
                if($update){
                    $this->error      = false;
                    $this->error_code = 200;
                    $this->message    = "Product Updated.";
                }else{
                    $this->error      = true;
                    $this->error_code = 201;
                    $this->message    = "Some error found.";
                }
            }else{
                $this->error      = true;
                $this->error_code = 202;
                $this->message    = "Product not found.";
            }
            
        }
        echo json_encode([ 'error' => $this->error, 'error_code' => $this->error_code, 'message' => $this->message, 'result' => $this->result ]);
    }

    public function deleteProduct() {
        $required = array ('product_id');
        $checkRequired=$this->check_requiredField($_POST,$required);
        if($checkRequired){
            $this->error_code = $checkRequired['error_code'];
            $this->message    = $checkRequired['message'];
        }else{
            $list       = $this->model->productDetail($_POST); 
            if($list){
                $update       = $this->model->deleteProduct($_POST); 
                if($update){
                    $this->error      = false;
                    $this->error_code = 200;
                    $this->message    = "Product Deleted.";
                }else{
                    $this->error      = true;
                    $this->error_code = 201;
                    $this->message    = "Some error found.";
                }
            }else{
                $this->error      = true;
                $this->error_code = 202;
                $this->message    = "Product not found.";
            }
            
        }
        echo json_encode([ 'error' => $this->error, 'error_code' => $this->error_code, 'message' => $this->message, 'result' => $this->result ]);
    }

    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
function check_requiredField($obj, $required) {
    foreach ($required as $field) {
        if (empty($obj[$field])) {
            $dataError['status'] = true;
            $dataError['field'] = $field;
            return (array("error" => false, "error_code" => 98,
            "message" => "$field is required field","result"=>new stdClass()));
        }
    }
    return false;
}

}
