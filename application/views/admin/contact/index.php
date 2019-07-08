<?php   $this->load->view('admin/contact/head',$this->data);?>

<div class="line"></div>
<div class="wrapper" id="main_contact">
    <?php $this->load->view('admin/message',$this->data);?>
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
			<h6>
				Danh sách các liên hệ
    		</h6>
		 	<div class="num f12">Số lượng: <b><?php echo $total_rows?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
	       <thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin/images')?>/icons/tableArrows.png"></td>
					<td style="width:60px;">Mã số</td>
					<td>Họ và tên</td>
					<td>Email</td>
					<td>Address</td>
					<td>Số điện thoại</td>
					<td>Tiêu đề</td>
					<td>Nội dung</td>
					<td>Ngày tạo</td>
					<td>Thao tác</td>

				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="10">
						 <div class="list_action itemActions">
								<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('contact/delete_all')?>">
									<span style="color:white;">Xóa hết</span>
								</a>
						 </div>
							
					</td>
				</tr>
			</tfoot>
			
			<tbody class="list_item">
            <?php foreach($list as $row):?>
			    <tr class="row_<?php echo $row->id?>">
					<td><input type="checkbox" name="id[]" value="<?php echo $row->id?>"></td>
					
					<td class="textC"><?php echo $row->id?></td>
					<td class="textC"><?php echo $row->name?> </td>
					<td class="textC"><?php echo $row->email?></td>
					<td class="textC"><?php echo $row->address?></td>
					<td class="textC"><?php echo $row->phone?></td>
					<td class="textC"><?php echo $row->title?></td>
					<td class="textC"><?php echo $row->content?></td>
					<td class="textC"><?php echo $row->created?></td>
					  
					
					<td class="option textC">
					    <a rel="nofollow"  title="<?php echo $row->email?>" href="mailto:<?php echo $row->email?>">
			                <img  style="margin-bottom:-3px" src="<?php echo public_url()?>/frontend/images/email.png">Gửi mail
		                </a>
						<a href="<?php echo admin_url('contact/delete/'.$row->id)?>" title="Xóa" class="tipS verify_action">
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