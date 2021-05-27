<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->load->helper('push_helper');
        date_default_timezone_set('Asia/Kolkata');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////CHECK USER AUTH////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    function check_requiredField($obj, $required) {
        $dataError['status'] = false;
        foreach ($required as $field) {
            if (empty($obj[$field])) {
                $dataError['status'] = true;
                $dataError['field'] = $field;
                break;
            }
        }
        return $dataError;
    }

    function createCategory($param) {
        // print_r($param);exit;
        if(isset($param['parent_id']) and $param['parent_id']){
            $this->db->where('category_id',$param['parent_id']); 
            $getStatus = $this->db->get('product_category')->row_array();
            if(!$getStatus){
                return array('error'=>true,'code'=>201,'message'=>'Category not found.');
            }
        }else{
            $param['parent_id']=0;
        }
        $insertArr=array(
            'name'              => $param['name'],
            'category_parent_id'=>$param['parent_id']
        );
        $insertData = $this->db->insert('product_category', $insertArr);	
        if($insertData){
            return array('error'=>false,'code'=>200,'message'=>'Category Created.');
        }else{
            return array('error'=>true,'code'=>202,'message'=>'Some error found.');
        }
    }

    function allCategoryList(){
        $categoryArr=array();
        $this->db->where('status',1); 
        $getCategory = $this->db->get('product_category')->result_array();
        if($getCategory){
            foreach($getCategory as $list){
                $this->db->where('status',1); 
                $this->db->where('category_parent_id',$list['category_id']); 
                $childList = $this->db->get('product_category')->result_array();
                $list['childList']=$childList;
                array_push($categoryArr,$list);
            }
            return $categoryArr;
        }else{
            return false;
        }
    }

    function categoryList(){
        $categoryArr=array();
        $this->db->where('status',1); 
        $this->db->where('category_parent_id',0); 
        $getCategory = $this->db->get('product_category')->result_array();
        if($getCategory){
            foreach($getCategory as $list){
                $this->db->where('status',1); 
                $this->db->where('category_parent_id',$list['category_id']); 
                $childList = $this->db->get('product_category')->result_array();
                $list['childList']=$childList;
                array_push($categoryArr,$list);
            }
            return $categoryArr;
        }else{
            return false;
        }
    }

    function categoryDetail($param){
        $this->db->where('status',1); 
        $this->db->where('category_id',$param['category_id']); 
        $getCategory = $this->db->get('product_category')->row_array();
        if($getCategory){
            return $getCategory;
        }else{
            return false;
        }
    }

    function subCategoryList($param){
        $this->db->where('status',1); 
        $this->db->where('category_parent_id',$param['category_id']); 
        $getCategory = $this->db->get('product_category')->result_array();
        if($getCategory){
            return $getCategory;
        }else{
            return false;
        }
    }
    function updateCategory($param) {
        $updateArr=array(
            'name'          => $param['name']
        );
        $this->db->where('category_id',$param['category_id']);
        $updateData = $this->db->update('product_category', $updateArr);
        if($updateData){
            return true;
        }else{
            return false;
        }
    }
    function deleteCategory($param) {
        $updateArr=array(
            'status'          => 99
        );
        $this->db->where('category_id',$param['category_id']);
        $updateData = $this->db->update('product_category', $updateArr);
        if($updateData){
            return true;
        }else{
            return false;
        }
    }


    function createProduct($param) {
        $sub_category_id=0;
        if(isset($param['sub_category_id']) and $param['sub_category_id']){
            $sub_category_id=$param['sub_category_id'];
        }
        $insertArr=array(
            'category_id'       => $param['category_id'],
            'sub_category_id'   => $sub_category_id,
            'name'              => $param['name'],
            'price'             => $param['price'],
        );
        $insertData = $this->db->insert('product', $insertArr);	
        if($insertData){
            return true;
        }else{
            return false;
        }
    }

    function productList(){
        $getProductArr=array();
        $getProduct=$this->getTableDataArray('product','status=1');
        if($getProduct){
            foreach($getProduct as $list){
                $category=$this->getSingleDataRow('product_category','category_id="'.$list['category_id'].'"');
                if($category){
                    $list['category_name']=$category['name'];
                }else{
                    $list['category_name']="N/A";
                }
                $subcategory=$this->getSingleDataRow('product_category','category_id="'.$list['sub_category_id'].'"');
                if($subcategory){
                    $list['subcategory_name']=$subcategory['name'];
                }else{
                    $list['subcategory_name']="N/A";
                }
                array_push($getProductArr,$list);
            }
        }
        return $getProductArr;
    }

    function productDetail($param){
        $getProduct=$this->getSingleDataRow('product','status=1 and product_id="'.$param['product_id'].'"');
        if($getProduct){
            $category=$this->getSingleDataRow('product_category','category_id="'.$getProduct['category_id'].'"');
            if($category){
                $getProduct['category_name']=$category['name'];
            }else{
                $getProduct['category_name']="N/A";
            }
            $subcategory=$this->getSingleDataRow('product_category','category_id="'.$getProduct['sub_category_id'].'"');
            if($subcategory){
                $getProduct['subcategory_name']=$subcategory['name'];
            }else{
                $getProduct['subcategory_name']="N/A";
            }

            return $getProduct;
        }else{
            return false;
        }
    }

    function updateProduct($param){
        $updateArr=array(
            'name'          => $param['name'],
            'price'          => $param['price'],
            'updated_time'   => date('Y-m-d H:i:s'),
        );
        $updateData         = $this->updatedataTable('product','product_id="'.$param['product_id'].'"',$updateArr);	
        if($updateData){
            return true;
        }else{
            return false;
        }
    }

    function deleteProduct($param){
        $updateArr=array(
            'status'          => 99,
        );
        $updateData         = $this->updatedataTable('product','product_id="'.$param['product_id'].'"',$updateArr);	
        if($updateData){
            return true;
        }else{
            return false;
        }
    }
    
    
    // Common Module
    function getSingleDataRow($table,$where){
        if($where){ $this->db->where($where); }
        $getEventTag = $this->db->get($table)->row_array();
        return $getEventTag;
    }
    
    function getTableDataArray($table,$where){
        if($where){ $this->db->where($where); }
        $getEventTag = $this->db->get($table)->result_array();
        return $getEventTag;
    }
    function insertDataTable($table,$doc){
        $results = $this->db->insert($table, $doc);
        if($results){
            return true;
        }else{
            return false;
        }
    }
    function updatedataTable($table,$where,$data){
        $this->db->where($where);
        $results = $this->db->update($table, $data);
        if($results){
            return true;
        }else{
            return false;
        }
    }
}
