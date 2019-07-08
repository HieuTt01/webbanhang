<?php 
class Admin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }
    function index()
    {
       $input = array();
       $list= $this->admin_model->get_list($input);
       $total= $this->admin_model->get_total();
       $this->data['total']= $total;
       $this->data['list']= $list;
       $message = $this->session->flashdata('message');
       $this->data['message'] = $message;
       $this->data['temp'] = 'admin/admin/index';
       $this->load->view('admin/main',$this->data);
    } 
    function check_username()
    {
        $username=$this->input->post('username');
        $where=array('username'=>$username);
        if($this->admin_model->check_exists($where))
        {
            $this->form_validation->set_message(__FUNCTION__, 'Tài khoản đã tồn tại!');
            return false;

        }else{
            return true;
        }
    }
    function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('name','Tên','required|min_length[8]');
            $this->form_validation->set_rules('username','Tài khoản','required|callback_check_username');
            $this->form_validation->set_rules('password','Mật khẩu','required|min_length[3]');
            $this->form_validation->set_rules('re_password','Nhập lại mật khẩu','matches[password]');
            if($this->form_validation->run())
            {
                $name=$this->input->post('name');
                $username=$this->input->post('username');
                $password=$this->input->post('password');
                $data=array('name'=>$name,'username'=>$username,'password'=>md5($password));
                if($this->admin_model->create($data))
                {
                    $this->session->set_flashdata('message','Đã thêm !');
                }else
                {
                    $this->session->set_flashdata('message','Lỗi khi thêm mới!');
                }
                redirect(admin_url('admin'));
            }
        }
        $this->data['temp'] = 'admin/admin/add';
        $this->load->view('admin/main',$this->data);
    }
    function edit()
    {
        
        $this->load->library('form_validation');
        $this->load->helper('form');
        $id = $this->uri->rsegment('3');
        $info = $this->admin_model->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message','Không tồn tại thông tin!');
            redirect(admin_url('admin'));

        }

        $this->data['info'] = $info;
        if($this->input->post())
        {
            $password=$this->input->post('password');
            $this->form_validation->set_rules('name','Tên','required|min_length[8]');
            $this->form_validation->set_rules('username','Tài khoản','required');
           if($password)
           {
            $this->form_validation->set_rules('password','Mật khẩu','required|min_length[3]');
            $this->form_validation->set_rules('re_password','Nhập lại mật khẩu','matches[password]');
           }
            if($this->form_validation->run())
            {
                $name=$this->input->post('name');
                $username=$this->input->post('username');
               
                $data=array('name'=>$name,'username'=>$username);
                if($password)
                {
                    $data['password'] = md5($password);
                }
                if($this->admin_model->update($id,$data))
                {
                    $this->session->set_flashdata('message','Đã cập nhật !');
                }else
                {
                    $this->session->set_flashdata('message','Lỗi khi cập nhật!');
                }
                redirect(admin_url('admin'));
            }
        }
        $this->data['temp'] = 'admin/admin/edit';
        $this->load->view('admin/main',$this->data);
    }
    function delete()
    {
        $id =  $this->uri->rsegment('3'); 
        $this->_del($id);
        redirect(admin_url('admin'));
        
    }
    function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach($ids as $id)
        {
            $this->_del($id);
        }
        redirect(admin_url('admin'));
    }
    private function _del($id)
    {
        $info = $this->admin_model->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message','Không tồn tại thông tin!');
            redirect(admin_url('admin'));

        }
        if($this->admin_model->delete($id))
        {
            $this->session->set_flashdata('message','Đã xóa!');
        }else
        {
            $this->session->set_flashdata('message','Lỗi khi xóa!');
        }
    }
    function logout()
    {
        if($this->session->userdata('login'))
        {
            $this->session->unset_userdata('login');
        }
        redirect(admin_url('login'));
    }
} 