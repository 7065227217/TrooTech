<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    $model                      = new User_model();
    $required = array ('category_id');
    $checkRequired=$model->check_requiredField($_REQUEST,$required);
    if($checkRequired['status']){
        $error      = true;
        $code       = 98;
        $msg        = $checkRequired['field'].' field is required.';
        $data       = new stdClass();
    }else{
        $list             = $model->subCategoryList($_POST); 
        
        if($list){
            $error                  = false;
            $code                   = 200;
            $msg                    = "Sub Category List.";
            $data                   = $list;
        }else{
            $error                  = true;
            $code                   = 202;
            $msg                    = "Sub Category not found.";
            $data                   = array();
        }
    }
}

echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));