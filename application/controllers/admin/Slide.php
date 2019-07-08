<?php 
class Slide extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('slide_model');
    }
    function index()
    {
        $message = $this->session->flashdata('message');
       $this->data['message'] = $message;
        $total_rows = $this->slide_model->get_total();
        //phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows']=$total_rows;
        $this->data['total_rows'] = $total_rows;
        $config['base_url']= admin_url('slide/index');
        $config['per_page']= 5;
        $config['uri_segment']= '4';
        $config['next_link']= "Trang tiếp";
        $config['prev_link']= "Trang trước";
        $this->pagination->initialize($config);
        $input = array();
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array( $config['per_page'],$segment);
        $list= $this->slide_model->get_list($input);
        $this->data['list'] = $list;
       
        $list= $this->slide_model->get_list($input);
        $this->data['list'] = $list;
      
       $message = $this->session->flashdata('message');
       $this->data['message'] = $message;
        $this->data['temp'] = 'admin/slide/index';
       $this->load->view('admin/main',$this->data);
    }
    function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('name','Tiêu đề slide','required');
            if($this->form_validation->run())
            {
                $this->load->library('upload_library');
                $upload_path = './upload/slide';
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
                    'name'     =>$this->input->post('name'),
                    'link' =>$this->input->post('link'),
                    'info'  =>$this->input->post('info'),
                    'sort_order'   =>$this->input->post('sort_order'),

                );
                if($this->slide_model->create($data))
                {
                    $this->session->set_flashdata('message','Đã thêm mới dữ liệu!');
                }else
                {
                    $this->session->set_flashdata('message','Lỗi khi thêm mới dữ liệu!');
                }
                redirect(admin_url('slide'));
            }
        }
        $this->data['temp'] = 'admin/slide/add';
        $this->load->view('admin/main',$this->data);
    }
    function edit()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        //lay thong tin san pham
        $id = $this->uri->rsegment(3);
        $slide = $this->slide_model->get_info($id);
        if(!$slide)
        {
            $this->session->set_flashdata('message','Không tồn tại dữ liệu!');
            redirect(admin_url('slide'));
        }
        $this->data['slide']=$slide;
        if($this->input->post())
        {
            $this->form_validation->set_rules('name','Tiêu đề slide','required');          
            if($this->form_validation->run())
            {
                $this->load->library('upload_library');
                $upload_path = './upload/slide';
                $upload_data = $this->upload_library->upload($upload_path,'image');

                $image_link = '';
                if(isset($upload_data['file_name']))
                {
                    $image_link = $upload_data['file_name'];
                }
                $image_list = array();
                $image_list = $this->upload_library->upload_file($upload_path,'image_list');
                $data=array(
                    'name'     =>$this->input->post('name'),
                    'link' =>$this->input->post('link'),
                    'info'  =>$this->input->post('info'),
                    'sort_order'   =>$this->input->post('sort_order'),

                );
                if($image_link!='')
                {
                    $data['image_link']=$image_link;
                }
                if($this->slide_model->update($slide->id,$data))
                {
                    $this->session->set_flashdata('message','Đã cập nhật dữ liệu!');
                }else
                {
                    $this->session->set_flashdata('message','Lỗi khi cập nhật dữ liệu!');
                }
                redirect(admin_url('slide'));
            }
        }
        $this->data['temp'] = 'admin/slide/edit';
        $this->load->view('admin/main',$this->data);
    }
    function delete()
    {
        $id = $this->uri->rsegment(3);
        $this->_del($id);
        redirect(admin_url('slide'));
        

    }


    function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach($ids as $id)
        {
            $this->_del($id);
        }
        redirect(admin_url('slide'));

    }
    private function _del($id)
    {
        $slide = $this->slide_model->get_info($id);
        if(!$slide)
        {
            $this->session->set_flashdata('message','Không tồn tại dữ liệu!');
            redirect(admin_url('slide'));
        }
        if($this->slide_model->delete($id))
        {
            $this->session->set_flashdata('message','Đã xóa!');
            $image_link ='./upload/slide/'.$slide->image_link;
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
