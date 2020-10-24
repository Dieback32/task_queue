<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Employee extends CI_Model
{
    public function getEmployeeInfo(){
        $query = $this->db->get('employee_info');
        return $query->result();
    }

    public function getLoginInfo(){
        $query = $this->db->get('user_login');
        return $query->result();
    }

    public function getProfileInfo(){
        $user_id = $this->session->userdata('employee_id');
        $query = $this->db->get_where('employee_info',array('id' => $user_id));
        return $query->result();
    }
}