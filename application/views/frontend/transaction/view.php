<style>
    table#cart_contents td{padding:10px;border:1px solid #ccc}
</style>
<div class="box-center"><!-- The box-center product-->

      <div class="tittle-box-center">
		     <h2>Chi tiết đơn hàng(<?php echo $total_row?> sản phẩm)</h2>
		      </div>
		      <div class="box-content-center product"><!-- The box-content-center -->
            <?php if($total_row > 0):?>
            <table id="cart_contents"cellpadding="0" cellspacing="0" width="95%" class="sTable mTable myTable withCheck" ">
                        <thead>
                             <td style="color:blue" >Mã giao dịch</td>
                             <td style="color:blue" >Sản phẩm</td>
                             <td style="color:blue">Giá</td>
                             <td style="color:blue">Số lượng</td>
                             <td style="color:blue">Trạng thái</td>
                             <td style="color:blue">...</td>
                      
                        </thead>
                        <tbody>
                        <?php foreach($list as $row):?>
                        <tr>
                             <td style=><?php echo $row->transaction_id?></td>
                             <td>
					            <div class="image_thumb">
						            <img src="<?php echo base_url('upload/product/'.$row->image_link)?>" height="50">
						            <div class="clear"></div>
					            </div>
					
					            <a href="" class="tipS" title="" target="_blank">
					            <b><?php echo $row->name?></b>
					           </a>
					         </td>
                             <td style="color:red"><?php echo number_format($row->price);?>đ</td>
                             <td ><?php echo $row->qty?></td>
                             <td class="textC"><?php
					                if($row->status==0) echo 'Chưa giao hàng';
					                elseif($row->status==1)echo 'Đã giao hàng';
					                else echo 'Đơn hàng đã hủy';
					               ?></td>
                              <td class="option textC">
						        <a href="<?php echo base_url('transaction/delete/'.$row->id)?>"class="tipS" title="Hủy đơn hàng">
								<img src="<?php echo public_url('admin/images')?>/icons/color/delete.png">
						        </a>
					         </td>
                        </tr>
                        <?php endforeach;?>
                       
                        </tbody>
                   </table>
            <?php else:?>
            <h4 style="color:red">Không có sản phẩm!!!</h4>
            <?php endif;?>
              </div>
</div>