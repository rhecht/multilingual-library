<?php

include_once "CI_Base_Model.php";

class MY_Model extends CI_Base_Model
{
    protected function get_current_user()
    {
        //return $this->session->userdata('user_id');
    }

    protected function _encrypt($string){       
        //return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
        return password_hash($string, PASSWORD_DEFAULT);
    }
    
    protected function _decrypt($string, $key = ''){       
        //return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        return $string;
    }

    protected function cols($columns='*',$protect = TRUE){
        $this->db->select($columns,$protect);
        return $this;
    }
}