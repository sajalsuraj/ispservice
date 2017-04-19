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
			    <li><a href="banner">HomePage Banner</a></li> 
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
						<th>Customer ID</th> 
						<th>Customer Name</th>
						<th>Subject</th>
						<th>Query</th> 
					</tr> 
				</thead>
				<tbody>
					<?php 
							$allQueries = $this->superadmin->getAllQueries();

							foreach ($allQueries['result'] as $query) { ?>
								<tr>
								 	<td><?php echo $query->customer_id; ?></td>
								 	<td><?php echo $query->name; ?></td>
								 	<td><?php echo $query->subject; ?></td>
								 	<td><?php echo $query->query; ?></td>
								</tr>
							<?php } ?>
					<?php ?>
				</tbody>
			</table>
	</div>
</div>