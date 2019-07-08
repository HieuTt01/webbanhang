<?php
class Order extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

    }
    function checkout()
    {
        $cart = $this->cart->contents();
        $total_items = $this->cart->total_items();
        if($total_items <= 0)
        {
            redirect();
        }
        //tien thanh toan
        $total_amount = 0;
        foreach($cart as $row)
        {
            $total_amount = $total_amount + $row['subtotal'];
        }
        $this->data['total_amount'] = $total_amount;
        $user_id = 0;
        if($this->session->userdata('user_id_login'))
        {
            $user_id = $this->session->userdata('user_id_login');
            $user = $this->user_model->get_info($user_id);
            $this->data['user'] = $user;
        }
        
        
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('email','Email nhận hàng','required');
            $this->form_validation->set_rules('name','Tên','required|min_length[8]');
            $this->form_validation->set_rules('phone','Số điện thoại','required');
            $this->form_validation->set_rules('address','Địa chỉ','required');
            $this->form_validation->set_rules('payment','Hình thức thanh toán','required');
            if($this->form_validation->run())
            {
                $payment = $this->input->post('payment');
                $data=array(
                    'status'=>0,
                    'user_id'=>$user_id,
                    'user_email'=>$this->input->post('email'),
                    'user_name'=>$this->input->post('name'),
                    'user_phone'=>$this->input->post('phone'),
                    'user_address'=>$this->input->post('address'),
                    'message'=>$this->input->post('message'),
                    'amount'=>$total_amount,
                    'payment'=>$payment,

                );
                //transaction
                $this->load->model('transaction_model');
                $this->transaction_model->create($data);
                $transaction_id = $this->db->insert_id();
                //order
                $this->load->model('order_model');
                foreach($cart as $row)
                {
                    $data = array(
                        'transaction_id' =>$transaction_id,
                        'product_id'     =>$row['id'],
                        'qty'            =>$row['qty'],
                        'amount'         =>$row['subtotal'],
                        'status'         =>0
                    ); 
                    $this->order_model->create($data);

                }
                if($payment == 'offline')
                {
                    $this->session->set_flashdata('message','Đặt hàng thành công! Cửa hàng sẽ kiểm tra và gửi hàng cho bạn!');      
                    $this->cart->destroy();  
                    redirect(base_url());
                }
                else
                {
                    $this->session->set_flashdata('message','Đặt hàng thành công! Cửa hàng sẽ kiểm tra và gửi hàng cho bạn!'); 
                    $this->cart->destroy();       
                    redirect('https://www.baokim.vn');
                }
                
                
            }
        }
        $this->data['temp'] = 'frontend/order/checkout';
        $this->load->view('frontend/layout',$this->data);

    }
}