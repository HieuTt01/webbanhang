<?php
class Login extends MY_controller
{ 
    function index()
    {
        
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('login','login','callback_check_login');
            // $this->session->set_userdata('login',true);
            //     redirect(admin_url('home'));
            if( $this->form_validation->run())
            {
                $this->load->model('admin_model');
                $id = $this->check_login();
                $user = $this->admin_model->get_info($id);
                $this->session->set_userdata('login',true);
                $this->session->set_userdata('name',$user->name);
                redirect(admin_url('home'));
            }
        }
        $this->load->view('admin/login/index');
    }

    
    function check_login()
    {
        $username= $this->input->post('username');
        $password= $this->input->post('password');
        $password= md5($password);
        $this->load->model('admin_model');
        $where = array('username'=>$username,'password'=>$password);
        if($this->admin_model->check_exists($where))
        {
            $user = $this->admin_model->get_info_rule($where);
            return $user->id;
        }
        else
        {
            $this->form_validation->set_message(__FUNCTION__, 'Thông tin tài khoản, mật khẩu không chính xác!');
            return false;
        }
    }

}