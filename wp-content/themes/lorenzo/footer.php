<?php $call=new callFiles(); ?>

<footer>

	<div class="container">

		<img src="<?php bloginfo('template_url');?>/images/logo.png" alt="loading"  class="wow fadeInDown">

		<?php wp_nav_menu (array('theme_location' => 'secondary-menu','menu_class' =>'quick-links'));?>

		<div class="clearfix"></div>

		<?php include('template/social-icon.php')?>

		<div class="clearfix"></div>

		<div class="vspace"></div>

		<a class="copyright">Copyright &copy; 2015-16 Lorenzo. All rights reserved.</a>

	</div>

</footer>



<!--end content-->

 </div>	 

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" ></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"  integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<script src="<?php bloginfo('template_url');?>/js/vendor/owl-carousel/owl.carousel.min.js" ></script>

	<script src="<?php bloginfo('template_url');?>/js/vendor/jquery.datetimepicker.min.js" ></script>

	<script src="<?php bloginfo('template_url');?>/js/wow.min.js" ></script> 

	<script src="<?php bloginfo('template_url');?>/js/function.js" ></script>

	<script src="<?php bloginfo('template_url');?>/js/validator.js" ></script>

	<script>

			$(document).ready(function() {



    		$(".tablebook").bootstrapValidator(

       			 {

            feedbackIcons: {

                 valid: 'fa fa-check icon-animated-vertical',

                invalid: 'fa fa-exclamation-triangle icon-animated-vertical',

                validating: 'glyphicon glyphicon-refresh icon-animated-vertical'

            },

           fields: {

            con_phone: {

                validators: {

                    integer: {

                        message: 'Please Enter valid contact number'

                    }

                    }}}

           

            }

            ).on('success.form.bv', function(e) {

           

            e.preventDefault();



            // Get the form instance

            var $form = $(e.target);



            // Get the BootstrapValidator instance

            var bv = $form.data('bootstrapValidator');



            // Use Ajax to submit form data

			

			$(".codeTable_btn").attr('disabled','disabled');

			$("body").prepend("<div class='alert-custom success' id='alert_category'>Processing....</div>");

$.ajax({

dataType: "json",

url: "<?php echo $call->file_Url(array('lorenzo','process_files','process_bookTable')); ?>",  	

type: "POST",      				

data:  new FormData(this), 		

contentType: false,       		

cache: false,					

processData:false,  			

success: function(data)  		

{

if($.trim(data.status)==1)

{

$(".codeTable_btn").removeAttr('disabled');

$('.tablebook')[0].reset();

$("#alert_category").html(data.message);

setTimeout(function(){ $(".alert-custom").remove(); },1000);	

location.assign("<?php bloginfo('url');?>/thank-you");

}

else if($.trim(data.status)==0)

{

if($.trim(data.todo)=="date")

{

	alert(data.message);

}

$(".codeTable_btn").removeAttr('disabled');

$('.tablebook')[0].reset();

$("#alert_category").removeClass("success").addClass("danger");

$("#alert_category").html(data.message);

setTimeout(function(){ $(".alert-custom").remove(); },1000);

}

}

});});});

</script>

    <script>

			$(document).ready(function() {



    		$("#contact").bootstrapValidator(

       			 {

            feedbackIcons: {

                 valid: 'fa fa-check icon-animated-vertical',

                invalid: 'fa fa-exclamation-triangle icon-animated-vertical',

                validating: 'glyphicon glyphicon-refresh icon-animated-vertical'

            },

           fields: {

            con_phone: {

                validators: {

                    integer: {

                        message: 'Please Enter valid contact number'

                    }

                    }}}

           

            }

            ).on('success.form.bv', function(e) {

           

            e.preventDefault();



            // Get the form instance

            var $form = $(e.target);



            // Get the BootstrapValidator instance

            var bv = $form.data('bootstrapValidator');



            // Use Ajax to submit form data

			 $("#lornezo_con_btn").attr('disabled','disabled');

			 $("body").prepend("<div class='alert-custom success' id='alert_category'>Processing....</div>");

$.ajax({

dataType: "json",

url: "<?php echo $call->file_Url(array('lorenzo','process_files','process_contact')); ?>",  	

type: "POST",      				

data:  new FormData(this), 		

contentType: false,       		

cache: false,					

processData:false,  			

success: function(data)  		

{

if($.trim(data.status)==1)

{

$("#lornezo_con_btn").removeAttr('disabled');

$('#contact')[0].reset();

$("#alert_category").html(data.message);

setTimeout(function(){ $(".alert-custom").remove(); },1000);	

location.assign("<?php bloginfo('url');?>/thank-you");

}

else if($.trim(data.status)==0)

{

$("#lornezo_con_btn").removeAttr('disabled');

$('#contact')[0].reset();

$("#alert_category").removeClass("success").addClass("danger");

$("#alert_category").html(data.message);

setTimeout(function(){ $(".alert-custom").remove(); },1000);

}

}

});});});

</script>

<script>

			$(document).ready(function() {



    		$("#news-letter").bootstrapValidator(

       			 {

            feedbackIcons: {

                 valid: 'fa fa-check icon-animated-vertical',

                invalid: 'fa fa-exclamation-triangle icon-animated-vertical',

                validating: 'glyphicon glyphicon-refresh icon-animated-vertical'

            },

           fields: {

            con_phone: {

                validators: {

                    integer: {

                        message: 'Please Enter valid contact number'

                    }

                    }}}

           

            }

            ).on('success.form.bv', function(e) {

           

            e.preventDefault();



            // Get the form instance

            var $form = $(e.target);



            // Get the BootstrapValidator instance

            var bv = $form.data('bootstrapValidator');



            // Use Ajax to submit form data

			

			$(".news-letter-btn").attr('disabled','disabled');

			$("body").prepend("<div class='alert-custom success' id='alert_category'>Processing....</div>");

$.ajax({

dataType: "json",

url: "<?php echo $call->file_Url(array('lorenzo','process_files','process_newsletter')); ?>",  	

type: "POST",      				

data:  new FormData(this), 		

contentType: false,       		

cache: false,					

processData:false,  			

success: function(data)  		

{

if($.trim(data.status)==1)

{

$(".news-letter-btn").removeAttr('disabled');

$('#news-letter')[0].reset();

$("#alert_category").html(data.message);

setTimeout(function(){ $(".alert-custom").remove(); },1000);	

location.assign("<?php bloginfo('url');?>/thank-you");

}

else if($.trim(data.status)==0)

{

alert(data.message);

$(".news-letter-btn").removeAttr('disabled');

$('#news-letter')[0].reset();

$("#alert_category").removeClass("success").addClass("danger");

$("#alert_category").html(data.message);

setTimeout(function(){ $(".alert-custom").remove(); },1000);

}

}

});});});

</script>



</body>

</html>