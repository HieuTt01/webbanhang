
			       <div class="box-left">
         <div class="title tittle-box-left">
			  <h2> Tìm kiếm theo giá </h2>
		</div>
		<div class="content-box"><!-- The content-box -->
	           <form class="t-form form_action" method="get" style="padding:10px" action="<?php echo site_url('product/search_price')?>" name="search">
                  
                  <div class="form-row">
						<label for="param_price_from" class="form-label" style="width:70px">Giá từ:<span class="req">*</span></label>
						<div class="form-item" style="width:90px">
							<input class="format_number" id="price_from" name="price_from" style="width:100px"placeholder="0 đ" class="ui-autocomplete-input" autocomplete="on" role="textbox" aria-autocomplete="list" aria-haspopup="true">
							<div class="clear"></div>
							<div class="error" id="price_from_error"></div>
						</div>
						<div class="clear"></div>
				  </div>
				  <div class="form-row">
						<label for="param_price_from" class="form-label" style="width:70px">Giá tới:<span class="req">*</span></label>
						<div class="form-item" style="width:90px">
							<input  class="format_number" id="price_from" name="price_to" style="width:100px"placeholder="1000000đ" class="ui-autocomplete-input" autocomplete="on" role="textbox" aria-autocomplete="list" aria-haspopup="true">
							<div class="clear"></div>
							<div class="error" id="price_from_error"></div>
						</div>
						<div class="clear"></div>
				  </div>
				  
				  <div class="form-row">
						<label class="form-label">&nbsp;</label>
						<div class="form-item">
				           	<input type="submit" class="button" name="search" value="Tìm kiềm" style="height:30px !important;line-height:30px !important;padding:0px 10px !important">
						</div>
						<div class="clear"></div>
				   </div>
            </form>
	    </div><!-- End content-box -->
</div>


<div class="box-left">
         <div class="title tittle-box-left">
			  <h2> Danh mục sản phẩm </h2>
		</div>
		<div class="content-box"><!-- The content-box -->
	          <ul class="catalog-main">
			  <?php foreach($catalog_list as $row):?>
                 <li>
                     <span><a href="<?php echo base_url('product/catalog/'.$row->id)?>" title="<?php echo $row->name?>"><?php echo $row->name?></a></span>
                     <!-- lay danh sach danh muc con -->
					 <?php if(!empty($row->subs)):?>
             	 	 <ul class="catalog-sub"> 
             	 	         <?php foreach($row->subs as $sub):?> 					                    
                            <li>
                             <a href="<?php echo base_url('product/catalog/'.$sub->id)?>" title="<?php echo $sub->name?>">
                            <?php echo $sub->name?></a>
                            </li>
                            <?php endforeach;?>		
                            			                    
                     </ul>
                    <?php endif;?>
                 </li>
               <?php endforeach;?>
	                     
	        </ul>	    </div><!-- End content-box -->
</div>
