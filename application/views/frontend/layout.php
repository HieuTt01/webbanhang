<html>
     <head>
     <?php $this->load->view('frontend/head');?>
     </head>
     <body>
     <a href="#" id="back_to_top">
		   <img src="<?php echo public_url()?>/frontend/images/top.png">
	  </a>
      <div class = "wraper">
      
          <div class = "header">
             <?php $this->load->view('frontend/header');?>
          </div>

          <div id ="container">
              <div class="left">
              <?php $this->load->view('frontend/left',$this->data);?>
              </div>
              <div class="content">
              <?php if(isset($message)):?>
              <h3 style="color:blue"><?php echo $message?></h3>
              <?php endif;?>
              <?php $this->load->view($temp,$this->data)?>
              <!-- <?php $this->load->view('frontend/content')?>; -->
              </div>
              <div class="right">
              <?php $this->load->view('frontend/right',$this->data);?>
              </div>
              <div class="clear"></div>
          </div>
          <center>
			<img src="<?php echo public_url()?>/frontend/images/bank.png"> 
		  </center>
          <div class="footer">
          <?php $this->load->view('frontend/footer');?>
          </div>
      </div>
     </body>
</html>