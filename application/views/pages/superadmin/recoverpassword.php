<?php 
	
	if($this->session->has_userdata('type') == true){
		if($this->session->userdata('type') == "superadmin"){
			redirect('admin/home');
		}
	}

?>
<div class="col-md-12"><p><center><h3>Recover Your Password in a single click</h3></center></p></div>
<div class="col-md-12">
	<div class="container-fluid"> 
		<div class="col-md-4 col-md-offset-4 login-form">
			<form id="recoverPassForm"> 
				<div class="form-group">
					<label>Email ID:</label> 
					<input type="text" placeholder="abc@gmail.com" name="email_id" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-login">Continue</button>
				</div>
			</form>
		</div>  
	</div>
</div>
<script type="text/javascript">

	$("#recoverPassForm").submit(function(event) {
	    event.preventDefault();
	}).validate({
	    rules: {
	     email_id: "required"
	    },
	    submitHandler: function(form) { 
	    	
	        $.ajax({
	        	url:'<?php echo base_url(); ?>get/recoveradminpassword',
	        	type: 'POST',
                data: {email_id:$('input[name=email_id]').val()},
                dataType:'json',
                success:function(as){
                	if(as.status == false){
                		alert(as.data);
                	}
                	else if(as.status == true){
                		alert(as.data);
                	}
                }
	        });
	    }
	});
</script>
