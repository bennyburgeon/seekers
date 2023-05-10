<!-- Footer
===
===
=== === === === === === === === === === === === === -->

<footer id="footer" class="dark">
  <div class="container"> 
    
    <!-- Footer Widgets
				============================================= -->
    <div class="footer-widgets-wrap clearfix">
      <div class="">
        <div class="col_one_third">
          <div class="widget clearfix"> <img src="<?php echo $this->config->base_url();?>images/footer-widget-logo.png" alt="" class="footer-logo">
            <p><?php echo $this->config->item('company_intro')?></p>
            <div>
              <address>
              <strong>Headquarters:</strong><br>
              <?php echo $this->config->item('company_name')?> <br>
              </address>
              <!--
						  <div>
							  <div jstcache="6" jsan="7.directions-address"><?php echo $this->config->item('powered_by_address')?></div>
						  </div>--> 
              <a target="_blank" jstcache="7" href="https://goo.gl/maps/HfmqK6paMYu" ><br>
              <abbr title="Mobile Number"><strong>Mobile: </strong></abbr><?php echo $this->config->item('company_phone')?><br>
              <abbr title="Email Address"><strong>Email: </strong></abbr>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->config->item('company_email')?> </a> </div>
          </div>
        </div>
        <div class="col_one_third col_last">
          <div class="widget widget_links clearfix">
            <h4>Links</h4>
            <ul>
              <li><a href="<?php echo $this->config->base_url();?>index.php/home">Home</a></li>
              <li><a target="_blank" href="<?php echo $this->config->base_url();?>index.php/aboutus">About Us</a></li>
              <li><a target="_blank" href="<?php echo $this->config->base_url();?>index.php/terms">Terms &amp; Conditions</a></li>
              <li><a target="_blank" href="<?php echo $this->config->base_url();?>index.php/privacy">Privacy Policy</a></li>
              <li><a target="_blank" href="<?php echo $this->config->base_url();?>index.php/contact">Contact Us</a></li>
            </ul>
          </div>
        </div>
        <div class="col_one_third col_last">
          <div class="widget clearfix">
            <h4>About</h4>
            <div id="post-list-footer">
              <div class="spost clearfix">
                <div class="entry-c">
                  <div class="entry-title">
                    <p><?php echo $this->config->item('company_about')?><br>
                      <br>
                      <a href="http://www.IBSJobs.com" target="_blank"> <?php echo $this->config->item('powered_by_web')?> </a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- .footer-widgets-wrap end --> 
    
  </div>
  
  <!-- Copyrights
			============================================= -->
  <div id="copyrights">
    <div class="container clearfix">
      <div class="col_one_third"> Copyrights &copy; 2018 All Rights Reserved by Bournham Businsess Solutions<br>
        <div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a> </div>
      </div>
      <div class="col_one_third text-center"> <a href="https://play.google.com/store/apps/details?id=<?php echo $this->config->item('site'); ?>" target="_blank"><img src="<?php echo base_url('images/googleplay_badge.png');?>" height="40" /></a> <a href="https://play.google.com/store/apps/details?id=<?php echo $this->config->item('site'); ?>" target="_blank"> <img src="<?php echo base_url('images/appstore_badge.png');?>" height="40" /> </a> </div>
      <div class="col_one_third col_last tright">
        <div class="fright clearfix"> <a href="#" class="social-icon si-small si-borderless si-facebook"> <i class="icon-facebook"></i> <i class="icon-facebook"></i> </a> <a href="#" class="social-icon si-small si-borderless si-twitter"> <i class="icon-twitter"></i> <i class="icon-twitter"></i> </a> <a href="#" class="social-icon si-small si-borderless si-gplus"> <i class="icon-gplus"></i> <i class="icon-gplus"></i> </a> <a href="#" class="social-icon si-small si-borderless si-linkedin"> <i class="icon-linkedin"></i> <i class="icon-linkedin"></i> </a> </div>
        <div class="clear"></div>
        <i class="icon-envelope2"></i>&nbsp;<?php echo $this->config->item('company_email')?><span class="middot">&middot;</span> <i class="icon-phone"></i><?php echo $this->config->item('company_phone')?></div>
    </div>
  </div>
  <!-- #copyrights end --> 
  
</footer>
<!-- #footer end --> 
<!-- Go To Top
===
===
=== === === === === === === === === === === === === -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- External JavaScripts
===
===
=== === === === === === === === === === === === === -->

</body></html>