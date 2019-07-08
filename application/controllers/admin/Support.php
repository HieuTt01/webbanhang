<?php 
class Support extends MY_Controller
{
    function __construct()
    {
        
        parent::__construct();
        $this->load->model('support_model');
    }
    function index()
    {
        $message = $this->session->flashdata('message');
       $this->data['message'] = $message;
        $total_rows = $this->support_model->get_total();
        $this->data['total_rows'] = $total_rows;
        $list= $this->support_model->get_list();
        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/support/index';
       $this->load->view('admin/main',$this->data);
    }
    function delete()
    {
        $id = $this->uri->rsegment(3);
        $this->_del($id);
        redirect(admin_url('support'));
        

    }
    function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach($ids as $id)
        {
            $this->_del($id);
        }
        redirect(admin_url('support'));

    }
    private function _del($id)
    {
        $support = $this->support_model->get_info($id);
        if(!$support)
        {
            $this->session->set_flashdata('message','Không tồn tại dữ liệu!');
            redirect(admin_url('support'));
        }
        if($this->support_model->delete($id))
        {
            $this->session->set_flashdata('message','Đã xóa!');
        }
        else
        {
            $this->session->set_flashdata('message','Lỗi khi xóa!');
        }
    }
    function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('name','Tên','required');
            if($this->form_validation->run())
            {
                
                $data=array(
                    'name'      =>$this->input->post('name'),
                    'gmail'     =>$this->input->post('gmail'),
                    'skype' =>$this->input->post('skype'),
                    'facebook'  =>$this->input->post('facebook'),
                    'phone'   =>$this->input->post('phone'),
                    'sort_order'   =>0,
    
                );
                if($this->support_model->create($data))
                {
                    $this->session->set_flashdata('message','Đã thêm mới dữ liệu!');
                }else
                {
                    $this->session->set_flashdata('message','Lỗi khi thêm mới dữ liệu!');
                }
                redirect(admin_url('support'));
            }
        }
        $this->data['temp'] = 'admin/support/add';
        $this->load->view('admin/main',$this->data);
    }
    function edit()
    {
        
        $this->load->library('form_validation');
        $this->load->helper('form');
        $id = $this->uri->rsegment('3');
        $info = $this->support_model->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message','Không tồn tại thông tin!');
            redirect(admin_url('support'));

        }

        $this->data['info'] = $info;
        if($this->input->post())
        {
            $this->form_validation->set_rules('name','Tên','required');
            if($this->form_validation->run())
            {
               
                $data=array(
                    'name'=>$this->input->post('name'),
                    'gmail'=>$this->input->post('name'),
                    'skype' =>$this->input->post('skype'),
                    'facebook'  =>$this->input->post('facebook'),
                    'phone'   =>$this->input->post('phone'),
                );
                if($this->support_model->update($id,$data))
                {
                    $this->session->set_flashdata('message','Đã cập nhật !');
                }else
                {
                    $this->session->set_flashdata('message','Lỗi khi cập nhật!');
                }
                redirect(admin_url('support'));
            }
        }
        $this->data['temp'] = 'admin/support/edit';
        $this->load->view('admin/main',$this->data);
    }
}