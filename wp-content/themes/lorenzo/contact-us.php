<?php
/* Template Name:contact  */
get_header('inner');
?> 
    <!--slider-->
    
   <!--body and content-->
   
	<div  class="wrapper margin-top-banner-size">
		<div class="container">
			<div class="vspace"></div>
				<div class="vspace"></div>
			<section class="heading"> 
				<strong>Contact us</strong>
				<img src="<?php bloginfo('template_url');?>/images/line.png" alt="line">
			</section>
				<div class="vspace"></div>	<div class="vspace"></div>
			<div class="container">
				<div class="col-sm-6">
						
<form class="book-table" id="contact">
<div class="col-sm-12">
<div class="form-group">
<input type="text" class="form-control" placeholder="Full Name" name="con_name" required="required">
</div>
</div>
<div class="clearfix"></div>
<div class="col-sm-12">
<div class="form-group">
<input type="text" class="form-control" placeholder="Email (eg. someone@example.com)" name="con_email" required="required">
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<input type="text" class="form-control" placeholder="Contact Number (Optional)" maxlength="14" minlength="10" name="con_phone">
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<textarea class="form-control height-50" placeholder="Enter your message" name="con_message" required="required"></textarea>
</div>
</div>
<div class="col-sm-12">
<input type="hidden" name="con_subject" value="Lorenzo Contact" />
<input type="hidden" name="con_toemail" value="<?php echo TO_EMAIL; ?>" />
<button type="submit" class="btn" id="lornezo_con_btn">Submit</button>
</div>
<div class="clearfix"></div>
</form>
</div>
<div class="col-sm-6">
<?php if(function_exists('ace_contact')){ ?>
<address>
<strong>
<?php if(ace_contact('address'))
{ echo ace_contact('address'); } ?> 
</strong>
<?php if(ace_contact('phone')){ ?>
<br>
<a href="tel:<?php echo ace_contact('phone'); ?>"><strong><i class="fa fa-phone-square"></i>  <?php echo ace_contact('phone'); ?></strong></a>
<?php } ?>
<?php if(ace_contact('email')){ ?>       
<br>
<a href="<?php echo ace_contact('email'); ?>"><strong><i class="fa fa-envelope-o"></i>  <?php echo ace_contact('email'); ?></strong></a>
<?php } ?>
</address>
<?php } ?>
				<iframe style="height:210px;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=1-2-3a+Townsend+Parade+Kingston+High+Street+Kingston+Upon+Thames+KT1+1LY&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe>
			
				
			</div>
			</div>

			
		</div>
<?php include('template/testimonials.php'); ?>
<?php include('template/newsletter.php'); ?>
<?php include('footer.php'); ?>