
                <meta http-equiv="Content-Type" content="text/html ;charset=utf-8">
        <!-- the CSS -->
        <link type="text/css" href="<?php echo public_url()?>/frontend/css/reset.css" rel="stylesheet">
        <link type="text/css" href="<?php echo public_url()?>/frontend/css/style.css" rel="stylesheet">
        <link type="text/css" href="<?php echo public_url()?>/frontend/css/menu.css" rel="stylesheet">
        <link type="text/css" href="<?php echo public_url()?>/frontend/css/input.css" rel="stylesheet">
        <link type="text/css" href="<?php echo public_url()?>/frontend/css/product.css" rel="stylesheet">
        <link type="text/css" href="<?php echo public_url()?>/frontend/css/slide-flim.css" rel="stylesheet">
        <!-- End CSS -->
        
        <!-- the Javascript -->
    
        <script type="text/javascript" src="<?php echo public_url()?>/js/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo public_url()?>/js/jquery/jquery-ui.min.js"></script>
		<link type="text/javascript" rel="stylesheet" href="<?php echo public_url()?>/js/jquery/jquery-ui/custom-theme/jquery-ui-1.8.21.custom.css" type="text/css">
	    
        <script src="<?php echo public_url()?>/frontend/js/script.js"></script>
        
        <!-- raty -->
		 <script type="text/javascript" src="<?php echo public_url()?>/frontend/raty/jquery.raty.min.js"></script>
		 <script type="text/javascript">
	      $(function() {
	         $.fn.raty.defaults.path = '<?php echo public_url()?>/frontend/raty/img';
	         $('.raty').raty({
	          	  score: function() {
	          	    return $(this).attr('data-score');
	          	  },
	              readOnly  : true,
	          });
	      });
	     </script>
	     <style>.raty img{width:16px !important;height:16px; !important;}</style>
	     <!--End raty -->
     
        <!-- End Javascript -->
        <script type="text/javascript">
	        $(document).ready(function(){
		        $('#back_to_top').click(function() {
		            $('html, body').animate({scrollTop:0},"slow");
		       });
		       // go top
		       $(window).scroll(function() {
		            if($(window).scrollTop() != 0) {
		                $('#back_to_top').fadeIn();
		            } else {
		                $('#back_to_top').fadeOut();
		            }
		       });
	        });
		</script>
		<style>
		#back_to_top {
		    bottom: 10px;
		    color: #666;
		    cursor: pointer;
		    padding: 5px;
		    position: fixed;
		    right: 55px;
		    text-align: center;
		    text-decoration: none;
		    width: auto;
		}
		</style>
		
		        <title>wda2</title>