<?php
class Cart extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function add()
    {
        $this->load->model('product_model');
        $id = $this->uri->rsegment(3);
        $product = $this->product_model->get_info($id);
        if(!$product)
        {
            redirect();
        }
        $qty = 1;
        $data = array();
        $data['id'] = $product->id;
        $data['qty'] = $qty;
        $data['name']= url_title($product->name);
        $data['image_link']= $product->image_link;
        $price = $product->price;
        if($product->discount >0)
        {
            $price = intval($product->price - ($product->price * $product->discount)/100);
        }
        $data['price'] = $product->price;
        $this->cart->insert($data);
        redirect(base_url('cart'));
    }
    function index()
    {
        $carts = $this->cart->contents();
        $total_items = $this->cart->total_items();
        $this->data['carts']= $carts;
        $this->data['total_items'] = $total_items;
        $this->data['temp'] = 'frontend/cart/index';
        $this->load->view('frontend/layout', $this->data);


    }
    function delete()
    {
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        if($id> 0)

        
        {
            $carts = $this->cart->contents();
            foreach($carts as $key=>$row)
            if($row['id'] == $id)
            {
                $data['rowid'] = $key;
                $data['qty'] = 0;
                $this->cart->update($data);
            }
            
        }else{
            $this->cart->destroy();
        }
        redirect(base_url('cart'));

    }
     function update()
    {
        $carts = $this->cart->contents();
        foreach($carts as $key=>$row)
        {
            $total_qty = $this->input->get('qty_'.$row['id']);
            $data = array();
            $data['rowid'] = $key;
            $data['qty'] = $total_qty;
            $this->cart->update($data);

        }
        redirect(base_url('cart'));
    }
}