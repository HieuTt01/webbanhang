<?php 
class Product extends MY_Controller
{
    function __construct()
    {
        
        parent::__construct();
        $this->load->model('product_model');
    }
    function index()
    {
        $message = $this->session->flashdata('message');
       $this->data['message'] = $message;
        $total_rows = $this->product_model->get_total();
        //phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows']=$total_rows;
        $this->data['total_rows'] = $total_rows;
        $config['base_url']= admin_url('product/index');
        $config['per_page']= 5;
        $config['uri_segment']= '4';
        $config['next_link']= "Trang tiếp";
        $config['prev_link']= "Trang trước";
        $this->pagination->initialize($config);
        $input = array();
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array( $config['per_page'],$segment);
        $list= $this->product_model->get_list($input);
        $this->data['list'] = $list;
        //Lọc dữ liệu
        $id = $this->input->get('id');
        $id = intval($id);
        $input['where'] = array();
        if($id > 0)
        {
            $input['where']['id'] = $id;
        }
        $name = $this->input->get('name');
        if($name)
        {
            $input['like'] = array('name',$name);
        }
        $catalog_id = $this->input->get('catalog');
        $catalog_id = intval($catalog_id);
        if($catalog_id > 0)
        {
            $input['where']['catalog_id'] = $catalog_id;
        }
        $list= $this->product_model->get_list($input);
        $this->data['list'] = $list;
        //Lay danh muc
        $this->load->model('catalog_model');
        $input = array();
        $input['where'] = array('parent_id'=>0);
        $catalog = $this->catalog_model->get_list($input);
        foreach($catalog as $row)
        {
            $input['where'] = array('parent_id'=> $row->id);
            $subs= $this->catalog_model->get_list($input);
            $row->subs=$subs;
        }
        $this->data['catalog'] = $catalog;
       $message = $this->session->flashdata('message');
       $this->data['message'] = $message;
        $this->data['temp'] = 'admin/product/index';
       $this->load->view('admin/main',$this->data);
    }
    function add()
    {
         //Lay danh muc
        $this->load->model('catalog_model');
        $input = array();
        $input['where'] = array('parent_id'=>0);
        $catalog = $this->catalog_model->get_list($input);
        foreach($catalog as $row)
        {
            $input['where'] = array('parent_id'=> $row->id);
            $subs= $this->catalog_model->get_list($input);
            $row->subs=$subs;
        }
        $this->data['catalog'] = $catalog;

        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('name','Tên sản phẩm','required');
            $this->form_validation->set_rules('catalog','Thể loại','required');
            $this->form_validation->set_rules('price','Giá','required');
            if($this->form_validation->run())
            {
                $name=$this->input->post('name');
                $catalog_id=$this->input->post('catalog');
                $price=$this->input->post('price');
                $price= str_replace(',','',$price);
                $this->load->library('upload_library');
                $upload_path = './upload/product';
                $upload_data = $this->upload_library->upload($upload_path,'image');

                $image_link = '';
                if(isset($upload_data['file_name']))
                {
                    $image_link = $upload_data['file_name'];
                }
                $image_list = array();
                $image_list = $this->upload_library->upload_file($upload_path,'image_list');
                $image_list = json_encode($image_list);
                $data=array(
                    'name'      =>$name,
                    'catalog_id'=>$catalog_id,
                    'price'     =>$price,
                    'image_link'=>$image_link,
                    'image_list'=>$image_list,
                    'discount'  =>$this->input->post('discount'),
                    'warranty'  =>$this->input->post('warranty'),
                    'gift'      =>$this->input->post('gift'),
                    'site_title'=>$this->input->post('site_title'),
                    'meta_desc' =>$this->input->post('meta_desc'),
                    'meta_key'  =>$this->input->post('meta_key'),
                    'content'   =>$this->input->post('content'),
                    'video'   =>$this->input->post('video'),

                );
                if($this->product_model->create($data))
                {
                    $this->session->set_flashdata('message','Đã thêm mới dữ liệu!');
                }else
                {
                    $this->session->set_flashdata('message','Lỗi khi thêm mới dữ liệu!');
                }
                redirect(admin_url('product'));
            }
        }
        $this->data['temp'] = 'admin/product/add';
        $this->load->view('admin/main',$this->data);
    }
    function edit()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        //lay thong tin san pham
        $id = $this->uri->rsegment(3);
        $product = $this->product_model->get_info($id);
        if(!$product)
        {
            $this->session->set_flashdata('message','Không tồn tại dữ liệu!');
            redirect(admin_url('product'));
        }
        $this->data['product']=$product;
        //lay danh muc
        $this->load->model('catalog_model');
        $input = array();
        $input['where'] = array('parent_id'=>0);
        $catalog = $this->catalog_model->get_list($input);
        foreach($catalog as $row)
        {
            $input['where'] = array('parent_id'=> $row->id);
            $subs= $this->catalog_model->get_list($input);
            $row->subs=$subs;
        }
        $this->data['catalog'] = $catalog;
        if($this->input->post())
        {
            $this->form_validation->set_rules('name','Tên sản phẩm','required');
            $this->form_validation->set_rules('catalog','Thể loại','required');
            $this->form_validation->set_rules('price','Giá','required');
            if($this->form_validation->run())
            {
                $name=$this->input->post('name');
                $catalog_id=$this->input->post('catalog');
                $price=$this->input->post('price');
                $price= str_replace(',','',$price);
                $this->load->library('upload_library');
                $upload_path = './upload/product';
                $upload_data = $this->upload_library->upload($upload_path,'image');

                $image_link = '';
                if(isset($upload_data['file_name']))
                {
                    $image_link = $upload_data['file_name'];
                }
                $image_list = array();
                $image_list = $this->upload_library->upload_file($upload_path,'image_list');
                $data=array(
                    'name'      =>$name,
                    'catalog_id'=>$catalog_id,
                    'price'     =>$price,
                    'discount'  =>$this->input->post('discount'),
                    'warranty'  =>$this->input->post('warranty'),
                    'gift'      =>$this->input->post('gift'),
                    'site_title'=>$this->input->post('site_title'),
                    'meta_desc' =>$this->input->post('meta_desc'),
                    'meta_key'  =>$this->input->post('meta_key'),
                    'content'   =>$this->input->post('content'),
                    'video'   =>$this->input->post('video'),

                );
                if($image_link!='')
                {
                    $data['image_link']=$image_link;
                }
                if(!empty($image_list))
                {
                    $image_list = json_encode($image_list);
                    $data['image_list']=$image_list;
                }
                if($this->product_model->update($product->id,$data))
                {
                    $this->session->set_flashdata('message','Đã cập nhật dữ liệu!');
                }else
                {
                    $this->session->set_flashdata('message','Lỗi khi cập nhật dữ liệu!');
                }
                redirect(admin_url('product'));
            }
        }
        $this->data['temp'] = 'admin/product/edit';
        $this->load->view('admin/main',$this->data);
    }
    function delete()
    {
        $id = $this->uri->rsegment(3);
        $this->_del($id);
        redirect(admin_url('product'));
        

    }


    function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach($ids as $id)
        {
            $this->_del($id);
        }
        redirect(admin_url('product'));

    }
    private function _del($id)
    {
        $product = $this->product_model->get_info($id);
        if(!$product)
        {
            $this->session->set_flashdata('message','Không tồn tại dữ liệu!');
            redirect(admin_url('product'));
        }
        if($this->product_model->delete($id))
        {
            $this->session->set_flashdata('message','Đã xóa!');
            $image_link ='./upload/product/'.$product->image_link;
            if(file_exists($image_link))
            {
                unlink($image_link);
            }
            $image_list = json_decode($product->image_list);
            if(is_array($image_list))
            {
                foreach($image_list as $image)
                {
                    $img ='./upload/product/'.$image;
                    if(file_exists($img))
                    {
                        unlink($img);
                    }
                }
            }
        }else
        {
            $this->session->set_flashdata('message','Lỗi khi xóa!');
        }
    }
}
