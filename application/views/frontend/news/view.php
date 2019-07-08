<div class="box-center"><!-- The box-center product-->

      <div class="tittle-box-center">
		     <h2 style="color:blue">Tin tức</h2>
		      </div>
		    <div class="box-content-center product"><!-- The box-content-center -->
            <div class="font-family:Inconsolata;background-position: center">
               <p style = "font-family:Inconsolata;font-size: 30px"><><?php echo $new->title?></p>
               <a>
			        <img src="<?php echo base_url('upload/news/'.$new->image_link)?>" style="width:300px">	                        
				</a>
            
                <p style="background-size: cover"><?php echo $new->content?></p>
                </div>
		    <div class="clear"></div>
		    </div><!-- End box-content-center -->           
</div>