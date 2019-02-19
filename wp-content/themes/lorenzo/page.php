<?php
get_header('inner');
?>
<!--slider-->
<!--body and content-->
<div  class="wrapper margin-top-banner-size">
		<div class="container">
			<div class="vspace"></div>
			<section class="heading"> 
				<strong><?php the_title(); ?></strong>
				<img src="<?php bloginfo('template_url');?>/images/line.png" alt="line">
			</section>
			<div class="clearfix"></div>
			<div class="vspace"></div>
			
			
			<?php while ( have_posts() ) : the_post(); ?>

<?php the_content();   ?>

<?php endwhile; ?>

			
		</div>

<?php include('template/testimonials.php'); ?>
<?php include('template/newsletter.php'); ?>
<?php get_footer(); ?>

<!--end content-->