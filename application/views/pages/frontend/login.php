<?php 
	
	if($this->session->has_userdata('customer_type') == true){
		if($this->session->userdata('customer_type') == "customer"){
			redirect('userprofile');
		}
	}

?>
<section id="main_mid_sec">
	<div class="mig_logsec">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="sign_top">
						<h1>Join acKanina</h1>
						<p>and get Internet connectivity everywhere!</p>
					</div>
					
					
				</div>
			</div>
		
			<div class="row">
				<div class="col-xs-24">
					<div class="cus_log">
						<form id="customerLogin">
							<ul>
								<li>
									<input type="text" name="email" placeholder="Username/Email" class="ipfield" />
								</li>
								<li>
									<input type="password" name="password" placeholder="Password" class="ipfield" />
								</li>
								<li>
									<input type="submit" value="Sign in" class="sign_in_btn"/>
								</li>
								<li class="wid_half">
									
									<label>
										<input type="checkbox" value="Sign in" class="remme"/>
										Remember me!
									</label>
								</li>
								<li class="wid_half">
									<a href="recoverpassword">Forgot password</a>
									
								</li>
							</ul>
						</form>
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">

	$("#customerLogin").submit(function(event) {
	    event.preventDefault();
	}).validate({
	    rules: {
	     email: "required",
	     password: "required"
	    },
	    submitHandler: function(form) { 
	    	
	        $.ajax({
	        	url:'<?php echo base_url(); ?>get/customerLogin',
	        	type: 'POST',
                data: $('form').serialize(),
                dataType:'json',
                success:function(as){
                	if(as.status == true){
                		location.href="userprofile";
                	}
                	else if(as.status == false){
                		alert("Wrong username or password");
                	}
                }
	        });
	    }
	});
</script>