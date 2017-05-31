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
		<div class="menu fleft"><a href="home">Home</a></div>
		<div class="menu fleft btn-group">
			<a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
			<ul class="dropdown-menu">
			    <li><a href="orderlist">Order List</a></li>
			    <li><a href="invoiceorderlist">Customer Invoice List</a></li>
			    <li><a href="customerlist">Customer List</a></li>
			    <li><a href="dataplan">Data Plan</a></li>
			    <li><a href="banner">HomePage Banner</a></li> 
			    <li><a href="footer-banner">HomePage Footer Banner</a></li> 
			    <li><a href="add-event">Manage Events</a></li> 
			</ul>
		</div>
		<div class="menu fleft"><a href="changepassword">Password Change</a></div>
		<div class="menu fleft btn-group">
			<a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Support</a>
			<ul class="dropdown-menu">
			    <li><a href="queries">Queries</a></li>
			</ul>
		</div>
		<div class="menu fleft"><a href="add-admin">Create Sub-Admin</a></div>
		<div class="menu fleft"><a href="<?php echo base_url(); ?>user/logout">Logout</a></div>
	</div>

	<div class="col-md-12 heading">
		<h3>Add Plan</h3>
	</div>

	<div class="col-md-12">
		<div class="col-md-4 col-md-offset-4">
			<form id="addPlanForm">
				<div class="form-group">
					<label>Plan Name</label>
					<input type="text" name="plan_name" class="form-control">
				</div>
				<div class="form-group">
					<label>Price</label>
					<input type="text" name="price" class="form-control">
				</div>
				<div class="form-group">
					<label>Validity</label>
					<select name="validity" class="form-control">
						<option value="15 Days">15 Days</option>
						<option value="30 Days">30 Days</option>
					</select>
				</div>
				<div class="form-group">
					<label>Data (in GB)</label>
					<input type="text" name="data" class="form-control">
				</div>
				<div class="form-group">
					<label>Download Speed (in MBPS)</label>
					<input type="text" name="download_speed" class="form-control">
				</div>
				<div class="form-group">
					<label>Upload Speed (in MBPS)</label>
					<input type="text" name="upload_speed" class="form-control">
				</div>
				<div class="form-group">
					<center><button type="submit" class="btn btn-plan">Add Plan</button></center>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#validity').datepicker({
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true
	});

	$("#addPlanForm").submit(function(event) {
	    event.preventDefault();
	}).validate({
	    rules: {
	     plan_name: "required",
	     price: "required",
	     validity: "required",
	     speed: "required"
	    },
	    submitHandler: function(form) { 
	    	
	        $.ajax({
	        	url:'<?php echo base_url(); ?>add/addDataPlan',
	        	type: 'POST',
                data: $('form').serialize(),
                dataType:'json',
                success:function(as){
                	console.log(as);
                	if(as.status == true){
                		alert(as.message);
                		location.reload();
                	}
                    else if(as.status == false){
                    	alert(as.message);
                    }
                }
	        });
	    }
	});
</script>