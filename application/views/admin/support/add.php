<?php   $this->load->view('admin/support/head',$this->data);?>
<div class="line"></div>
<div class="wrapper">
   <!-- Form -->
   <form class="form" id="form" action="<?php echo admin_url('support/add')?>" method="post" enctype="multipart/form-data">
      <fieldset>
         <div class="widget">
            <div class="title">
               <img src="<?php echo public_url('admin')?>/images/icons/dark/add.png" class="titleIcon">
               <h6>Thêm mới Bài viết</h6>
            </div>
            <div class="tab_container">
            <div class="formRow">
                     <label class="formLeft" for="param_name">Họ và tên:</span></label>
                     <div class="formRight">
                        <span class="oneTwo"><input name="name" id="param_title" _autocheck="true" type="text"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"></div>
                     </div>
                     <div class="clear"></div>
                  </div>
            </div>
            <div class="formRow">
                     <label class="formLeft" for="param_name">Gmail:</span></label>
                     <div class="formRight">
                        <span class="oneTwo"><input name="gmail" id="param_title" _autocheck="true" type="text"></span>
                        <span name="title_autocheck" class="autocheck"></span>
                        <div name="gmail_error" class="clear error"></div>
                     </div>
                     <div class="clear"></div>
                  </div>
                  <div class="formRow">
                     <label class="formLeft" for="param_name">Skype:</span></label>
                     <div class="formRight">
                        <span class="oneTwo"><input name="skype" id="param_title" _autocheck="true" type="text"></span>
                        <span name="title_autocheck" class="autocheck"></span>
                        <div name="skype_error" class="clear error"></div>
                     </div>
                     <div class="clear"></div>
                  </div>
                  <div class="formRow">
                     <label class="formLeft" for="param_name">Facebook:</span></label>
                     <div class="formRight">
                        <span class="oneTwo"><input name="facebook" id="param_title" _autocheck="true" type="text"></span>
                        <span name="title_autocheck" class="autocheck"></span>
                        <div name="facebook_error" class="clear error"></div>
                     </div>
                     <div class="clear"></div>
                  </div>
                  <div class="formRow">
                     <label class="formLeft" for="param_name">Số điện thoại:</span></label>
                     <div class="formRight">
                        <span class="oneTwo"><input name="phone" id="param_title" _autocheck="true" type="text"></span>
                        <span name="title_autocheck" class="autocheck"></span>
                        <div name="phone_error" class="clear error"></div>
                     </div>
                     <div class="clear"></div>
                  </div>
            <!-- End tab_container-->
            <div class="formSubmit">
               <input type="submit" value="Thêm mới" class="redB">
               <input type="reset" value="Hủy bỏ" class="basic">
            </div>
            <div class="clear"></div>
         </div>
      </fieldset>
   </form>
</div>
<div class="clear mt30"></div>