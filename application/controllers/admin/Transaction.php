<?php 
class Transaction extends MY_Controller
{
    function __construct()
    {
        
        parent::__construct();
        $this->load->model('transaction_model');
    }
    function index()
    {
        $message = $this->session->flashdata('message');
       $this->data['message'] = $message;
        $total_rows = $this->transaction_model->get_total();
        //phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows']=$total_rows;
        $this->data['total_rows'] = $total_rows;
        $config['base_url']= admin_url('transaction/index');
        $config['per_page']= 9;
        $config['uri_segment']= '4';
        $config['next_link']= "Trang tiếp";
        $config['prev_link']= "Trang trước";
        $this->pagination->initialize($config);
        $input = array();
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array( $config['per_page'],$segment);
        $list= $this->transaction_model->get_list($input);
        $this->data['list'] = $list;
        //Lọc dữ liệu
        $id = $this->input->get('id');
        $id = intval($id);
        $status = $this->input->get('status');
        $status= intval($status);
        $input['where'] = array();
        if($id > 0)
        {
            $input['where']['id'] = $id;
        }
        if($status >= 0)
        {
            $input['where']['status'] = $status;
        }
        $list= $this->transaction_model->get_list($input);
        $this->data['list'] = $list;
       $message = $this->session->flashdata('message');
       $this->data['message'] = $message;
        $this->data['temp'] = 'admin/transaction/index';
       $this->load->view('admin/main',$this->data);
    }
    function delete()
    {
        $id = $this->uri->rsegment(3);
        $this->_del($id);
        redirect(admin_url('transaction'));
        

    }


    function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach($ids as $id)
        {
            $this->_del($id);
        }
        redirect(admin_url('transaction'));

    }
    private function _del($id)
    {
        $transaction = $this->transaction_model->get_info($id);
        if(!$transaction)
        {
            $this->session->set_flashdata('message','Không tồn tại dữ liệu!');
            redirect(admin_url('transaction'));
        }
        if($this->transaction_model->delete($id))
        {
            $this->session->set_flashdata('message','Đã xóa!');
        }
        else
        {
            $this->session->set_flashdata('message','Lỗi khi xóa!');
        }
    }
}