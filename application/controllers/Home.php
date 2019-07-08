<?php 
class Home extends MY_Controller
{
    function index()
    {

        //slide
        $this->load->model('slide_model');
        $slide_list = $this->slide_model->get_list();
        $this->data['slide_list'] = $slide_list;
        //san pham moi
        $this->load->model('product_model');
        $input = array();
        $input['limit'] = array(3,0);
        $product_new = $this->product_model->get_list($input);
        foreach($product_new as &$row)
        {
            $row->raty = ($row->rate_count > 0) ? $row->rate_total/$row->rate_count: 0;
        }
        $this->data['product_new']= $product_new;

        //san pham mua nhieu
        $input['order'] = array('buyed','desc');
        $product_buy = $this->product_model->get_list($input);
        foreach($product_buy as &$row)
        {
            $row->raty = ($row->rate_count > 0) ? $row->rate_total/$row->rate_count: 0;
        }
        $this->data['product_buy']= $product_buy;
        //message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        //


        $this->data['temp']='frontend/home/index';
        $this->load->view('frontend/layout',$this->data);
    }
}