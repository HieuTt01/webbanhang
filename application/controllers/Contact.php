<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Contact extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('contact_model');
        $this->load->library('form_validation');
    }
    function index()
    {
            $this->form_validation->set_rules('name','Tên','required');
            $this->form_validation->set_rules('email','Email ','required');
            $this->form_validation->set_rules('title','Tiêu đề','required');
            $this->form_validation->set_rules('content','Nội dung','required');
            $this->form_validation->set_rules('phone','Số điện thoại','required');
            $this->form_validation->set_rules('address','Địa chỉ','required');
            if($this->form_validation->run())
            {
                $data = array();
                $data=array(
                    'name'=>$this->input->post('name'),
                    'email'=>$this->input->post('email'),
                    'phone'=>$this->input->post('phone'),
                    'address'=>$this->input->post('address'),
                    'title'=>$this->input->post('title'),
                    'content'=>$this->input->post('content')
                    
                );
                $this->contact_model->create($data);
                $this->session->set_flashdata('message','Đã gửi liên hệ!');
                redirect(base_url());

            }
            $this->data['temp'] = 'frontend/contact/add';
            $this->load->view('frontend/layout',$this->data);
    }
}