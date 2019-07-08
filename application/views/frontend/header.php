
	           <!-- The box-header-->
			        
<link type="text/css" href="<?php echo public_url()?>js/jquery/autocomplete/css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet">	
<script type="text/javascript" src="<?php echo public_url()?>js/jquery/autocomplete/jquery-ui-1.8.16.custom.min.js"></script>

<script type="text/javascript">
$(function() {
    $( "#text-search" ).autocomplete({
        source: "<?php echo site_url('product/search/1')?>",
    });
});
</script>
<div class="top"><!-- The top -->
      <div id="logo"><!-- the logo -->
           <a href="<?php echo base_url()?>" title="Web đồ án 2">
	           <img src="<?php echo public_url()?>/frontend/images/logo.png" style="width:286px;height:83px" alt="web da2">
	       </a>
       </div><!-- End logo -->
       
       <!--  load gio hàng -->
      <div id="cart_expand" class="cart"> 
            <a href="<?php echo base_url('cart')?>" class="cart_link">
               Giỏ hàng <span id="in_cart"><?php echo $total_items?></span> sản phẩm
            </a> 
            <img alt="cart bnc" src="<?php echo public_url()?>/frontend/images/cart.png"> 
</div>       
       <div id="search"><!-- the search -->
			<form method="get" action="<?php echo site_url('product/search')?>">
			     				 <input type="text" id="text-search" name="key_search" value="" placeholder="Tìm kiếm sản phẩm..." class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
				 <input type="submit" id="but" name="but" value="">
			</form>
       </div><!-- End search -->
       
              
    <div class="clear"></div><!-- clear float --> 
</div><!-- End top -->			   <!-- End box-header  -->
               
               <!-- The box-header-->
			        <div id="menu"><!-- the menu -->
           <ul class="menu_top">
                <li class="active index-li"><a href="<?php echo base_url()?>">Trang chủ </a></li>
                <li class=""><a href="<?php echo base_url('tin-tuc')?>">Tin tức</a></li>
                <li class=""><a href="<?php echo base_url('lien-he')?>">Liên hệ</a></li>
                <?php if(isset($user)):?>
                <li class=""><a href="<?php echo site_url('user')?>">Xin chào:<?php echo $user->name?></a></li>
                <li class=""><a href="<?php echo base_url('transaction/index')?>">Thông tin mua hàng</a></li>
                <li class=""><a href="<?php echo base_url('user/logout')?>">Đăng xuất</a></li>
                <?php else:?>
                <li class=""><a href="<?php echo base_url('dang-ky')?>">Đăng ký</a></li>
                <li class=""><a href="<?php echo base_url('dang-nhap')?>">Đăng nhập</a></li>
                <?php endif;?>
            </ul>
</div><!-- End menu -->			   <!-- End box-header  -->
		       
