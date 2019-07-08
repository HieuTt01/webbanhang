
<div class="box-center"><!-- The box-center product-->

<div class="tittle-box-center">
       <h2>Thông tin liên hệ</h2>
        </div>
        <div class="box-content-center product"><!-- The box-content-center -->
        <div class="box-content-center register"><!-- The box-content-center -->
            <form enctype="multipart/form-data" action="<?php echo site_url('contact/index')?>" method="post" class="t-form form_action">
                  <div class="form-row">
						<label class="form-label" for="param_email">Email:<span class="req">*</span></label>
						<div class="form-item">
                        <input type="text" value="<?php echo isset($user->email)? $user->email : ''?>" name="email" id="email" class="input">
							<div class="clear"></div>
							<div id="email_error" class="error"><?php echo form_error('email')?></div>
						</div>
						<div class="clear"></div>
				  </div>
				  <div class="form-row">
						<label class="form-label" for="param_name">Họ và tên:<span class="req">*</span></label>
						<div class="form-item">
							<input type="text" value="<?php echo isset($user->name)? $user->name : ''?>" name="name" id="name" class="input">
							<div class="clear"></div>
							<div id="name_error" class="error"><?php echo form_error('name')?></div>
						</div>
						<div class="clear"></div>
				  </div>
				  <div class="form-row">
						<label class="form-label" for="param_phone">Số điện thoại:<span class="req">*</span></label>
						<div class="form-item">
							<input type="text" value="<?php echo isset($user->phone)? $user->phone : ''?>" name="phone" id="phone" class="input">
							<div class="clear"></div>
							<div id="phone_error" class="error"><?php echo form_error('phone')?></div>
						</div>
						<div class="clear"></div>
				  </div>
				  
				  <div class="form-row">
						<label class="form-label" for="param_address">Địa chỉ:<span class="req">*</span></label>
						<div class="form-item">
							<textarea name="address" id="address" class="input"><?php echo isset($user->address)? $user->address : ''?></textarea>
							<div class="clear"></div>
							<div id="address_error" class="error"><?php echo form_error('address')?></div>
						</div>
						<div class="clear"></div>
				  </div>
                  <div class="form-row">
						<label class="form-label" for="param_name">Tiêu đề :</label>
						<div class="form-item">
                           <textarea name="title" id="title" class="input"></textarea>
                           <div id="message_error" class="error"><?php echo form_error('title')?></div>
						</div>
						<div class="clear"></div>
				  </div>
                  <div class="form-row">
						<label class="form-label" for="param_message">Nội dung:</label>
						<div class="form-item">
							<textarea name="content" id="content" class="input"></textarea>
							<div class="clear"></div>
							<div id="message_error" class="error"><?php echo form_error('content')?></div>
						</div>
						<div class="clear"></div>
				  </div>
                  
				   <!-- <div class="form-row">
						<label class="form-label" for="param_re_password">Ảnh đại diện:<span class="req">*</span></label>
						<div class="form-item">
							<input type="file" name="avata" id="avata">
							<div class="clear"></div>
							<div id="avata_error" class="error"></div>
						</div>
						<div class="clear"></div>
				  </div> -->
				  
				  <div class="form-row">
						<label class="form-label">&nbsp;</label>
						<div class="form-item">
				           	<input type="submit" name="submit" value="Xác nhận" class="button">
						</div>
				   </div>
            </form>
         </div>
        <div class="clear"></div>
      </div><!-- End box-content-center -->

      
</div>