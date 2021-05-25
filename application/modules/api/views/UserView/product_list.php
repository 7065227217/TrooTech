<?php

    $model                      = new User_model();
    $list                       = $model->productList(); 
    if($list){
        $error                  = false;
        $code                   = 200;
        $msg                    = "Product List.";
        $data                   = $list;
    }else{
        $error                  = true;
        $code                   = 202;
        $msg                    = "Product not found.";
        $data                   = array();
    }

echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));