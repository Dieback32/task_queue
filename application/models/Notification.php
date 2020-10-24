<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Model
{
    public function getNotification(){
        $query = $this->db->get_where('notification',array(
            'receiver_id' => $this->session->userdata('employee_id'),
            'status' => 1,
        ));
;
        if ($query->num_rows() == 0){
            $count = null;
        }else{
            $count = $query->num_rows();
        }
        return $count;
    }

    public function getNotificationComment(){
        $query = $this->db->get_where('notification',array(
            'receiver_id' => $this->session->userdata('employee_id'),
            'status' => 1,
            'type' => 1
        ));

        if ($query->num_rows() == 0){
            $count = null;
        }else{
            $count = $query->num_rows();
        }
        return $count;
    }

    public function getUnreadComment(){
        $query = $this->db->get_where('notification',array(
            'receiver_id' => $this->session->userdata('employee_id'),
            'unread' => 1,
            'type' => 1
        ));

        if ($query->num_rows() == 0){
            $count = null;
        }else{
            $count = $query->num_rows();
        }
        return $count;
    }

    public function getNotificationData(){
        $check = array(
            'receiver_id' => $this->session->userdata('employee_id'),
            'status' => 1
        );
        $this->db->where($check)->or_where('unread',1)->order_by("time","asc");
        $query = $this->db->get('notification');
        return $query->result();
    }

    public function getNotificationNewTask(){
        $query = $this->db->get_where('notification',array(
            'receiver_id' => $this->session->userdata('employee_id'),
            'status' => 1,
            'type' => 2
        ));
        if ($query->num_rows() == 0){
            $count = null;
        }else{
            $count = $query->num_rows();
        }
        return $count;
    }
}