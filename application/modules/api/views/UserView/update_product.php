<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    $model                      = new User_model();
    $required = array ('product_id','name','price');
    $checkRequired=$model->check_requiredField($_REQUEST,$required);
    if($checkRequired['status']){
        $error      = true;
        $code       = 98;
        $msg        = $checkRequired['field'].' field is required.';
        $data       = new stdClass();
    }else{
        $getDate             = $model->getSingleDataRow('product','product_id="'.$_POST['product_id'].'"'); 
        if($getDate){
            $insertData             = $model->updateProduct($_POST); 
            if($insertData){
                $error                  = false;
                $code                   = 200;
                $msg                    = "Product Updated";
                $data                   = array();
            }else{
                $error                  = true;
                $code                   = 201;
                $msg                    = "Some error found";
                $data                   = array();
            }
        }else{
            $error                  = true;
            $code                   = 202;
            $msg                    = "Product not found";
            $data                   = array();
        }
        
    }
}

echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));