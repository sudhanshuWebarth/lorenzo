<?php

/* Template Name:menu-page  */

get_header('inner');

$menu_subcategory=str_replace("-"," ",get_query_var('pagename'));

$where=array('menu_subcategory'=>$menu_subcategory);

$result_Subcategory=$task->queryWhere("lrn_subcategory",array('dish_type'),array('subcategory_name'=>$menu_subcategory));

$result_Menus=$task->queryWhere("lrn_menu",array('id','menu_name','menu_price','menu_discription','menu_image'),$where);

?>

    

    <!--banner slider-->

    <div class="inner-banner">

    	<div class="banner-caption">

    		<section>

    			<h1><?php echo the_title(); ?></h1>

    			<p><?php echo $result_Subcategory[0]['dish_type']; ?></p>

    			<?php include('template/social-icon.php');?>

				<div class="clearfix"></div>

				<div class="btn-group-custom">

				<a class="custom-btn btn view-menu" href="<?php bloginfo('url');?>/our-menu">View Full Menu <i class="fa fa-angle-double-down"></i></a>

					<?php include('template/download_menu.php'); ?>

		</div>



		

    		</section>

    	</div>

    	<img src="<?php bloginfo('template_url');?>/images/our-menu-banner.jpg" alt="banner">

    </div>

  

	 <!--body and content-->

   

<div  class="wrapper margin-top-banner-size" id="view-menu">

	

		<!--beverages-->

		<section class="menu-view" >

				<div class="clearfix"></div>

		<div class="container">

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

        

		<div class="clearfix"></div>

		

		

		</div>

		

		</section>

		

	<!--menu view-2-->

	









<!--book a table form-->

<?php include('template/book_a_table.php') ?>



<?php include('template/newsletter.php') ?>

<?php get_footer(); ?>