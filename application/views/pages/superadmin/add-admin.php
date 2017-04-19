<?php
	if($this->session->has_userdata('type') == true){
		if($this->session->userdata('type') == "superadmin"){
			
		}
		else if($this->session->userdata('type') == "subadmin"){
			redirect('admin/customerlist');
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
			    <li><a href="invoiceorderlist">Invoice</a></li>
			    <li><a href="customerlist">Customer List</a></li>
			    <li><a href="dataplan">Data Plan</a></li> 
			</ul>
		</div>
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
		<h3>Add Sub-admin</h3>
	</div>

	<div class="col-md-12">
		<div class="col-md-4 col-md-offset-4">
			<form id="addAdminForm">
				<div class="form-group">
					<label>First name</label>
					<input type="text" name="first_name" class="form-control">
				</div>
				<div class="form-group">
					<label>Last name</label>
					<input type="text" name="last_name" class="form-control">
				</div>
				<div class="form-group">
					<label>Photo</label>
					<input type="file" name="profile_pic">
				</div>
				<div class="form-group">
					<label>Email ID</label>
					<input type="email" name="email_id" class="form-control">
				</div>
				<div class="form-group">
					<label>Mobile number</label>
					<input type="number" name="mobile" class="form-control">
				</div>
				<div class="form-group">
					<label>Address</label>
					<textarea name="address" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label>City</label>
					<input type="text" name="city" class="form-control">
				</div>
				<div class="form-group">
					<label>State</label>
					<input type="text" name="state" class="form-control">
				</div>
				<div class="form-group">
					<label>Pincode</label>
					<input type="number" name="pincode" class="form-control">
				</div>
				<div class="form-group">
					<center><button type="submit" class="btn btn-plan">Add Admin</button></center>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	$("#addAdminForm").submit(function(event) {
	    event.preventDefault();
	}).validate({
	    rules: {
	     name:"required",
	     email:"required"
	    },
	    submitHandler: function(form) { 
	    	
	        $.ajax({
	        	url:'<?php echo base_url(); ?>add/addAdmin',
	        	type: 'POST',
                data: $('form').serialize(),
                dataType:'json',
                success:function(as){
                	
                	if(as.status == true){
                		alert("Admin added");
                		location.reload();
                	}
                    else if(as.status == false){
                    	alert("Admin Not added");
                    }
                }
	        });
	    }
	});
</script>