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
			    <li><a href="footer-banner">HomePage Footer Banner</a></li> 
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
		<h3>Add Customer</h3>
	</div>

	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2 m2per">
			<form id="addCustomerForm">
				<div class="col-md-6">
					
					<div class="form-group">
						<label>First Name</label>
						<input type="text" name="first_name" class="form-control">
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input type="text" name="last_name" class="form-control">
					</div>
					<div class="form-group">
						<label>Father's Name</label>
						<input type="text" name="father_name" class="form-control">
					</div>
					<div class="form-group">
						<label>Date Of Birth</label>
						<input type="text" name="dob" readonly="" class="form-control">
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea class="form-control" name="address"></textarea>
					</div>
					<div class="form-group">
						<label>City</label>
						<input type="text" name="city" class="form-control">
					</div>
					<div class="form-group">
						<label>State</label>
						<select class="form-control" name="state">
							<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
							<option value="Andhra Pradesh">Andhra Pradesh</option>
							<option value="Arunachal Pradesh">Arunachal Pradesh</option>
							<option value="Assam">Assam</option>
							<option value="Bihar">Bihar</option>
							<option value="Chandigarh">Chandigarh</option>
							<option value="Chhattisgarh">Chhattisgarh</option>
							<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
							<option value="Daman and Diu">Daman and Diu</option>
							<option value="Delhi">Delhi</option>
							<option value="Goa">Goa</option>
							<option value="Gujarat">Gujarat</option>
							<option value="Haryana">Haryana</option>
							<option value="Himachal Pradesh">Himachal Pradesh</option>
							<option value="Jammu and Kashmir">Jammu and Kashmir</option>
							<option value="Jharkhand">Jharkhand</option>
							<option value="Karnataka">Karnataka</option>
							<option value="Kerala">Kerala</option>
							<option value="Lakshadweep">Lakshadweep</option>
							<option value="Madhya Pradesh">Madhya Pradesh</option>
							<option value="Maharashtra">Maharashtra</option>
							<option value="Manipur">Manipur</option>
							<option value="Meghalaya">Meghalaya</option>
							<option value="Mizoram">Mizoram</option>
							<option value="Nagaland">Nagaland</option>
							<option value="Orissa">Orissa</option>
							<option value="Pondicherry">Pondicherry</option>
							<option value="Punjab">Punjab</option>
							<option value="Rajasthan">Rajasthan</option>
							<option value="Sikkim">Sikkim</option>
							<option value="Tamil Nadu">Tamil Nadu</option>
							<option value="Telangana">Telangana</option>
							<option value="Tripura">Tripura</option>
							<option value="Uttaranchal">Uttaranchal</option>
							<option value="Uttar Pradesh">Uttar Pradesh</option>
							<option value="West Bengal">West Bengal</option>
						</select>
					</div>

					<div class="form-group">
						<label>Pincode</label>
						<input type="text" name="pincode" class="form-control">
					</div>
					<div class="form-group">
						<label>Email ID</label>
						<input type="email" name="email" class="form-control">
					</div>
					<div class="form-group">
						<label>Phone Number</label>
						<input type="text" name="phone" class="form-control">
					</div>
					<div class="form-group">
						<label>Connectivity Type</label>
						<select class="form-control" name="connectivity_type">
							<option value="RF">RF</option>
							<option value="Fiber">Fiber</option>
							<option value="DSL">DSL</option>
							<option value="Ethernet">Ethernet</option>
							<option value="GETH">GETH</option>
						</select>
					</div>
					<div class="form-group">
						<label>IP Type</label>
						<select class="form-control" name="ip_type">
							<option value="DHCP">DHCP</option>
							<option value="STATIC">STATIC</option>
							<option value="DHCP">PPPOE</option>
							<option value="STATIC">Local IP</option>
						</select>
					</div>
					<div class="form-group">
						<label>IP Details</label>
						<input type="text" name="ip_details" class="form-control">
					</div>

				</div><!--end half of the form-->

				<div class="col-md-6">
					
					<!-- <div class="form-group">
						<label>Login ID</label>
						<input type="text" name="" class="form-control">
					</div> -->
					<div class="form-group">
						<label>Data Plan</label>
						<select class="form-control" name="data_plan">
							<option disabled>Select data plan</option> 
							<?php 
							$allPlans = $this->dataplan->getAll();
							
							foreach ($allPlans['result'] as $plan) { ?>
								<option value="<?php echo $plan->plan_name; ?>"><?php echo $plan->plan_name; ?></option>
							<?php } ?>
							
						</select>
					</div>
					<div class="form-group">
						<label>Select Billing Cycle Date</label>
						<input type="text" id="billingdate" name="billing_cycle" class="form-control">
					</div>
					<div class="form-group">
						<label>Select Billing Mode</label>
						<select class="form-control" name="billing_mode">
							<option>Select mode</option>
							<option value="monthly">Monthly</option>
						</select>
					</div>
					<div class="form-group">
						<label>Equipment Required</label>
						<div class="col-md-12">
							<div class="form-group">
								<label>Model</label>
								<input type="text" name="eq_mode" class="form-control">
							</div>
							<div class="form-group">
								<label>Serial</label>
								<input type="text" name="eq_serial" class="form-control">
							</div>
							<div class="form-group">
								<label>MAC</label>
								<input type="text" name="eq_mac" class="form-control">
							</div>
							<div class="form-group">
								<label>Manufacturer</label>
								<input type="text" name="eq_manufacture" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>KYC Form</label>
						<input type="file" name="kyc_form" class="form-control">
					</div>
					<div class="form-group">
						<label>Customer Photo</label>
						<input type="file" name="profile_pic" class="form-control">
					</div>
					<div class="form-group">
						<label>ID Proof</label>
						<input type="file" name="id_proof" class="form-control">
					</div>
					<div class="form-group">
						<label>Address Proof</label>
						<input type="file" name="address_proof" class="form-control">
					</div>
					<div class="form-group">
						<label>Aadhar ID</label>
						<input type="text" name="aadhar_no" class="form-control">
					</div>

				</div>
				
				<div class="col-md-12">
					<center><button class="btn btn-add">Add Customer</button></center>
				</div>	
			</form><!--End of the form-->
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#billingdate, input[name=dob]').datepicker({
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true
	});

	$("#addCustomerForm").submit(function(event) {
	    event.preventDefault();
	}).validate({
	    rules: {
	     	first_name: "required",
	     	last_name: "required",
	     	father_name: "required",
	     	address: "required",
	     	city: "required",
	     	state: "required", 
	     	pincode: "required",
	     	aadhar_no: {
	     		required: true,
	     		minlength: 16,
	     		maxlength: 16
	     	}
	    },
	    submitHandler: function(form) { 
	    	
	        $.ajax({
	        	url:'<?php echo base_url(); ?>add/addCustomer',
	        	type: 'POST',
                data: new FormData( form ),
                processData: false,
		        contentType: false,
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