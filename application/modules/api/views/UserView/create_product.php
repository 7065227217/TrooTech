<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    $model                      = new User_model();
    $required = array ('name','category_id','sub_category_id','price');
    $checkRequired=$model->check_requiredField($_REQUEST,$required);
    if($checkRequired['status']){
        $error      = true;
        $code       = 98;
        $msg        = $checkRequired['field'].' field is required.';
        $data       = new stdClass();
    }else{
        $insertData             = $model->createProduct($_POST); 
        if($insertData){
            $error                  = false;
            $code                   = 200;
            $msg                    = "Product Created";
            $data                   = array();
        }else{
            $error                  = true;
            $code                   = 201;
            $msg                    = "Some error found";
            $data                   = array();
        }
    }
}

echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));