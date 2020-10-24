<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller
{
    public function index(){
        $page = array(
            'content' => 'login/user_login'
        );
        $this->load->view('login/login_page',$page);
    }

    public function userLogin(){
        $login = $this->input->post('login');
        $data = $this->authentication->userLogin($login);
        if ($data == true){
            redirect('dashboard');
        }else{
            $this->session->set_flashdata('incorrect','Incorrect password/username');
            redirect('login');
        }
    }
}