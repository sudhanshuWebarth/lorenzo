console.info('custom function initialized!!');



//datetimepiker in jquery

jQuery('.date-control').datetimepicker({

 

 

   minDate:'0',//yesterday is minimum date(for today use 0 or -1970/01/01)

 	

});





$("#menu-item-18").click(function(){

	$("#book-a-table").modal();

	});



//wow thems setup for  animation

		

$('.heading strong, p').addClass('wow fadeInUp');

$('.view-more').addClass('wow fadeInLeft');

$('.bookTable').addClass('wow fadeInRight');

$('h1').addClass('wow fadeIn');

//$('.book-a-table-form').addClass('wow fadeInRight');

$('.book-a-table-form .container img').addClass('wow fadeInLeft');

$('.view-our-menu h2').addClass('wow bounceInLeft ');

$('.view-our-menu h3').addClass('wow fadeInUp');

$('.view-our-menu a.custom-btn').addClass('wow bounceInRight');

$('.view-our-menu .nav-tabs li  a').addClass('wow fadeInDown');

$('.slider-caption h1').addClass('wow fadeInDown')



$('.book-table .form-control').addClass('wow fadeInUp');





wow = new WOW(

      {

        animateClass: 'animated',

        offset:       100,

        callback:     function(box) {}

      }

    );

wow.init();



//active menubar

/*

$('.navbar li a').click(function(){

	

	sessionStorage['active-menu']=$(this).attr('src');

	$('.navbar li').each(function(){

		

		if( $(sessionStorage.getItem('active-menu')==$(this).find('a').attr('src'))

		{

			

		}

	});

});    

   */

   

//carousel

$(function(){



var owl=$('#carousel');

owl.owlCarousel({

	  

      slideSpeed : 300,

      paginationSpeed : 400,

      singleItem:true,

      autoPlay:true,

      lazyLoad : true,

      loop:true,

      rewindNav:false,

      beforeInit: function(){

      

      $('.owl-carousel .loader').remove();

      

     		}

      

      

});



$('.next-Carousel').click(function(){

	owl.trigger('owl.next')

});

$('.back-Carousel').click(function(){

	owl.trigger('owl.prev')

});









		

//testimonial-carousel

var owl1=$('#testimonial-carousel');

owl1.owlCarousel({

	  

      slideSpeed : 300,

      paginationSpeed : 400,

      singleItem:true,

      autoPlay:true

});







});



$(window).load(function(){

	setTimeout(function(){



	var height=0

	if($(window).width() < 768)

	{

		height=60;

	}

	

	$('.margin-top-banner-size').css('margin-top', $('.slider').height()+height);

	},500);



});



//change header on scroll

$(window).scroll(function(){



	if($(window).scrollTop() > 150)

	{

		$('header').addClass('active');

	}

	else

	{

		$('header').removeClass('active');

	}

});



//set height

$(window).resize(function(){



setTimeout(function(){

var height=0

	if($(window).width() < 768)

	{

		height=60;

	}

	

	$('.margin-top-banner-size').css('margin-top', $('.slider').height()+height);

	},500);

	

});



//load more menu

$('.view-more').click(function(){

	var value=$(this).data('view');

	var $target=$(this);

	if(value=='more')

	{

	$(this).parents('.menu-view').find('li').removeClass('hide');

	$(this).html('Less More <i class="fa fa-angle-double-up"></i>');

	$(this).data('view','less');

	}

	

	else if(value=='less')

	{

	

	$(this).parents('.menu-view').find('li').removeClass('hide');

	

	$(this).html('View More <i class="fa fa-angle-double-down"></i>');

	$(this).data('view','more');

	

		$target.parents('.menu-view').find('li').each(function(index){

			if(index>=4)

			{

				$(this).addClass('hide');

			}

		});

	

	}



	

});

//book a table



$(document).ready(function(){

	$('.bookTable').click(function(){

		//scroll to book a table

		$("body, html").animate({ scrollTop: $( $(this).attr('href') ).offset().top   }, 700);

	});

	

	$('.view-menu').click(function(){

		//scroll to book a table

		$("body, html").animate({ 

		

		scrollTop: $($(this).attr('href')).offset().top -50

		 

		}, 700);

	});





});

//scroll to top





$('body').append("<div class='back-top' style='display:table; position:fixed; right:15px; bottom:0px; z-index:1000; opacity:0.9; -webkit-opacity:0.9; -o-opacity:0.9; -moz-opacity:0.9; -ms-opacity:0.9;   display:none;'><a href='#' style='color:white; font-family:Arial, Helvetica, sans-serif; font-size:10pt;display:block; font-weight:500;text-align:center; line-height:15px; padding:3px 8px; border-radius:3px 3px 0px 0px; background-color: #262727;'>Top</a></div>");

 // fade in #back-top

	$(function () {

	

		$(window).scroll(function () {

			if ($(this).scrollTop() > 100) {

				$('.back-top').fadeIn();

			} else {

				$('.back-top').fadeOut();

			}

		});



		// scroll body to 0px on click

		$('.back-top a').click(function () {

			$('body,html').animate({

				scrollTop: 0

			}, 400);

			return false;

		});

	});





