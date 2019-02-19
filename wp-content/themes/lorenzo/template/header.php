<header>
    	<div class="container">
    			<nav class="navbar ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php bloginfo('url');?>/"><img src="<?php bloginfo('template_url');?>/images/logo.png" alt="logo lorenzo"></a>
    </div>

   
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <?php /* Primary navigation */

wp_nav_menu( array(

  'menu' => 'top_menu',

  'depth' => 2,

  'container' => false,

  'menu_class' => 'nav navbar-nav',

  //Process nav menu using our custom nav walker

  'walker' => new wp_bootstrap_navwalker())

);

?>
      
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    	</div>
    </header>
    

<!--book a table modal-->


<div class="modal fade" tabindex="-1" role="dialog" id="book-a-table">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Book your table  with LORENZO</h4>
      </div>
      <div class="modal-body">
      		<strong class="tagline">Celebrate your birthday or party with us &amp; get a bottle of champagne as gift</strong>
      		<img src="<?php bloginfo('template_url');?>/images/line.png" alt="line">
      		<div class="clearfix"></div>
      		<div class="vspace"></div>
      		<?php include('book-a-table-form.php') ?>
      		<div class="clearfix"></div>
      		<div class="vspace"></div>

      	</div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
