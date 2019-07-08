<style>
    table#cart_contents td{padding:10px;border:1px solid #ccc}
</style>
<div class="box-center"><!-- The box-center product-->

      <div class="tittle-box-center">
		     <h2>Thông tin giỏ hàng(<?php echo $total_items?> sản phẩm)</h2>
		      </div>
		      <div class="box-content-center product"><!-- The box-content-center -->
            <?php if($total_items > 0):?>
              <form action="<?php echo base_url('cart/update')?>" method="get">
                   <table id="cart_contents"cellpadding="0" cellspacing="0" width="95%" class="sTable mTable myTable withCheck" ">
                        <thead>
                        
                             <td style="color:teal" >Sản phẩm</td>
                             <td style="color:teal">Giá bán</td>
                             <td style="color:teal">Số lượng</td>
                             <td style="color:teal">Tổng số</td>
                             <td style="color:teal">Thao tác</td>
                      
                        </thead>
                        <tbody>
                        <?php $total_amount = 0;?> 
                        <?php foreach($carts as $row):?>
                        <?php $total_amount = $total_amount + $row['subtotal'];?> 
                        <tr>
                             <td style="color:grey"><?php echo $row['name'];?></td>
                             <td style="color:grey"><?php echo number_format($row['price']);?>đ</td>
                             <td style="color:grey"><input  name="qty_<?php echo $row['id']?>" value = "<?php echo $row['qty'];?>"size= "5"/></td>
                             <td style="color:grey"><?php echo number_format($row['subtotal'])?>đ</td>
                             <td><a style="color:red"href="<?php echo base_url('cart/delete/'.$row['id'])?>">Xóa</a></td>
                        </tr>
                       
                        <?php endforeach;?>
                        <tr>
                           <td style="color:blue" colspan = "5">Tổng số tiền thanh toán:<b style="color:red"> <?php echo number_format($total_amount)?>đ</b></td>
                        </tr>
                        <tr>
                           <td colspan = "5"><a style="color:red" href="<?php echo base_url('cart/delete')?>">Xóa giỏ hàng</a></td>
                        </tr>
                        <tr>
                           <td colspan = "5">
                              <button type="submit" style="color:green">Cập nhật</button>
                              <a class="button" href="<?php echo site_url('order/checkout')?>">Mua hàng</a>
                           </td>
                        </tr>
                        </tbody>
                   </table>
                </form>
            <?php else:?>
            <h4 style="color:red">Không có sản phẩm trong giỏ hàng!!!</h4>
            <?php endif;?>
              </div>
</div>