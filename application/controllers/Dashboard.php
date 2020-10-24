<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->logged_in();
    }
    function logged_in(){
        if ($this->session->userdata('logged_in') != true){
            redirect('login');
        }
    }
    public function index(){
        $page = array(
            'css' => 'links/css_links',
            'js' => 'links/js_links',
            'content' => 'task/home_page',
            'info' => $this->employee->getEmployeeInfo(),
            'notification' => $this->notification->getNotification(),
            'notify_data' => $this->notification->getNotificationData(),
            'comment_notify' => $this->notification->getNotificationComment(),
            'new_task' => $this->notification->getNotificationNewTask()
        );
        $this->load->view('task/dashboard',$page);
    }

    public function logout(){
        $data_array = array('employee_id','username','authorization','logged_in');
        $this->session->unset_userdata($data_array);
        redirect('login');
    }

    //Notification
    public function redirectNotifyComment(){
        if (isset($_POST['id'])){
            $output = '';
            $user_id = $_POST['id'];
            $data = array(
                'status' => 0
            );
            $query = $this->db->get_where('notification',array(
                'receiver_id' => $this->session->userdata('employee_id'),
                'status' => 1,
                'type' => 1
            ));
            $comment_notify = $query->num_rows();
            $this->db->where('receiver_id',$user_id)->update('notification',$data);
            $output .= '<a href="#" id="comment-notify" data-id="'.$this->session->userdata('employee_id').'">';
            $output .= '<div>';
            $output .= '<i class="fa fa-comment fa-fw"></i> New Comment';
            $output .= '<span class="label label-danger">'.$comment_notify.'</span>';
            $output .= '<span class="pull-right text-muted small">4 min</span>';
            $output .= '</div>';
            $output .= '</a>';

            echo $output;

        }
    }

    public function notifyNewTask(){
        if (isset($_POST['project'])){
            $project_id = $_POST['project'];
            $check_arry = array(
                'receiver_id' => $this->session->userdata('employee_id'),
                'project_id' => $project_id
            );
            $data = array('status' => 0);
            $this->db->where($check_arry)->update('notification',$data);
        }
    }

    public function readComment(){
        if (isset($_POST['id'])){
            $id = $_POST['id'];
            $data = array('unread'=> 0,'status' => 0);
            $this->db->where('task_id',$id)->update('notification',$data);
        }
    }

    public function createProject(){
        $page = array(
            'css' => 'links/css_links',
            'js' => 'links/js_links',
            'content' => 'task/create_project',
            'projects' => $this->task->getProjects(),
            'notification' => $this->notification->getNotification(),
            'notify_data' => $this->notification->getNotificationData(),
            'comment_notify' => $this->notification->getNotificationComment(),
            'new_task' => $this->notification->getNotificationNewTask()
        );
        $this->load->view('task/dashboard',$page);
    }

    public function creatingProject(){
        $project = $this->input->post('project');
        $desc = $this->input->post('description');
        $link = $this->input->post('ucm_link');
        $create = $this->task->creatingProject($project,$desc,$link);
        if ($create){
            $this->session->set_flashdata('project_succ','New Project created.');
            redirect('dashboard/overview/'.$create);
        }else{
            $this->session->set_flashdata('project_failed','Something is wrong in the process.');
            redirect('dashboard/createProject');
        }
    }

    public function overview(){
        $project_id = $this->uri->segment(3);
        $page = array(
            'css' => 'links/css_links',
            'js' => 'links/js_links',
            'content' => 'task/overview',
            'task_comment' => 'task/modals/task_comments',
            'create_task' => 'task/modals/create_task',
            'alert' => 'alerts/process_alerts',
            'task' => $this->task->getProjectTask($project_id),
            'employee_info' => $this->employee->getEmployeeInfo(),
            'project' => $this->task->getProjectsId($project_id),
            'notification' => $this->notification->getNotification(),
            'notify_data' => $this->notification->getNotificationData(),
            'unread'=> $this->notification->getUnreadComment(),
            'comment_notify' => $this->notification->getNotificationComment(),
            'new_task' => $this->notification->getNotificationNewTask()
        );
        $this->load->view('task/dashboard',$page);
    }

    public function createTask(){
        $task = $this->input->post('task');
        $create = $this->task->createTask($task);
        if ($create == true){
            $this->session->set_flashdata('task_created','New task created.');
            redirect('dashboard/overview/'.md5($task['project_id']));
        }else{
            $this->session->set_flashdata('task_failed','Task name already exist.');
            redirect('dashboard/overview/'.md5($task['project_id']));
        }
    }

    public function updateUrgency(){
        if (isset($_POST['urgency'])){
            $id = $_POST['id'];
            $urgency = $_POST['urgency'];

            $update = array(
                'urgency' => $urgency
            );
            $this->db->where('id',$id)->update('employee_task',$update);

            $query = $this->db->get_where('employee_task',array(
                'id' => $id,
                'urgency' => $urgency
            ));
            if ($query->row()->urgency == 1){
                $urgency_n = 'Very Low';
            }elseif ($query->row()->urgency == 2){
                $urgency_n = 'Low';
            }elseif ($query->row()->urgency == 3){
                $urgency_n = 'Standard';
            }elseif ($query->row()->urgency == 4){
                $urgency_n = 'High';
            }elseif ($query->row()->urgency == 5){
                $urgency_n = 'Critical';
            }
            $std = new stdClass();
            $std->urgency_num = $query->row()->urgency;
            $std->urgency = $urgency_n;
            echo json_encode($std);
        }
    }

    public function updateStatus(){
        if (isset($_POST['status'])){
            $id = $_POST['id'];
            $status = $_POST['status'];
            $completed = 0;
            if ($status == 4){
                $completed = time();
            }
            $update = array('status' => $status,'completed' => $completed);
            $this->db->where('id',$id)->update('employee_task',$update);
            $query = $this->db->get_where('employee_task',array(
                'id' => $id,
                'status' => $status,
            ));
            if ($query->row()->status == 0){
                $status_num = 'Not started';
            }elseif ($query->row()->status == 1){
                $status_num = 'In process';
            }elseif ($query->row()->status == 2){
                $status_num = 'On going';
            }elseif ($query->row()->status == 3){
                $status_num = 'For testing';
            }elseif ($query->row()->status == 4){
                $status_num = 'Completed';
            }
            $std = new stdClass();
            $std->status = $status_num;
            $std->status_num = $query->row()->status;

            echo json_encode($std);
        }
    }

    public function updateResponsible(){
        if (isset($_POST['employee'])){
            $id = $_POST['id'];
            $employee = $_POST['employee'];
            $update = array('employee_id' => $employee);
            $this->db->where('id',$id)->update('employee_task',$update);
            $query = $this->db->get_where('employee_info',array('id' => $employee));
            $std = new stdClass();
            $std->employee_name = $query->row()->firstname.' '.$query->row()->lastname[0];
            $std->employee_id = $employee;

            echo json_encode($std);
        }
    }

    public function completedTask(){
        $project_id = $this->uri->segment(3);
        $page = array(
            'css' => 'links/css_links',
            'js' => 'links/js_links',
            'content' => 'task/completed_task',
            'project' => $this->task->getProjectsId($project_id),
            'task' => $this->task->getProjectTask($project_id),
            'employee_info' => $this->employee->getEmployeeInfo(),
            'cnt_completed' => $this->task->countCompletedTask($project_id),
            'notification' => $this->notification->getNotification(),
            'notify_data' => $this->notification->getNotificationData(),
            'comment_notify' => $this->notification->getNotificationComment(),
            'new_task' => $this->notification->getNotificationNewTask()
        );
        $this->load->view('task/dashboard',$page);
    }

    public function createCategory(){
        $project_id = $this->input->post('project_id');
        $category = $this->input->post('category');
        $create = $this->task->createCategory($project_id,$category);
        if ($create == true){
            $this->session->set_flashdata('category_created','New category created.');
            redirect('dashboard/overview/'.md5($project_id));
        }else{
            $this->session->set_flashdata('category_failed','Task name already exist.');
            redirect('dashboard/overview/'.md5($project_id));
        }
    }

    public function manageProject(){
        $project_id = $this->uri->segment(3);
        $page = array(
            'css' => 'links/css_links',
            'js' => 'links/js_links',
            'content' => 'task/manage_project',
            'project' => $this->task->getProjectsId($project_id),
            'notification' => $this->notification->getNotification(),
            'notify_data' => $this->notification->getNotificationData(),
            'comment_notify' => $this->notification->getNotificationComment(),
            'new_task' => $this->notification->getNotificationNewTask()
        );
        $this->load->view('task/dashboard',$page);
    }

    public function editProject(){
        $id = $this->input->post('project_id');
        $project = $this->input->post('project');
        $desc = $this->input->post('description');
        $link = $this->input->post('ucm_link');
        $update = $this->task->editProject($id,$project,$desc,$link);
        if ($update == true){
            redirect('dashboard/overview/'.md5($id));
        }else{
            redirect('dashboard/overview/'.md5($id));
        }
    }

    public function deleteProject(){
        $project_id = $this->input->post('project_id');
        $delete = $this->task->deleteProject($project_id);
        if ($delete == true){
            redirect('dashboard/createProject');
        }else{
            redirect('dashboard/manageProject/'.md5($project_id));
        }
    }

    public function projectActivity(){
        $project_id = $this->uri->segment(3);
        $page = array(
            'css' => 'links/css_links',
            'js' => 'links/js_links',
            'content' => 'task/project_activity',
            'project' => $this->task->getProjectsId($project_id),
            'task' => $this->task->getProjectTask($project_id),
            'employee_info' => $this->employee->getEmployeeInfo(),
            'notification' => $this->notification->getNotification(),
            'notify_data' => $this->notification->getNotificationData(),
            'comment_notify' => $this->notification->getNotificationComment(),
            'new_task' => $this->notification->getNotificationNewTask()
        );
        $this->load->view('task/dashboard',$page);
    }

    public function employeeTask(){
        $page = array(
            'css' => 'links/css_links',
            'js' => 'links/js_links',
            'content' => 'task/employee_task',
            'task_comment' => 'task/modals/task_comments',
            'task' => $this->task->getTask(),
            'info' => $this->employee->getEmployeeInfo(),
            'notification' => $this->notification->getNotification(),
            'notify_data' => $this->notification->getNotificationData(),
            'unread'=> $this->notification->getUnreadComment(),
            'comment_notify' => $this->notification->getNotificationComment(),
            'new_task' => $this->notification->getNotificationNewTask()
        );
        $this->load->view('task/dashboard',$page);
    }

    public function getTaskComment(){
        if (isset($_POST['id'])){
            $id = $_POST['id'];
            $output = '';
            $url = base_url();

            $query = $this->db->get_where('task_comment',array('task_id'=>$id));
            $task_comment = $query->result();
            $get_user = $this->db->get('employee_info');
            $users = $get_user->result();
            foreach ($task_comment as $comment){
                $output .= '<div class="row" style="margin-bottom: 10px">';
                $output .= '<div class="col-md-3">';
                if ($comment->user_id == 0){
                    $output .= '<img src="'.$url.'assets/image/avatar.jpg" alt="Profile Pic" style="width: 45px;height: 45px;border-radius: 50%;display:inline-block;">';
                    $output .= '<span style="display:inline-block;font-weight: bold;margin-left: 10px">Admin</span>';
                    $output .= '<br><span style="color: grey;margin-left: 50px">'.date('h:i A',$comment->date).'</span>';
                }else{
                    foreach ($users as $user):
                        if ($user->id == $comment->user_id) {
                            $output .= '<img src="'.$url.'uploads/users_photo/'.$user->user_photo.'" alt="Profile Pic" style="width: 45px;height: 45px;border-radius: 50%;display:inline-block;">';
                            $output .= '<span style="display:inline-block;font-weight: bold;margin-left: 10px">'.$user->firstname.' '.$user->lastname[0].'.</span>';
                            $output .= '<br><span style="color: grey;margin-left: 50px">'.date('h:i A',$comment->date).'</span>';
                        }
                    endforeach;
                }
                $output .= '</div>';
                $output .= '<div class="col-md-9">';
                $output .= '<span>'.$comment->comment.'</span>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '<hr>';
            }

            echo $output;

        }
    }

    public function submit_task_comment(){
        if (isset($_POST['id'])){
            $task_id = $_POST['id'];
            $user_id = $_POST['user_id'];
            $comments = $_POST['comments'];
            $data = array(
                'task_id' => $task_id,
                'user_id' => $user_id,
                'comment' => htmlspecialchars($comments),
                'date' => time()
            );
            $this->db->insert('task_comment',$data);
            //Notification
            $get_users = $this->db->get_where('employee_task',array(
                'id' => $task_id,
            ));
            if($user_id == 0){
                $receiver_id = $get_users->row()->employee_id;
            }else{
                $receiver_id = 0;
            }

            $data = array(
                'type' => 1,
                'project_id' => $get_users->row()->project_id,
                'task_id' => $task_id,
                'sender_id' => $user_id,
                'receiver_id' => $receiver_id,
                'time' => time(),
                'status' => 1,
                'unread' => 1
            );
            $this->db->insert('notification',$data);
            $this->getTaskComment();
        }
    }

    //User Profile
    public function profile(){
        $page = array(
            'css' => 'links/css_links',
            'js' => 'links/js_links',
            'content' => 'user_profile/profile',
            'alerts' => 'alerts/process_alerts',
            'profile' => $this->employee->getProfileInfo(),
            'notification' => $this->notification->getNotification(),
            'notify_data' => $this->notification->getNotificationData(),
            'comment_notify' => $this->notification->getNotificationComment(),
            'new_task' => $this->notification->getNotificationNewTask()
        );
        $this->load->view('task/dashboard',$page);
    }

    public function create_users(){
        $page = array(
            'css' => 'links/css_links',
            'js' => 'links/js_links',
            'content' => 'user_mngmnt/create_user',
            'alerts' => 'alerts/process_alerts',
            'notification' => $this->notification->getNotification(),
            'notify_data' => $this->notification->getNotificationData(),
            'comment_notify' => $this->notification->getNotificationComment(),
            'new_task' => $this->notification->getNotificationNewTask()
        );
        $this->load->view('task/dashboard',$page);
    }
    public function create_new_user(){
        $users = $this->input->post('user');
        $config = array(
            'upload_path' => './uploads/users_photo/',
            'allowed_types' => 'gif|jpg|png|jpeg',
            'overwrite' => TRUE,
            'max_size' => '5000',
            'max_height' => '0',
            'max_width' => '0',
            'encrypt_name' => TRUE

        );
        $this->load->library('upload', $config);

        if ($this->upload->do_upload()){

            $data = array('upload_data' => $this->upload->data());
            $file = $this->upload->data();
            $data = array(
                'user_photo' => $file['file_name'],
                'firstname' => $users['firstname'],
                'lastname' => $users['lastname']
            );
            $qry = $this->db->get_where('user_login', array('username' => $users['username']) );
            if ($qry->num_rows() == 0){
                $this->db->insert('employee_info',$data);
                $get_id = $this->db->get_where('employee_info',array(
                    'firstname' => $users['firstname'],
                    'lastname' => $users['lastname']
                ));
                $login_data = array(
                    'employee_id' => $get_id->row()->id,
                    'username' => $users['username'],
                    'password' => md5($users['password']),
                    'authorization' => 1
                );
                $this->db->insert('user_login',$login_data);
                $this->session->set_flashdata(array('user_created' => 'New user added.'));

            }else{
                $this->session->set_flashdata(array('user_failed' => 'Username already exist.'));
            }

            redirect('dashboard/create_users');


        }else{
            $this->session->set_flashdata(array(
                'upload_error' => $this->upload->display_errors(),
            ));
            redirect('dashboard/create_users');
        }
    }

    public function editProfile(){
        $users = $this->input->post('user');
        $config = array(
            'upload_path' => './uploads/users_photo/',
            'allowed_types' => 'gif|jpg|png|jpeg',
            'overwrite' => TRUE,
            'max_size' => '5000',
            'max_height' => '0',
            'max_width' => '0',
            'encrypt_name' => TRUE

        );
        $this->load->library('upload', $config);

        if ($this->upload->do_upload()){

            $data = array('upload_data' => $this->upload->data());
            $file = $this->upload->data();
            $data = array(
                'user_photo' => $file['file_name'],
                'firstname' => $users['firstname'],
                'lastname' => $users['lastname']
            );
            $qry = $this->db->get_where('employee_info', array('id' => $users['id']) );
            if ($qry->num_rows() > 0){
                $this->db->where('id',$users['id'])->update('employee_info',$data);
                $this->session->set_flashdata(array('profile_updated' => 'Changes saved.'));
            }else{
                $this->session->set_flashdata(array('profile_failed' => 'User does not exist.'));
            }

            redirect('dashboard/profile');
        }else{
            $update = array(
                'firstname' => $users['firstname'],
                'lastname' => $users['lastname']
            );
            $this->db->where('id',$users['id'])->update('employee_info',$update);
            $this->session->set_flashdata(array('profile_updated' => 'Changes saved.'));
            redirect('dashboard/profile');
        }
    }

    public function user_list(){
        $page = array(
            'css' => 'links/css_links',
            'js' => 'links/js_links',
            'content' => 'user_mngmnt/user_list',
            'alerts' => 'alerts/process_alerts',
            'modals' => 'user_mngmnt/modals/edit_user',
            'employee_info' => $this->employee->getEmployeeInfo(),
            'user_login' => $this->employee->getLoginInfo(),
            'notification' => $this->notification->getNotification(),
            'notify_data' => $this->notification->getNotificationData(),
            'comment_notify' => $this->notification->getNotificationComment(),
            'new_task' => $this->notification->getNotificationNewTask()
        );
        $this->load->view('task/dashboard',$page);
    }

    public function getUserProfile(){
        if (isset($_POST['id'])){
            $id = $_POST['id'];
            $query = $this->db->get_where('employee_info',array(
                'id' => $id
            ));

            $obj = new stdClass();
            $obj->firstname = $query->row()->firstname;
            $obj->lastname = $query->row()->lastname;

            echo json_encode($obj);
        }
    }

    public function displayUserList(){
        $output = '';
        $employee_info = $this->employee->getEmployeeInfo();
        $user_login = $this->employee->getLoginInfo();
        $url = base_url();
        foreach ($employee_info as $cnt => $employee){
            $count = $cnt + 1;
            $output .= '<tr>';
            $output .= '<td>'.$count.'</td>';
            $output .= '<td><img src="'.$url.'uploads/users_photo/'.$employee->user_photo.'" alt="Avatar" class="img-responsive user-list-photo"></td>';
            $output .= '<td>'.$employee->firstname.' '.$employee->lastname.'</td>';
            foreach ($user_login as $users){
                if ($users->employee_id == $employee->id){
                $output .= '<td>'.$users->username.'</td>';
                }
            }
            $output .= '<td style="text-align: center">';
            $output .= '<div class="dropdown">';
            $output .= '<a href="#" class="dropdown-toggle" type="button" id="menu1" data-toggle="dropdown" style="color: grey;text-decoration: none">';
            $output .= '<i class="fa fa-cog fa-lg"></i>';
            $output .= '<span class="caret"></span></a>';
            $output .= '<ul class="dropdown-menu pull-left" role="menu" aria-labelledby="menu1">';
            $output .= '<li role="presentation"><a role="menuitem" href="#" style="font-size: 15px" data-toggle="modal" data-target="#editUser" class="editUserProfile" data-id="'.$employee->id.'"><i class="fa fa-edit"></i>&nbsp;Edit</a></li>';
            $output .= '<li role="presentation"><a role="menuitem" href="#" style="font-size: 15px" data-toggle="modal" data-target="#deleteUser" class="deleteUserProfile" data-id="'.$employee->id.'"><i class="fa fa-ban"></i>&nbsp;Delete</a></li>';
            $output .= '</ul>';
            $output .= '</div>';
            $output .= '</td>';
            $output .= '</tr>';

        }

        echo $output;
    }

    public function edit_user_profile(){
        if (isset($_POST['id'])){
            $id = $_POST['id'];
            $user = $this->input->post('user');
            $data = array(
                'firstname' => $user['firstname'],
                'lastname' => $user['lastname']
            );
            $this->db->where('id',$id)->update('employee_info',$data);
            $this->displayUserList();
        }
    }

    public function delete_user_profile(){
        if (isset($_POST['id'])){
            $id = $_POST['id'];
            $this->db->where('id',$id)->delete('employee_info');
            $this->db->where('employee_id',$id)->delete('user_login');
            $this->displayUserList();
        }
    }
}