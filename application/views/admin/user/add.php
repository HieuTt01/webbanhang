<?php   $this->load->view('admin/user/head',$this->data);?>

<div class="line"></div>
<div class="wrapper">
	<div class="widget">
	
		<div class="title">
			<h6>Thêm mới Thành viên</h6>
		</div>
        <form id="form" class="form" enctype="multipart/form-data" method="post" action="">
        <fieldset>
            <div class="formRow">
               <label class="formLeft" for="param_name">Họ và tên:<span class="req">*</span></label>
                <div class="formRight">
                   <span class="oneTwo"><input name="name" id="param_name" _autocheck="true" type="text" value="<?php echo set_value('name')?>"></span>
                   <span name="name_autocheck" class="autocheck"></span>
                   <div name="name_error" class="clear error"><?php echo form_error('name')?></div>
               </div>
               <div class="clear"></div>
            </div>
            <div class="formRow">
               <label class="formLeft" for="param_email">Email:<span class="req">*</span></label>
                <div class="formRight">
                   <span class="oneTwo"><input name="email" id="param_email" _autocheck="true" type="text"value="<?php echo set_value('email')?>"></span>
                   <span name="email_autocheck" class="autocheck"></span>
                   <div name="email_error" class="clear error"><?php echo form_error('email')?></div>
               </div>
               <div class="clear"></div>
            </div>
            <div class="formRow">
               <label class="formLeft" for="param_password">Password:<span class="req">*</span></label>
                <div class="formRight">
                   <span class="oneTwo"><input name="password" id="param_password" _autocheck="true" type="password"></span>
                   <span name="password_autocheck" class="autocheck"></span>
                   <div name="password_error" class="clear error"><?php echo form_error('password')?></div>
               </div>
               <div class="clear"></div>
            </div>
            <div class="formRow">
               <label class="formLeft" for="param_re_password">Nhập lại Password:<span class="req">*</span></label>
                <div class="formRight">
                   <span class="oneTwo"><input name="re_password" id="param_re_password" _autocheck="true" type="password"></span>
                   <span name="re_password_autocheck" class="autocheck"></span>
                   <div name="re_password_error" class="clear error"><?php echo form_error('re_password')?></div>
               </div>
               <div class="clear"></div>
            </div>
            <div class="formRow">
               <label class="formLeft" for="param_phone">Số điện thoại:<span class="req">*</span></label>
                <div class="formRight">
                   <span class="oneTwo"><input name="phone" id="param_phone" _autocheck="true" type="text"value="<?php echo set_value('phone')?>"></span>
                   <span name="phone_autocheck" class="autocheck"></span>
                   <div name="phone_error" class="clear error"><?php echo form_error('phone')?></div>
               </div>
               <div class="clear"></div>
            </div>
            <div class="formRow">
               <label class="formLeft" for="param_address">Địa chỉ:<span class="req">*</span></label>
                <div class="formRight">
                   <span class="oneTwo"><input name="address" id="param_address" _autocheck="true" type="text"value="<?php echo set_value('email')?>"></span>
                   <span name="address_autocheck" class="autocheck"></span>
                   <div name="address_error" class="clear error"><?php echo form_error('address')?></div>
               </div>
               <div class="clear"></div>
            </div>
            <div class="formSubmit">
	           	<input type="submit" value="Thêm mới" class="redB">
	        </div>
        </fieldset>
        </form>
    </div>
</div>