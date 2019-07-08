
<style>
     table td{
         padding:10px;
         border:1px solid #f0f0f0;


     }
</style>
<div class="box-center"><!-- The box-center product-->

    <div class="tittle-box-center">
       <h2>Thông tin thành viên</h2>
        </div>
        <div class="box-content-center product"><!-- The box-content-center -->
            <table >
                  <tr>
                     <td><label class="form-label" for="param_name">Họ và tên</label></td>
                     <td><?php echo $user->name?></td>
                  </tr>
                  <tr>
                     <td><label class="form-label" for="param_email">Email</label></td>
                     <td><?php echo $user->name?></td>
                  </tr>
                  <tr>
                     <td><label class="form-label" for="param_phone">Số điện thoại</label></td>
                     <td><?php echo $user->phone?></td>
                  </tr>
                  <tr>
                     <td><label class="form-label" for="param_address">Địa chỉ</label></td>
                     <td><?php echo $user->address?></td>
                  </tr>
            </table>
            <div class="clear"></div>
            <a href="<?php echo site_url('user/edit')?>" class="button">Cập nhật thông tin</a>
        </div>
    </div>
</div>
