<?php

class Admin_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    public function admin_login($email, $password) {
        $return = $this->db->where(['email' => $email, 'password' => $password])->get('admin');
        if ($return->num_rows()) {
            return $return->row_array();
        } else {
            return FALSE;
        }
    }

    function apiCallHeader($path, $bodyData) {
        $headers = array("Content-Type:multipart/form-data");
        $url = base_url() . "user/" . $path;
        $ch = @curl_init();
        @curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyData);
        @curl_setopt($ch, CURLOPT_URL, $url);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $myvar = @curl_exec($ch);
        curl_close($ch);
            //  echo '<pre/>';print_r($myvar);
        return $myvar;
    }

}
