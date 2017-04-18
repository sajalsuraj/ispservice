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
		<h3>Your Invoices</h3>
	</div>

	<div class="col-md-12">
		<div class="col-md-12 custList">
			<table class="table table-bordered">
				<thead> 
					<tr> 	
						<th>Invoice ID</th> 
						<th>Invoice</th>
						<th>Generated On</th>
					</tr> 
				</thead> 
				<tbody> 
					<tr>
						<td>1200</td>
						<td><a href="">May2017Bill.pdf</a></td>
						<td>March 2017</td>
					</tr>
				</tbody> 
			</table>
		</div>
	</div>
</div>