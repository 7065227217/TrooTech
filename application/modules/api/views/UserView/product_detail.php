<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    $model                      = new User_model();
    $required = array ('product_id');
    $checkRequired=$model->check_requiredField($_REQUEST,$required);
    if($checkRequired['status']){
        $error      = true;
        $code       = 98;
        $msg        = $checkRequired['field'].' field is required.';
        $data       = new stdClass();
    }else{
        $getdata             = $model->productDetail($_POST); 
        if($getdata){
            $error                  = false;
            $code                   = 200;
            $msg                    = "Product Detail";
            $data                   = $getdata;
        }else{
            $error                  = true;
            $code                   = 201;
            $msg                    = "Product not found.";
            $data                   = new stdClass();
        }
    }
}

echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));