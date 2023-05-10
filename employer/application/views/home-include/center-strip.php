<section>
    <div class="center">
      <div class="banner"  style="background-image:url(<?php echo base_url('images/slider1.jpg');?>);">
        <div class="container">
          <div class="banner_text">We do not grow</div>
          <br />
          <div class="banner_text">Business </div>
          <br />
          <div class="banner_text">We serve better and transparent </div>
          <br />
          <div class="banner_text"> to build relationship.</div>
        </div>
        <div class="banner_menu"> 
        
        <a href="<?php echo $this->config->base_url();?>index.php/aboutus" <?php if($current_controller=='aboutus')echo 'class="b_menu_ative"';else echo 'class="b_menu"';?>>Internships</a>
        <a href="<?php echo $this->config->base_url();?>index.php/methodology"  <?php if($current_controller=='methodology')echo 'class="b_menu_ative"';else echo 'class="b_menu"';?>>CV Writing</a>
        <a href="<?php echo $this->config->base_url();?>index.php/employers"  <?php if($current_controller=='employers')echo 'class="b_menu_ative"';else echo 'class="b_menu"';?>>Job alerts</a>
        <a href="<?php echo $this->config->base_url();?>index.php/testimonials"  <?php if($current_controller=='testimonials')echo 'class="b_menu_ative"';else echo 'class="b_menu"';?>>CV Distribution</a>
        <a href="<?php echo $this->config->base_url();?>index.php/faqs"  <?php if($current_controller=='faqs')echo 'class="b_menu_ative"';else echo 'class="b_menu"';?>>Webinars</a>
        
                <a href="<?php echo $this->config->base_url();?>index.php/faqs"  <?php if($current_controller=='faqs')echo 'class="b_menu_ative"';else echo 'class="b_menu"';?>>Soft Skills</a>
                
        
        </div>
        
      </div>
    </div>
    </div>
  </section>