<section id="main_mid_sec">
	<div class="mig_logsec">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="sign_top">
						<h1>Recover Your Password in a single click</h1>
						<p>An e-mail will be sent to your registered e-mail ID. Please login and follow the link to change password.</p>
					</div>
					
					
				</div>
			</div>
			<div class="row">	
				<div class="col-xs-24">	
					<div class="cus_log">
						<form id="recoverPassForm">
							<ul>
								<li>
									<input type="email" name="email" placeholder="Enter your email address" class="ipfield" />
								</li>
								
								<li>
									<input type="submit" name="pwd" value="Continue" class="sign_in_btn"/>
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
	$("#recoverPassForm").submit(function(event) {
	    event.preventDefault();
	}).validate({
	    rules: {
	     email: "required"
	    },
	    submitHandler: function(form) { 
	    	
	        $.ajax({
	        	url:'<?php echo base_url(); ?>get/recoverpassword',
	        	type: 'POST',
                data: $('form').serialize(),
                dataType:'json',
                success:function(as){
                	if(as.status == false){
                		alert(as.data);
                	}
                }
	        });
	    }
	});
</script>