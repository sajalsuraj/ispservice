<footer>
		<div class="container">
			<div class="row">
			<div class="col-xs-12">
				<div class="foot_left">
				<ul>
					<li><a href="<?php echo base_url(); ?>">Home</a></li>
					<li><a href="<?php echo base_url(); ?>about-us">About Us</a></li>
					<li><a href="our-plans">Our Plans</a></li>
					<li><a href="contact-us">Contact Us</a></li>
					<li><a href="login">Login</a></li>
					</ul>
				</div>
				
				<div class="foot_right">
						<div class="foot_logo">
							
							<a href="#">
								<img src="resources/images/foot_logo.png" alt="logo" />
							</a>
						</div>
					
						<ul>
                           <li><a class="fb" href="#"></a></li>
                           <li><a class="tw" href="#"></a></li>
                           <li><a class="gp" href="#"></a></li>
                           <li><a class="yt" href="#"></a></li>
                           <li><a class="pi" href="#"></a></li>
                       </ul>
				
				</div>
			</div>
			</div>
		</div>
		<div class="btm_foot">
			<div class="container">
			<div class="row">
			<div class="col-xs-12">
				<div class="copy_txt">
					&copy 2017 acKANINA. All Right Reserved
				</div>
				<div class="design_txt">
                	<a href="#" target="_blank">
						<span>Design &amp; Concept by :</span>
							Glee Technologies
						</a>
                </div>
			</div>	
			</div>	
			</div>	
		</div>
</footer>
<script>
    $(document).ready(function(){

$('#mo_drop').click(function(e) {
    $(".mo_first").toggleClass("ch_bg1");
  $("#mo_drop_menu").stop(true, true).slideToggle("slow");
  e.stopPropagation();
});

$("body, #sear_drop").click(function () {
    $(".mo_first").removeClass("ch_bg1");
  $("#mo_drop_menu:visible").stop(true, true).slideUp("slow");
});

$('#sear_drop').click(function(e) {
    $(".mo_second").toggleClass("ch_bg2");
  $("#mo_sear_op").stop(true, true).slideToggle("slow");
  e.stopPropagation();
});
$("#mo_drop").click(function () {
    $(".mo_second").removeClass("ch_bg2");
  $("#mo_sear_op:visible").stop(true, true).slideUp("slow");
});


});
</script>  
</body>
</html>