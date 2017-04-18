<?php 
	
	if($this->session->has_userdata('type') == true){
		if($this->session->userdata('type') == "customer"){
			
		}
		else{
			redirect('customer/login');
		}
	}
	else{
		redirect('customer/login');
	}

?>
<div class="container-fluid">
	<div class="col-md-12 menubar"> 
		<div class="menu fleft"><a href="home">Home</a></div>
		<div class="menu fleft btn-group">
			<a href="invoices">Invoices</a>
		</div>
		<div class="menu fleft"><a href="changepassword">Password Change</a></div>
		<div class="menu fleft btn-group">
			<a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Support</a>
			<ul class="dropdown-menu">
			    <li><a href="contact">Contact Us</a></li>
			</ul>
		</div>
		<div class="menu fleft"><a href="<?php echo base_url(); ?>user/logout">Logout</a></div>
	</div>

	<div class="col-md-12 heading">
		<h3>ABC iService Customer CRM</h3>
	</div>

	<div class="col-md-12">
		<div class="col-md-4 col-md-offset-4">
			<table class="table table-bordered"> 
				<thead> 
					<tr> 	
						<th>Fields</th> 
						<th>Details</th> 
					</tr> 
				</thead> 
				<tbody> 
					<?php 
						$customerDetails = $this->customer->getCustomerById($this->session->userdata('user_id'));
					?>
					<tr> 
						<td>First Name</td> 
						<td><input type="text" name="" value="<?php echo $customerDetails->first_name; ?>" class="form-control"></td> 
					</tr> 
					<tr> 
						<td>Last Name</td> 
						<td><input type="text" name="" value="<?php echo $customerDetails->last_name; ?>" class="form-control"></td> 
					</tr> 
					<tr> 
						<td>Email</td> 
						<td><input type="email" name="" value="<?php echo $customerDetails->email; ?>" class="form-control"></td> 
					</tr> 
					<tr> 
						<td>Mobile</td> 
						<td><input type="number" name="" value="<?php echo $customerDetails->phone; ?>" class="form-control"></td> 
					</tr> 
					<tr> 
						<td>Address</td> 
						<td><?php echo $customerDetails->address; ?></td> 
					</tr> 
					<tr> 
						<td>City</td> 
						<td><?php echo $customerDetails->city; ?></td> 
					</tr>
					<tr> 
						<td>State</td> 
						<td><?php echo $customerDetails->state; ?></td> 
					</tr>
					<tr> 
						<td>Pincode</td> 
						<td><?php echo $customerDetails->pincode; ?></td> 
					</tr>
				</tbody> 
			</table>
		</div>
	</div>
</div>