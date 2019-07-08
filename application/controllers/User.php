<?php
class User extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');

    }
    function check_email()
    {
        $email=$this->input->post('email');
        $where=array('email'=>$email);
        if($this->user_model->check_exists($where))
        {
            $this->form_validation->set_message(__FUNCTION__, 'Email đã đăng ký thanh viên trước đó!');
            return false;

        }else{
            return true;
        }
    }
    function index()
    {
        if(!$this->session->userdata('user_id_login'))
        {
            redirect();
        }
        $user_id = $this->session->userdata('user_id_login');
        $user = $this->user_model->get_info($user_id);
        if(!$user)
        {
            redirect();

        }
        $this->data['user'] = $user;

        $this->data['temp'] = 'frontend/user/index';
        $this->load->view('frontend/layout',$this->data);

    }
    function register()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('name','Tên','required|min_length[8]');
            $this->form_validation->set_rules('email','Email đăng nhập','required|valid_email|callback_check_email');
            $this->form_validation->set_rules('password','Mật khẩu','required|min_length[3]');
            $this->form_validation->set_rules('re_password','Nhập lại mật khẩu','matches[password]');
            $this->form_validation->set_rules('phone','Số điện thoại','required');
            $this->form_validation->set_rules('address','Địa chỉ','required');
            if($this->form_validation->run())
            {
                $password=$this->input->post('password');
                $data=array(
                    'name'=>$this->input->post('name'),
                    'email'=>$this->input->post('email'),
                    'phone'=>$this->input->post('phone'),
                    'address'=>$this->input->post('address'),
                    'password'=>md5($password)
                );
                if($this->user_model->create($data))
                {
                    $this->session->set_flashdata('message','Đăng ký thành công!');
                }else
                {
                    $this->session->set_flashdata('message','Lỗi khi đăng ký!');
                }
                redirect(base_url());
            }
        }
        $this->data['temp'] = 'frontend/user/register';
        $this->load->view('frontend/layout',$this->data);
    }
    function login()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('email','Email đăng nhập','required|valid_email');
            $this->form_validation->set_rules('password','Mật khẩu','required|min_length[3]');
            $this->form_validation->set_rules('login','login','callback_check_login');
            // $this->session->set_userdata('login',true);
            //     redirect(admin_url('home'));
            
            if( $this->form_validation->run())
            {
                $user = $this->_get_user_info();
                $this->session->set_flashdata('message','Đăng nhập thành công!');
                $this->session->set_userdata('user_id_login',$user->id);
                redirect();
            }
        }
        $this->data['temp'] = 'frontend/user/login';
        $this->load->view('frontend/layout',$this->data);
    }
    function edit()
    {
        if(!$this->session->userdata('user_id_login'))
        {
            redirect(site_url('user/login'));
        }
        $user_id = $this->session->userdata('user_id_login');
        $user = $this->user_model->get_info($user_id);
        if(!$user)
        {
            redirect();

        }
        $this->data['user'] = $user;
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('name','Tên','required|min_length[8]');
            $this->form_validation->set_rules('phone','Số điện thoại','required');
            $this->form_validation->set_rules('address','Địa chỉ','required');
            if($this->form_validation->run())
            {
                $data=array(
                    'name'=>$this->input->post('name'),
                    'phone'=>$this->input->post('phone'),
                    'address'=>$this->input->post('address')
                );
                if($this->user_model->update($user_id,$data))
                {
                    $this->session->set_flashdata('message','Đã cập nhật thông tin!');
                }else
                {
                    $this->session->set_flashdata('message','Lỗi khi cập nhật!');
                }
                redirect(base_url('user'));
            }
        }


        $this->data['temp'] = 'frontend/user/edit';
        $this->load->view('frontend/layout',$this->data);

    }
    
    
    function check_login()
    {
        
        
        $user = $this->_get_user_info();
        if($user)
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message(__FUNCTION__, 'Thông tin email, mật khẩu không chính xác!');
            return false;
        }
    }
    function logout()
    {
        if($this->session->userdata('user_id_login'))
        {
            $this->session->unset_userdata('user_id_login');
            $this->session->set_flashdata('message','Đã đăng xuất!');
        }
        redirect(base_url('home'));
    }
    private function _get_user_info()
    {
        $email= $this->input->post('email');
        $password= $this->input->post('password');
        $password= md5($password);
        $where = array('email'=>$email,'password'=>$password);
        $user = $this->user_model->get_info_rule($where); 
        return $user;
    }
    function transaction()
    {
        if(!$this->session->userdata('user_id_login'))
        {
            redirect();
        }
        $user_id = $this->session->userdata('user_id_login');
        $user = $this->user_model->get_info($user_id);
        if(!$user)
        {
            redirect();

        }
        $this->data['user'] = $user;

        $this->data['temp'] = 'frontend/user/index';
        $this->load->view('frontend/layout',$this->data);


    }
}