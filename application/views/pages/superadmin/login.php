<?php 
	
	if($this->session->has_userdata('type') == true){
		if($this->session->userdata('type') == "superadmin"){
			redirect('admin/home');
		}
	}

?>
<div class="col-md-12">
	<div class="container-fluid">
		<div class="col-md-4 col-md-offset-4 login-form">
			<form id="superAdminLogin">
				<div class="form-group">
					<label>Email ID:</label>
					<input type="text" name="email_id" class="form-control">
				</div>
				<div class="form-group">
					<label>Password:</label>
					<input type="password" name="password" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-login">Login</button>
					<div><a href="">Forgot Password ?</a></div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">

	$("#superAdminLogin").submit(function(event) {
	    event.preventDefault();
	}).validate({
	    rules: {
	     email_id: "required",
	     password: "required"
	    },
	    submitHandler: function(form) { 
	    	
	        $.ajax({
	        	url:'<?php echo base_url(); ?>get/adminLogin',
	        	type: 'POST',
                data: $('form').serialize(),
                dataType:'json',
                success:function(as){
                	if(as.status == true){
                		location.href="home";
                	}
                	else if(as.status == false){
                		alert("Wrong Email or Password");
                	}
                }
	        });
	    }
	});
</script>
