<?php

    $model                      = new User_model();
    $list                       = $model->categoryList(); 
    if($list){
        $error                  = false;
        $code                   = 200;
        $msg                    = "Category List.";
        $data                   = $list;
    }else{
        $error                  = true;
        $code                   = 202;
        $msg                    = "Category not found.";
        $data                   = array();
    }

echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));