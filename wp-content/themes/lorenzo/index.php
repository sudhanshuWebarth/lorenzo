<?php

/* Template Name:home  */

get_header();

?>

<!--slider-->

    <div class="slider">

    		<a class="next-Carousel"><i class="fa fa-angle-right"></i> </a>

    		<a class="back-Carousel"><i class="fa fa-angle-left"></i> </a>

			

			<div class="slider-caption">

				<h1><?php the_field("slider_tag"); ?></h1>

				<a data-target="#book-a-table" data-toggle="modal" class="custom-btn red wow bounceInRight"> Enquiry </a>

				

				<?php include('template/social-icon.php');?>

			</div>

    		<div id="carousel" class="owl-carousel">

			 	<div class="loader">Loading..</div>

                <?php

				$slider_Result=$task->queryWhereCustom("tbl_aceslider",array("image"),"order by image_id");

				if(count($slider_Result[0])>0)

				{

					foreach($slider_Result as $image)

					{ ?>

					<div class="item"><?php echo $call->image_Url_2(array('lorenzo','ace_slider','gallery_images',$image['image']),array('1510','500')); ?></div>

				<?php	}

				}

				else{ ?>

					 <div class="item"><img src="<?php bloginfo('template_url');?>/images/banner-2.jpg" alt="banner-1"></div>

					<?php } ?>

			</div>

    </div>

   <!--body and content-->

   

	<div  class="wrapper margin-top-banner-size">

		<div class="container">

			<div class="vspace"></div>

			<section class="heading"> 

				<strong>About Us</strong>

				<img src="<?php bloginfo('template_url');?>/images/line.png" alt="line">

			</section>

			<div class="clearfix"></div>

			<div class="vspace"></div>

			

			

			<?php while ( have_posts() ) : the_post(); ?>



<?php the_content();   ?>



<?php endwhile; ?>

			<a href="<?php bloginfo('url');?>/about-us" class="custom-btn red wow bounceInUp">Know More</a>



			

		</div>



<!--our menu bar-->

<div class="clearfix"></div>

<div class="vspace"></div>

<div class="vspace"></div>



<div class="view-our-menu" style="background-image:url('<?php bloginfo('template_url');?>/images/our-menu.jpg')">

	<div class="container">

		<section>

			<h2>Find Our</h2>

			<h3>Menu</h3>

		</section>

		<div class="btn-group-custom">

		<a href="<?php bloginfo('url');?>/our-menu" class="custom-btn btn ">View Full Menu</a>

        <?php include('template/download_menu.php'); ?>

		</div>

	</div>	

		<div class="clearfix"></div>

		<div class="vspace"></div>

		<!--tabs-->

<div class="tab">

	<div class="container">

		<!-- Nav tabs -->

        <?php

		if($task->getCount("select id from lrn_category")>0)

		{$result_Category=$task->queryWhere("lrn_category",array('id','category_name','category_tag','category_image'),array(1=>1));?>

			<ul class="nav nav-tabs" role="tablist">

            <?php

			$sn=1;

			foreach($result_Category as $list)

			{

			?>

		    <li role="presentation" <?php if($sn==1){?> class="active" <?php } ?>>

		    <a href="#<?php echo $list['id']; ?>"  role="tab" data-toggle="tab">

		    <i class="icon " style='background-image:url(<?php echo $call->image_Src(array('lorenzo','restorent','menu_image',$list['category_image'])); ?>)'></i><?php echo $list['category_name'] ?>

			<small><?php echo $list['category_tag'] ?></small>

			<span class="active"><i class="fa fa-caret-up"></i> </span>

			</a>

			</li>

		    <?php $sn++; } ?>

			</ul>	

  <?php } ?>

</div>

	</div>	  

	</div>

<!--tab content-->

<div class="container">

<div class="tab-content">

<?php

if($task->getCount("select id from lrn_menu")>0)

{

	if($task->getCount("select id from lrn_category")>0)

	{$sn=1;

		foreach($result_Category as $list)

		{

			$result_Menus=$task->queryWhereCustom("lrn_menu",array('id','menu_name','menu_price','menu_discription','menu_image'),"where menu_category_id='".$list['id']."' limit 0,6");

			?>	

    <div role="tabpanel" class="tab-pane <?php if($sn==1){ ?> active <?php } ?>" id="<?php echo $list['id']; ?>">

    <!--food menu-->

    <?php

	if(count($result_Menus[0])>0)

	{

	?>

    	<ul class="menu-list">

        <?php

		foreach($result_Menus as $list){

		?>

    		<li>

    			<a>

    				<?php echo $call->image_Url(array('lorenzo','restorent','menu_image',$list['menu_image']),array('100','100')); ?>

    				<span><strong><?php echo $list['menu_name']; ?></strong>

    					<small><?php echo $list['menu_discription']; ?></small>

    					<price>Price: £<?php echo $list['menu_price']; ?></price>

    				</span>

    			</a>

    		</li>

        <?php } ?>    

    	</ul>

   <?php

	}

	else{ ?>

    <br />

    <div class="alert alert-danger text-center" role="alert"><i class="fa fa-info-circle"></i> There is no menu under this category.</div>

		<?php } ?> 	

    </div>

<?php $sn++; } } } ?>    

</div>

</div>

<!--book a table form-->

<?php include('template/book_a_table.php'); ?>

<?php include('template/testimonials.php'); ?>

<?php include('template/newsletter.php'); ?>

<?php get_footer(); ?>