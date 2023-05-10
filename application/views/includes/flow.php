<div class="container">

<div class="row">				
       <div class="col-lg-12 col-md-6 col-xs-12 col-sm-12">

        <a href="<?php echo base_url();?>index.php">                                
        <div class="productIcon">
            <img src="<?php echo base_url();?>assets/admin/pages/img/reports.png"/>
            <span>Home</span>
        </div>
        </a>
                                
			<?php
              foreach($_SESSION['candidate_menu_list'] as $result)
			  { 
             ?>
						<div class="productIcon">
                            <a href="<?php echo $this->config->site_url().'/'.$result["url"];?>">
                                <img src="<?php echo base_url();?>assets/admin/pages/img/<?php echo $result["module_class"];?>"/>
                                <span><?php echo $result["name"];?></span>
                            </a> 
                             <?php  if(is_array($result["sub"]) && count($result["sub"])>0){	 ?>   
                                 <ul class="submenu2">
										 <?php
                                          foreach($result["sub"] as $item)
                                          { 
                                         ?>
                                         <li> <a href="<?php echo $this->config->site_url().'/'.$item["url"];?>"><?php echo $item["name"];?></a></li>     
					                 <?php } ?>                               
		                         </ul>
        					<?php } ?>                     
                        </div>
             <?php } ?> 
              
                                
                        </div><!--col-->
                        
                        </div><!--row-->

</div>
