<?php
class Product extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
    }
    //danh sach sp theo danh muc
    function catalog()
    {
        $id =intval($this->uri->rsegment(3));
        $this->load->model('catalog_model');
        $catalog = $this->catalog_model->get_info($id);
        if(!$catalog)
        {
            redirect();
        }
        $this->data['catalog'] = $catalog;
        //kiem tra danh muc de hien thi
        $input = array();
        if($catalog->parent_id == 0)
        {
            $input_catalog = array();
            // $input_catalog['select'] = 'id';
            $input_catalog['where'] = array('parent_id'=>$id);
            $catalog_subs =$this->catalog_model->get_list($input_catalog);
            if(!empty($catalog_subs))
            {
                $catalog_subs_id = array();
                foreach($catalog_subs as $sub)
                {
                    $catalog_subs_id[] = $sub->id;
                }
                $input['where_in'] = array('catalog_id',$catalog_subs_id);
            }else
            {
                $input['where'] = array('catalog_id'=>$id);
            }

        }else
        {
            $input['where'] = array('catalog_id'=>$id);
        }
        
        
        $total_rows = $this->product_model->get_total($input);
        $this->data['total_rows'] = $total_rows;
        //phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows']=$total_rows;
        $config['base_url']= base_url('product/catalog/'.$id);
        $config['per_page']= 9;
        $config['uri_segment']= '4';
        $config['next_link']= "Trang tiếp";
        $config['prev_link']= "Trang trước";
        $this->pagination->initialize($config);
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array( $config['per_page'], $segment);
        $list= $this->product_model->get_list($input);
        // pre($list);
        foreach($list as &$row)
        {
            $row->raty = ($row->rate_count > 0) ? $row->rate_total/$row->rate_count: 0;
        }
        $this->data['list'] = $list;
        $this->data['temp'] = 'frontend/product/catalog';
        $this->load->view('frontend/layout',$this->data);
    }
    function view() 
    {
        $id = $this->uri->rsegment(3);
        $product = $this->product_model->get_info($id);
        if(!$product)
        {
            redirect();
        }
        $product->raty = ($product->rate_count > 0) ? $product->rate_total/$product->rate_count: 0;
        $this->data['product']=$product;
        //list ảnh
        $image_list =  @json_decode($product->image_list);
        $this->data['image_list'] = $image_list;
        //luot xem
        $data = array();
        $data['view'] = $product->view +1;
        $this->product_model->update($product->id,$data);
        $this->load->model('catalog_model');
        $catalog = $this->catalog_model->get_info($product->catalog_id);
        $this->data['catalog'] = $catalog;
        $this->data['temp'] = 'frontend/product/view';
        $this->load->view('frontend/layout',$this->data);
        
    }
    function search()
    {
        if($this->uri->rsegment(3)==1)
        {
            $key = $this->input->get('term');
        }
        else
        {
            $key = $this->input->get('key_search');
        }
        
        $this->data['key'] = trim($key);
        $input['like'] = array('name',$key);
        // $list = $this->product_model->get_list($input);
        $total_rows = $this->product_model->get_total($input);
        $this->data['total_rows'] = $total_rows;
        $this->load->library('pagination');
        $config = array();
        $config['total_rows']=$total_rows;
        $config['base_url']= base_url('product/search');
        $config['per_page']= 9;
        $config['uri_segment']= '4';
        $config['next_link']= "Trang tiếp";
        $config['prev_link']= "Trang trước";
        $this->pagination->initialize($config);
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array( $config['per_page'], $segment);
        $list= $this->product_model->get_list($input);
        foreach($list as &$row)
        {
            $row->raty = ($row->rate_count > 0) ? $row->rate_total/$row->rate_count: 0;
        }
        $this->data['list'] = $list;
        if($this->uri->rsegment(3)==1)
        {
            $result = array();
            foreach($list as $row)
            {
                $item = array();
                $item['id'] = $row->id;
                $item['label'] = $row->name;
                $item['value'] = $row->name;
                $result[] =$item;
            }
            die(json_encode($result));
        }
        else
        {  
            $this->data['temp'] = 'frontend/product/search';
            $this->load->view('frontend/layout',$this->data);
        }
    }
    function search_price()
    {
        $price_from =intval($this->input->get('price_from'));
        $price_to = intval($this->input->get('price_to'));
        $this->data['price_from'] = $price_from;
        $this->data['price_to'] = $price_to;
        $input = array();
        $input['where'] = array('price >=' =>$price_from,'price <=' =>$price_to);
        $total_rows = $this->product_model->get_total($input);
        $this->data['total_rows'] = $total_rows;
        $this->load->library('pagination');
        $config = array();
        $config['total_rows']=$total_rows;
        $config['base_url']= base_url('product/search');
        $config['per_page']= 9;
        $config['uri_segment']= '4';
        $config['next_link']= "Trang tiếp";
        $config['prev_link']= "Trang trước";
        $this->pagination->initialize($config);
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array( $config['per_page'], $segment);
        $list=$this->product_model->get_list($input);
        foreach($list as &$row)
        {
            $row->raty = ($row->rate_count > 0) ? $row->rate_total/$row->rate_count: 0;
        }
        $this->data['list'] = $list;
        $this->data['temp'] = 'frontend/product/search_price';
        $this->load->view('frontend/layout',$this->data);

    }
    function raty()
    {
        $result = array();
        $id = $this->input->post('id');
        $id = (!is_numeric($id)) ? 0 : $id;
        $info = $this->product_model->get_info($id);
        if(!$info)
        {
            exit();
        }
        $raty = $this->session->userdata('session_raty');
        $raty = (!is_array($raty)) ? array() : $raty;
        $result = array();
        if(isset($raty[$id]))
        {
            $result['msg'] = 'Bạn chỉ được đánh giá 1 lần cho sản phẩm';
            $output = json_encode($result);
            exit();
        }
        $raty[$id] = TRUE;
        $this->session->set_userdata('session_raty',$raty);
        $score = $this->input->post('score');
        $data = array();
        $data['rate_total'] = $info->rate_total +$score;
        $data['rate_count'] = $info->rate_count +1;
        $this->product_model->update($id,$data);
        $result['complete'] = TRUE;
        $result['msg'] = 'Cảm ơn bạn đã đánh giá sản phẩm';
        $output = json_encode($result);
        echo $output;
        exit();


    }
}