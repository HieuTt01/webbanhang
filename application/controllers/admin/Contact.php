<?php 
class contact extends MY_Controller
{
    function __construct()
    {
        
        parent::__construct();
        $this->load->model('contact_model');
    }
    function index()
    {
        $message = $this->session->flashdata('message');
       $this->data['message'] = $message;
        $total_rows = $this->contact_model->get_total();
        $this->data['total_rows'] = $total_rows;
        $list= $this->contact_model->get_list();
        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/contact/index';
       $this->load->view('admin/main',$this->data);
    }
    function delete()
    {
        $id = $this->uri->rsegment(3);
        $this->_del($id);
        redirect(admin_url('contact'));
        

    }
    function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach($ids as $id)
        {
            $this->_del($id);
        }
        redirect(admin_url('contact'));

    }
    private function _del($id)
    {
        $contact = $this->contact_model->get_info($id);
        if(!$contact)
        {
            $this->session->set_flashdata('message','Không tồn tại dữ liệu!');
            redirect(admin_url('contact'));
        }
        if($this->contact_model->delete($id))
        {
            $this->session->set_flashdata('message','Đã xóa!');
        }
        else
        {
            $this->session->set_flashdata('message','Lỗi khi xóa!');
        }
    }
    
    
}