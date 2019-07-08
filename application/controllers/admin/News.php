<?php 
class News extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
    }
    function index()
    {
        $message = $this->session->flashdata('message');
       $this->data['message'] = $message;
        $total_rows = $this->news_model->get_total();
        //phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows']=$total_rows;
        $this->data['total_rows'] = $total_rows;
        $config['base_url']= admin_url('news/index');
        $config['per_page']= 5;
        $config['uri_segment']= '4';
        $config['next_link']= "Trang tiếp";
        $config['prev_link']= "Trang trước";
        $this->pagination->initialize($config);
        $input = array();
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array( $config['per_page'],$segment);
        $list= $this->news_model->get_list($input);
        $this->data['list'] = $list;
        //Lọc dữ liệu
        $id = $this->input->get('id');
        $id = intval($id);
        $input['where'] = array();
        if($id > 0)
        {
            $input['where']['id'] = $id;
        }
        $title = $this->input->get('title');
        if($title)
        {
            $input['like'] = array('title',$title);
        }
        // $catalog_id = $this->input->get('catalog');
        // $catalog_id = intval($catalog_id);
        // if($catalog_id > 0)
        // {
        //     $input['where']['catalog_id'] = $catalog_id;
        // }
        $list= $this->news_model->get_list($input);
        $this->data['list'] = $list;
        //Lay danh muc
        // $this->load->model('catalog_model');
        // $input = array();
        // $input['where'] = array('parent_id'=>0);
        // $catalog = $this->catalog_model->get_list($input);
        // foreach($catalog as $row)
        // {
        //     $input['where'] = array('parent_id'=> $row->id);
        //     $subs= $this->catalog_model->get_list($input);
        //     $row->subs=$subs;
        // }
        // $this->data['catalog'] = $catalog;
       $message = $this->session->flashdata('message');
       $this->data['message'] = $message;
        $this->data['temp'] = 'admin/news/index';
       $this->load->view('admin/main',$this->data);
    }
    function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('title','Tiêu đề bài viết','required');
            $this->form_validation->set_rules('content','Nội dung','required');
            if($this->form_validation->run())
            {
                $this->load->library('upload_library');
                $upload_path = './upload/news';
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
                    'image_link'=>$image_link,
                    'title'     =>$this->input->post('title'),
                    'meta_desc' =>$this->input->post('meta_desc'),
                    'meta_key'  =>$this->input->post('meta_key'),
                    'content'   =>$this->input->post('content'),

                );
                if($this->news_model->create($data))
                {
                    $this->session->set_flashdata('message','Đã thêm mới dữ liệu!');
                }else
                {
                    $this->session->set_flashdata('message','Lỗi khi thêm mới dữ liệu!');
                }
                redirect(admin_url('news'));
            }
        }
        $this->data['temp'] = 'admin/news/add';
        $this->load->view('admin/main',$this->data);
    }
    function edit()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        //lay thong tin san pham
        $id = $this->uri->rsegment(3);
        $news = $this->news_model->get_info($id);
        if(!$news)
        {
            $this->session->set_flashdata('message','Không tồn tại dữ liệu!');
            redirect(admin_url('news'));
        }
        $this->data['news']=$news;
        if($this->input->post())
        {
            $this->form_validation->set_rules('title','Tiêu đề bài viết','required');
            $this->form_validation->set_rules('content','Nội dung','required');            
            if($this->form_validation->run())
            {
                $this->load->library('upload_library');
                $upload_path = './upload/news';
                $upload_data = $this->upload_library->upload($upload_path,'image');

                $image_link = '';
                if(isset($upload_data['file_name']))
                {
                    $image_link = $upload_data['file_name'];
                }
                $image_list = array();
                $image_list = $this->upload_library->upload_file($upload_path,'image_list');
                $data=array(
                    'title'     =>$this->input->post('title'),
                    'meta_desc' =>$this->input->post('meta_desc'),
                    'meta_key'  =>$this->input->post('meta_key'),
                    'content'   =>$this->input->post('content'),
                    // 'updated'   =>now(),

                );
                if($image_link!='')
                {
                    $data['image_link']=$image_link;
                }
                if($this->news_model->update($news->id,$data))
                {
                    $this->session->set_flashdata('message','Đã cập nhật dữ liệu!');
                }else
                {
                    $this->session->set_flashdata('message','Lỗi khi cập nhật dữ liệu!');
                }
                redirect(admin_url('news'));
            }
        }
        $this->data['temp'] = 'admin/news/edit';
        $this->load->view('admin/main',$this->data);
    }
    function delete()
    {
        $id = $this->uri->rsegment(3);
        $this->_del($id);
        redirect(admin_url('news'));
        

    }


    function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach($ids as $id)
        {
            $this->_del($id);
        }
        redirect(admin_url('news'));

    }
    private function _del($id)
    {
        $news = $this->news_model->get_info($id);
        if(!$news)
        {
            $this->session->set_flashdata('message','Không tồn tại dữ liệu!');
            redirect(admin_url('news'));
        }
        if($this->news_model->delete($id))
        {
            $this->session->set_flashdata('message','Đã xóa!');
            $image_link ='./upload/news/'.$news->image_link;
            if(file_exists($image_link))
            {
                unlink($image_link);
            }
           
        }else
        {
            $this->session->set_flashdata('message','Lỗi khi xóa!');
        }
    }
}
