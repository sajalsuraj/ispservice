<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AuthorStream</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/resources/style/bootstrap.css" />
<link href="<?php echo base_url(); ?>assets/resources/style/styles.css" type="text/css" rel="stylesheet" /> 
<link href="<?php echo base_url(); ?>assets/resources/style/fonts.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/resources/style/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/resources/script/jquery-2.2.0.js"></script>


 <script src="<?php echo base_url(); ?>assets/resources/script/owl.carousel-2.js"></script>
 <script src="<?php echo base_url(); ?>assets/resources/script/crawler.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/additional-methods.js"></script>

<script>

$(document).ready(function() { 

		$('.ban_slider').owlCarousel({
    
    margin:0,
	dots : false,
	nav:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1
        },
        1200:{
            items:1
        }
    }
})
$('.btm_five_add').owlCarousel({
    
    margin:20,
	dots : false,
	nav:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:2
        },
		768:{
            items:3
        },
		991:{
            items:4
        },
        1200:{
            items:5
        }
    }
})
});
    </script>
	 
<script type="text/javascript">
marqueeInit({
	uniqueid: 'mycrawler',
	style: {
		'padding': '5px','width': '100%','color': '#fff'
	},
	inc: 5, //speed - pixel increment for each iteration of this marquee's movement
	mouse: 'cursor driven', //mouseover behavior ('pause' 'cursor driven' or false)
	moveatleast: 2,
	neutral: 150,
	persist: true,
	savedirection: true
});
</script>

</head>

<body>
	
<header class="menu_style_2 menu_res">
	<div class="top_menu">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					
						<div class="logo">
							<a href="#">
								<img src="<?php echo base_url(); ?>assets/resources/images/logo.png" alt="logo" class="logo1" />
								<img src="<?php echo base_url(); ?>assets/resources/images/logo-2.png" alt="logo" class="logo2" />
								<img src="<?php echo base_url(); ?>assets/resources/images/logo-mo.png" alt="logo" class="logo_mo" />
							</a>
						</div>
					<div class="menu_mo_hide">
						
						
						<div class="menu_right">
				
				
				<a href="<?php echo base_url(); ?>">Home</a>
				<a href="#">About Us</a>
				<a href="our-plans">Our Plans</a>
				<a href="#">News & Events</a>
				
				<a href="contact-us">Contact Us</a>
				<a href="payment-1" class="login">Online Payment</a>
				<?php if($this->session->has_userdata('customer_type') == true){
						if($this->session->userdata('customer_type') == "customer"){ ?>
				    <a href="<?php echo base_url(); ?>userprofile" class="login">Profile</a>
					<a href="<?php echo base_url(); ?>custmer/logout" class="login">Logout</a>
				<?php } else{ ?>
					<a href="login" class="login">Login</a>
				<?php } } else{ ?>
					<a href="login" class="login">Login</a>
				<?php } ?>
			</div>
					
					</div>
					<div class="menu_mo_view">
						<ul>
							<li><a class="mo_first" href="javascript:" id="mo_drop"></a></li>
							<li><a class="mo_second" href="javascript:" id="sear_drop"></a></li>
							<li><a class="mo_third" href="#"></a></li>
						</ul>
						 <!-----mobile dropdown------>
						  <div id="mo_drop_menu">
								<div class="feat_tab">
							<ul>
								
								<li class="act_one"><a href="<?php echo base_url(); ?>">Home</a></li>
								<li class="act_two"><a href="#">About Us</a></li>
								<li class="act_three"><a href="our-plans">Our Plans</a></li>
								<li class="act_three"><a href="#">News & Events</a></li>
								<li class="act_four"><a href="contact-us">Contact Us</a></li>
								<li class="act_five"><a href="payment-1">Online Payment</a></li>
								<li class="act_six"><a href="login">Login</a></li>
								
								
							</ul>
						</div>
          
						  </div>
						<!------ends here---->
						
						<div id="mo_sear_op">
								<div class="search_btn">
									<form>
										<input type="text" name="search" value="Search Presentation" onfocus="if(this.value == 'Search Presentation') { this.value=''; }" onblur="if (this.value == '') { this.value='Search Presentation'; }" class="srch_place">
									</form>
						
								</div>
						</div>
				</div>
			</div>
		</div>
	
	</div>
	</div>
</header>