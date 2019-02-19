<?php

/* Template Name:Our-Menu  */

get_header('inner');

?>  

    <!--banner slider-->

    <div class="inner-banner">

    	<div class="banner-caption">

    		<section>

    			<h1><?php echo the_title(); ?></h1>

    			<?php include('template/social-icon.php')?>

				<div class="clearfix"></div>

				<div class="btn-group-custom">

				<a href="<?php bloginfo('url');?>/our-menu" class="custom-btn btn view-menu ">View Full Menu <i class="fa fa-angle-double-down"></i></a>

				<?php include('template/download_menu.php'); ?>

		</div>



		

    		</section>

    	</div>

    	<img src="<?php bloginfo('template_url');?>/images/our-menu-banner.jpg" alt="banner">

    </div>

  

	 <!--body and content-->

   

<div  class="wrapper margin-top-banner-size" id="view-menu">

	

		<!--beverages-->

        <?php

		if($task->getCount("select id from lrn_subcategory")>0){

			$result_subCategory=$task->queryWhere("lrn_subcategory",array('id','subcategory_name'),array(1=>1));

			foreach($result_subCategory as $list)

			{

				$result_Menus=$task->queryWhere("lrn_menu",array('id','menu_name','menu_price','menu_discription','menu_image'),array('menu_subcategory_id'=>$list['id']));

	if(count($result_Menus[0])>0)

	{?>

		<section class="menu-view" >

		<div class="container"><div class="vspace"></div>

		<section class="heading"><strong><?php echo $list['subcategory_name']; ?></strong> <img src="<?php bloginfo('template_url');?>/images/line.png" alt="line"> </section>

		</div>

		<div class="clearfix"></div>

		<div class="container">

		<ul class="menu-list">

        <?php

		$sn=1;

		foreach($result_Menus as $list){?>

    		<li <?php if($sn>4){?> class="hide" <?php } ?>>

    			<a>

    				<?php echo $call->image_Url(array('lorenzo','restorent','menu_image',$list['menu_image']),array('100','100')); ?>

    				<span><strong><?php echo $list['menu_name']; ?></strong>

    					<small><?php echo $list['menu_discription']; ?></small>

    					<price>Price: £<?php echo $list['menu_price']; ?></price>

    				</span>

    			</a>

    		</li>

        <?php $sn++; } ?>    

    	</ul>

		

		<div class="clearfix"></div>

		<section class="btn-group">

        <?php if(count($result_Menus)>4){ ?>

		<a class="view-more" data-view="more">View More <i class="fa fa-angle-double-down"></i> </a>

        <?php } ?>

		<a class="bookTable" href="#book-a-form">Book A Table <i class="fa fa-user"></i></a>

		<!--<a class="red " target="_blank" href="menu/menu-restaurant-2015.pdf">Download Full Menu <i class="fa fa-file-pdf-o"></i> </a>-->



		</section>

			<hr>

		</div>

		

		</section>

        <?php }else{ ?> <?php } } } ?>

<!--book a table form-->

<?php include('template/book_a_table.php') ?>



<?php include('template/newsletter.php') ?>

<?php get_footer(); ?>