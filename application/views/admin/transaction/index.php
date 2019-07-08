<?php   $this->load->view('admin/transaction/head',$this->data);?>

<div class="line"></div>
<div class="wrapper" id="main_transaction">
    <?php $this->load->view('admin/message',$this->data);?>
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
			<h6>
				Danh sách giao dịch
    		</h6>
		 	<div class="num f12">Số lượng: <b><?php echo $total_rows?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
			
			<thead class="filter"><tr><td colspan="7">
				<form class="list_filter form" action="<?php echo admin_url('transaction')?>" method="get">
					<table cellpadding="0" cellspacing="0" width="80%">
                    <tbody>
					
						<tr>
							<td class="label" style="width:40px;"><label for="filter_id">Mã mã giao dịch</label></td>
							<td class="item"><input name="id" value="<?php echo $this->input->get('id')?>" id="filter_id" type="text" style="width:55px;"></td>
							
							<td class="label" style="width:60px;"><label for="filter_status">Thể loại</label></td>
							<td class="item">
								<select name="status">
								    <option value="">Chọn hình thức</option>
									<option value="0">Chưa thanh toán</option>
									<option value="1">Đã thanh toán</option>
									<option value="2">Giao dịch đã hủy</option>
												                               
								</select>
							</td>
							
							<td style="width:150px">
							<input type="submit" class="button blueB" value="Lọc">
							<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('transaction')?>'; ">
							</td>
							
						</tr>
					</tbody>
                    </table>
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin/images')?>/icons/tableArrows.png"></td>
					<td style="width:60px;">Mã giao dịch</td>
					<td>Số tiền</td>
					<td>Hình thức thanh toán</td>
					<td>Trạng thái</td>
					<td style="width:75px;">Ngày tạo</td>
					<td style="width:100px;">Thao tác</td>
				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="7">
						 <div class="list_action itemActions">
								<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('transaction/delete_all')?>">
									<span style="color:white;">Xóa hết</span>
								</a>
						 </div>
							
					     <div class="pagination">
                             <?php echo $this->pagination->create_links()?>
                         </div>
					</td>
				</tr>
			</tfoot>
			
			<tbody class="list_item">
            <?php foreach($list as $row):?>
			    <tr class="row_<?php echo $row->id?>">
					<td><input type="checkbox" name="id[]" value="<?php echo $row->id?>"></td>
					
					<td class="textC"><?php echo $row->id?></td>
					<td class="textR"> 
                       <b style="color:red"><?php echo number_format($row->amount)?> đ</b>
                    </td>
					<td class="textC"><?php echo $row->payment?></td>
					<td class="textC"><?php
					   if($row->status==0) echo 'Chưa thanh toán';
					   elseif($row->status==1)echo 'Đã thanh toán';
					   else echo 'Giao dịch đã hủy';
					?></td>
					<td class="textC"><?php echo $row->created?></td>
					
					<td class="option textC">
						<a href="<?php echo admin_url('transaction/view/'.$row->id)?>" target="_blank" class="tipS" title="Xem chi tiết giao dịch">
								<img src="<?php echo public_url('admin/images')?>/icons/color/view.png">
						 </a>
						
						<a href="<?php echo admin_url('transaction/delete/'.$row->id)?>" title="Xóa" class="tipS verify_action">
						    <img src="<?php echo public_url('admin/images')?>/icons/color/delete.png">
						</a>
					</td>
				</tr>
            <?php endforeach;?>
		    </tbody>
			
		</table>
	</div>
	
</div>
<div class="clear mt30"></div>