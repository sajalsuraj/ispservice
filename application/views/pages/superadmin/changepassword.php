<?php
	if($this->session->has_userdata('type') == true){
		if($this->session->userdata('type') == "superadmin"){
			
		}
		else if($this->session->userdata('type') == "subadmin"){
			
		}
		else{
			redirect('admin/login'); 
		}
	}
	else{
		redirect('admin/login');
	}
?>
<div class="container-fluid">
	<div class="col-md-12 menubar">  
		<?php if($this->session->userdata('type') == "superadmin"){ ?>
		<div class="menu fleft"><a href="home">Home</a></div>
		<div class="menu fleft btn-group">
			<a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
			<ul class="dropdown-menu">
			    <li><a href="orderlist">Order List</a></li>
			    <li><a href="invoiceorderlist">Customer Invoice List</a></li>
			    <li><a href="customerlist">Customer List</a></li>
			    <li><a href="dataplan">Data Plan</a></li> 
			    <li><a href="banner">HomePage Banner</a></li>
			    <li><a href="add-event">Manage Events</a></li> 
			</ul>
		</div>
		<?php } ?>
		<?php if($this->session->userdata('type') == "subadmin"){ ?>
		<div class="menu fleft"><a href="customerlist">Home</a></div>
		<?php } ?>
		<div class="menu fleft"><a href="changepassword">Password Change</a></div>
		<?php if($this->session->userdata('type') == "superadmin"){ ?>
		<div class="menu fleft btn-group">
			<a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Support</a>
			<ul class="dropdown-menu">
			    <li><a href="queries">Queries</a></li>
			</ul>
		</div>
		<div class="menu fleft"><a href="add-admin">Create Sub-Admin</a></div>
		<?php } ?>
		<div class="menu fleft"><a href="<?php echo base_url(); ?>user/logout">Logout</a></div>
	</div>

	<div class="col-md-12 heading">
		<h3>ABC iService Change Password</h3>
	</div>

	<div class="col-md-12">
			<div class="col-md-4 col-md-offset-4 form-style">
			<form id="changePass">
				<div class="form-group">
					<label>Old Password:</label> 
					<input type="password" name="old_pass" class="form-control">
				</div>
				<div class="form-group">
					<label>New Password:</label>
					<input type="password" name="new_pass" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-login">Submit</button>
				</div>
			</form>
		</div>	
	</div>

	<script type="text/javascript">
		//Function for updating plan
		$("#changePass").submit(function(event) {
		    event.preventDefault();
		}).validate({
		    rules: {
		     	old_pass: "required",
		     	new_pass: "required"
		    },
		    submitHandler: function(form) {   
		    	
		        $.ajax({
		        	url:'<?php echo base_url(); ?>get/checkSuperadminpass',
		        	type: 'POST',
	                data: {oldpass:$('input[name=old_pass]').val()},
	                dataType:'json',
	                success:function(as){
	                	if(as.data == "FALSE"){
	                		alert("Wrong Old Password");
	                	}
	                	else if(as.data == "TRUE"){
	                		$.ajax({
					        	url:'<?php echo base_url(); ?>update/changepasswordSuperadmin',
					        	type: 'POST',
				                data: {pass:$('input[name=new_pass]').val(), id:"<?php echo $this->session->userdata('user_id') ?>"},
				                dataType:'json',
				                success:function(as){
				                	if(as.status == true){
				                		alert(as.message);
				                		location.reload();
				                	}
				                }
					        });
	                	}
	                }
		        });
		    }
		});
	</script>
</div>