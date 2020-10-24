<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Model

{
    public function creatingProject($project,$desc,$link){
        $query = $this->db->get_where('project',array('project_name' => $project));
        if ($query->num_rows() == 0){
            $data = array(
                'project_name' => $project,
                'description' => $desc,
                'ucm_link' => $link,
                'status' => 0
            );
            $this->db->insert('project',$data);
            $get_id = $this->db->get_where('project',array('project_name' => $project));
            return md5($get_id->row()->id);
        }else{
            return false;
        }
    }

    public function editProject($id,$project,$desc,$link){
        $query = $this->db->get_where('project',array(
            'project_name' => $project
        ));
        if ($query->num_rows() == 0){
            $data = array(
                'project_name' => $project,
                'description' => $desc,
                'ucm_link' => $link
            );
            $this->db->where('id',$id)->update('project',$data);
            return true;
        }else{
            return false;
        }
    }

    public function deleteProject($project_id){
        $query = $this->db->get_where('employee_task',array(
            'project_id' => $project_id
        ));
        if ($query->num_rows() > 0){
            return false;
        }else{
            $this->db->where('id',$project_id)->delete('project');
            return true;
        }
    }

    public function getProjects(){
        $query = $this->db->get('project');
        return $query->result();
    }
    public function getProjectsId($project_id){
        $query = $this->db->get_where('project',array(
            'MD5(id)' => $project_id
        ));
        return $query->result();
    }

    public function getProjectTask($project_id){
        $query = $this->db->get_where('employee_task',array(
            'MD5(project_id)' => $project_id
        ));
        return $query->result();
    }

    public function createTask($task){
        $query = $this->db->get_where('employee_task',array(
            'project_id' => $task['project_id'],
            'task_name' => $task['task_name']
        ));
        if ($task['deadline'] == null){
            $date_format = '0000-00-00 00:00:00';
        }else{
            $create_date = date_create($task['deadline']);
            $date_format = date_format($create_date,'Y-m-d h:i:s');
        }

        if ($query->num_rows() == 0){
            $data = array(
                'project_id' => $task['project_id'],
                'employee_id' => $task['responsible'],
                'task_name' => $task['task_name'],
                'description' => $task['task_desc'],
                'urgency' => $task['urgency'],
                'deadline' => $date_format,
                'category' => $task['category']
            );
            $this->db->insert('employee_task',$data);
            //Notification
            $get_task_info = $this->db->get_where('employee_task',array(
                'project_id' => $task['project_id'],
                'task_name' => $task['task_name']
            ));
            $notification = array(
                'type' => 2,
                'project_id' => $task['project_id'],
                'task_id' => $get_task_info->row()->id,
                'sender_id' => 0,
                'receiver_id' => $task['responsible'],
                'time' => time(),
                'status' => 1
            );
            $this->db->insert('notification',$notification);
            $this->session->set_tempdata($task['task_name'],'New',3600);
            return true;
        }else{
            return false;
        }
    }

    public function countCompletedTask($project_id){
        $query = $this->db->get_where('employee_task',array(
            'MD5(project_id)' => $project_id,
            'status' => 4
        ));
        return $query->num_rows();
    }

    public function createCategory($project_id,$category){
        $query = $this->db->get_where('project_category',array(
            'project_id' => $project_id,
            'category' => $category
        ));
        if ($query->num_rows() == 0){
            $data = array(
                'project_id' => $project_id,
                'category' => $category
            );
            $this->db->insert('project_category',$data);
            return true;
        }else{
            return false;
        }
    }


    public function getTask(){
        $query = $this->db->get('employee_task');
        return $query->result();
    }


}