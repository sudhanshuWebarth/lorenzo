<?php if(function_exists('ace_social')){  ?>
<ul class="social-icon wow pulse">
<?php if(ace_social('facebook')){?>
<li><a href="<?php echo ace_social('facebook'); ?>" target="_blank"><i class="fa fa-facebook"></i> </a></li><?php } ?>
<?php if(ace_social('twitter')){?>
<li><a href="<?php echo ace_social('twitter'); ?>" target="_blank"><i class="fa fa-twitter"></i> </a></li><?php } ?>
<?php if(ace_social('google_plus')){?>
<li><a href="<?php echo ace_social('google_plus'); ?>" target="_blank"><i class="fa fa-google-plus"></i> </a></li><?php } ?>
<?php if(ace_social('instagram')){?>
<li><a href="<?php echo ace_social('instagram'); ?>" target="_blank"><i class="fa fa-instagram"></i> </a></li><?php } ?>
<?php if(ace_social('youtube')){?>
<li><a href="<?php echo ace_social('youtube'); ?>" target="_blank"><i class="fa fa-youtube"></i> </a></li><?php } ?>
</ul><?php } ?>