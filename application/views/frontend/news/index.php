<div class="box-center">

      <div class="tittle-box-center">
		     <h2 style="color:blue">Tin tức</h2>
              <?php foreach($list as $new):?>
		    <div class="box-content-center product">
            <div class="font-family:Inconsolata;background-position: center">
               <a href="<?php echo base_url('news/view/'.$new->id)?>">
			        <img src="<?php echo base_url('upload/news/'.$new->image_link)?>" style="width:150px">	                        
				
                <p style = "font-family:Inconsolata;font-size:17px"><><?php echo $new->title?></p>
                </a>
            </div>
		    <div class="clear"></div>
            </div>
            <?php endforeach;?>
        </div>

</div>
