<?php 
class User extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }
    function index()
    {
       $input = array();
       $list= $this->user_model->get_list($input);
       $total= $this->user_model->get_total();
       $this->data['total']= $total;
       $this->data['list']= $list;
       $message = $this->session->flashdata('message');
       $this->data['message'] = $message;
       $this->data['temp'] = 'admin/user/index';
       $this->load->view('admin/main',$this->data);
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
    function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('name','Tên','required|min_length[8]');
            $this->form_validation->set_rules('email','Tài khoản','required|valid_email|callback_check_email');
            $this->form_validation->set_rules('password','Mật khẩu','required|min_length[3]');
            $this->form_validation->set_rules('re_password','Nhập lại mật khẩu','matches[password]');
            $this->form_validation->set_rules('address','Địa chỉ','required');
            $this->form_validation->set_rules('phone','Số điện thoại','required');
            if($this->form_validation->run())
            {
                $password = $this->input->post('password');
                $data=array(
                    'name'=>$this->input->post('name'),
                    'email'=>$this->input->post('email'),
                    'phone'=>$this->input->post('phone'),
                    'address'=>$this->input->post('address'),
                    'password'=>md5($password)
                );
                if($this->user_model->create($data))
                {
                    $this->session->set_flashdata('message','Đã thêm thành viên!');
                }else
                {
                    $this->session->set_flashdata('message','Lỗi khi thêm mới!');
                }
                redirect(admin_url('user'));
            }
        }
        $this->data['temp'] = 'admin/user/add';
        $this->load->view('admin/main',$this->data);
    }
    function delete()
    {
        $id =  $this->uri->rsegment('3'); 
        $this->_del($id);
        redirect(admin_url('user'));
        
    }
    function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach($ids as $id)
        {
            $this->_del($id);
        }
        redirect(admin_url('user'));
    }
    private function _del($id)
    {
        $info = $this->user_model->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message','Không tồn tại thông tin!');
            redirect(admin_url('user'));

        }
        if($this->user_model->delete($id))
        {
            $this->session->set_flashdata('message','Đã xóa!');
        }else
        {
            $this->session->set_flashdata('message','Lỗi khi xóa!');
        }
    }
   
}