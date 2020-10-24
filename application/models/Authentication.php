<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Authentication extends CI_Model
{
    public function userLogin($login){
        $query = $this->db->get_where('user_login',array(
            'username' => $login['username'],
            'password' => md5($login['password'])
        ));
        if ($query->num_rows() == 1){
            $this->session->set_userdata(array(
                'employee_id' => $query->row()->employee_id,
                'username' => $query->row()->username,
                'authorization' => $query->row()->authorization,
                'logged_in' => true
            ));
            return true;
        }else{
            return false;
        }
    }
}