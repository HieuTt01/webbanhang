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
        if(!$this->session->userdata('user_id_login'))
        {
            redirect();
        }
        $user_id = $this->session->userdata('user_id_login');
        $input['where'] = array('user_id'=>$user_id);
        $total_rows = $this->transaction_model->get_total($input);
        $list = $this->transaction_model->get_list($input);
        $this->data['list'] = $list;
        $this->data['total_row'] = $total_rows;
        $this->data['temp'] = 'frontend/transaction/index';
        $this->load->view('frontend/layout',$this->data);

    }
    function view()
    {
        $id =intval($this->uri->rsegment(3));
        $input['where'] = array('transaction_id'=>$id);
        $this->load->model('order_model');
        $total_rows = $this->order_model->get_total($input);
        $list = $this->order_model->get_list($input);
        $this->load->model('product_model');
        foreach($list as &$row)
        {
            $product = $this->product_model->get_info($row->product_id);
            $row->name = $product->name;
            $row->image_link = $product->image_link;
            $row->price = $product->price;
        }
        $this->data['list'] = $list;
        $this->data['total_row'] = $total_rows;
        $this->data['temp'] = 'frontend/transaction/view';
        $this->load->view('frontend/layout',$this->data);

    }
}