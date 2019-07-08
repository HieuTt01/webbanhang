<?php 
class News extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
    }
    function view()
    {
        $id = $this->uri->rsegment(3); 
        $new = $this->news_model->get_info($id);
        if(!$new)
        {
            redirect();
        }
        $view= $new->count_view +1;
        $data =array();
        $data=array('count_view'=>$view);
        $this->news_model->update($id,$data);
        $this->data['new'] = $new;
        $this->data['temp'] = 'frontend/news/view';
        $this->load->view('frontend/layout',$this->data);
       
    }
    function index()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $list = $this->news_model->get_list();
        if(empty($list))
        {
            $this->session->set_flashdata('message','Không có tin tức nào!');
            redirect(base_url());
        }
        $this->data['list'] = $list;
        $this->data['temp'] = 'frontend/news/index';
        $this->load->view('frontend/layout',$this->data);
    }
}