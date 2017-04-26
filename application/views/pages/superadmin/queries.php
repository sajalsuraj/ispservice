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
		<h3>ABC iService Queries</h3>
	</div>

	<div class="col-md-12">
		<div class="col-md-12 custList">
			<table class="table table-bordered">
				<thead> 
					<tr> 	
						<th>Ticket ID</th>
						<th>Customer ID</th> 
						<th>Customer Name</th>
						<th>Subject</th>
						<th>Status</th> 
						<th>Created At</th>
					</tr> 
				</thead>
				<tbody>
					<?php 
							$allQueries = $this->admin->getAllQueries();

							foreach ($allQueries['result'] as $query) { ?>
								<tr>
									<td><?php echo $query->id; ?></td>
								 	<td><?php echo $query->customer_id; ?></td>
								 	<td><?php echo $query->name; ?></td>
								 	<td><a href="querythread/<?php echo $query->id; ?>"><?php echo $query->subject; ?></a></td>
								 	<td><?php echo $query->status; ?></td>
								 	<td><?php echo $query->created_at; ?></td>
								</tr>
							<?php } ?>
					<?php ?>
				</tbody>
			</table>
	</div>
</div>