<?php
	if($this->session->has_userdata('type') == true){
		if($this->session->userdata('type') == "superadmin"){
			
		}
		else{
			redirect('superadmin/login'); 
		}
	}
	else{
		redirect('superadmin/login');
	}
?>
<div class="container-fluid">
	<div class="col-md-12 menubar"> 
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
		<h3>ABC iService Customer CRM</h3>
	</div>

	<div class="col-md-12">
		<div class="col-md-4 col-md-offset-4"> 
			<?php $user = $this->superadmin->getSuperadmin($this->session->userdata('user_id')); ?>
			<table class="table table-bordered">     
				<thead> 
					<tr> 	
						<th>First Name</th> 
						<th>Last Name</th> 
					</tr> 
				</thead> 
				<tbody> 
					<tr> 
						<td>User ID</td> 
						<td><input type="text" name="" value="<?php echo $user->user_id; ?>" class="form-control"></td> 
					</tr> 
					<tr> 
						<td>Company</td> 
						<td><input type="text" name="" value="<?php echo $user->company; ?>" class="form-control"></td> 
					</tr> 
					<tr> 
						<td>First Name</td> 
						<td><input type="text" name="" value="<?php echo $user->first_name; ?>" class="form-control"></td> 
					</tr> 
					<tr> 
						<td>Last Name</td> 
						<td><input type="text" name="" value="<?php echo $user->last_name; ?>" class="form-control"></td> 
					</tr> 
					<tr> 
						<td>Email</td> 
						<td><input type="email" name="" value="<?php echo $user->email_id; ?>" class="form-control"></td> 
					</tr> 
					<tr> 
						<td>Mobile</td> 
						<td><input type="text" name="" value="<?php echo $user->mobile; ?>" class="form-control"></td> 
					</tr> 
					<tr> 
						<td>Address</td> 
						<td><textarea class="form-control"><?php echo $user->address; ?></textarea></td> 
					</tr> 
					<tr> 
						<td>City</td> 
						<td><input type="text" name="" value="<?php echo $user->city; ?>" class="form-control"></td> 
					</tr>
					<tr> 
						<td>State</td> 
						<td><input type="text" name="" value="<?php echo $user->state; ?>" class="form-control"></td> 
					</tr>
					<tr> 
						<td>Pincode</td> 
						<td><input type="text" name="" value="<?php echo $user->pincode; ?>" class="form-control"></td> 
					</tr>
				</tbody> 
			</table>
		</div>
	</div>
</div>