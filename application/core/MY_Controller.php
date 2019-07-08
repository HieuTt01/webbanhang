<?php 
class MY_Controller extends CI_Controller
{
     public $data= array();
    function __construct()
    {
        parent::__construct();
        $controller = $this->uri->segment(1);
        switch($controller)
        {
            case 'admin':
            {
                $this->load->helper('admin');
                $this->_check_login();
                break;
            }
            default:
            {
                //Danh mục
                $this->load->model('catalog_model');
                $input = array();
                $input['where']=array('parent_id' => 0);
                $catalog_list = $this->catalog_model->get_list($input);
                foreach($catalog_list as $row)
                {
                    $input['where'] = array('parent_id' =>$row->id);
                    $subs= $this->catalog_model->get_list($input);
                    $row->subs = $subs;
                }
                $this->data['catalog_list'] = $catalog_list;
                //Bài viét
                $this->load->model('news_model');
                $input = array();
                $input['limit'] = array(5,0);
                $news_list = $this->news_model->get_list($input);
                $this->data['news_list'] = $news_list;
                //user dang nhap
                $user_id_login = $this->session->userdata('user_id_login');
                $this->data['user_id_login'] =  $user_id_login;
                if( $user_id_login)
                {
                    $this->load->model('user_model');
                    $user = $this->user_model->get_info($user_id_login);
                    $this->data['user'] = $user;
                }
                //gio hang
                $this->load->library("cart");
                $this->data['total_items'] = $this->cart->total_items();
                //hotro
                $this->load->model('support_model');
                $support = $this->support_model->get_list();
                $this->data['support'] = $support;
            }
            
        

        }
    }
    private function _check_login()
    {
        $controller = $this->uri->rsegment('1');
        $controller = strtolower($controller);
        $login= $this->session->userdata('login');
        if(!$login && $controller !='login')
        {
            redirect(admin_url('login'));
        }
        if($login && $controller =='login')
        {
            redirect(admin_url('home'));
        }
    }
}