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
		<h3>ABC iService Invoices</h3>
	</div>

	<div class="col-md-12">
		<div class="col-md-12 custList">
			<div class="col-md-6 col-md-offset-3">
				<?php $allOrders = $this->customer->getAllOrders(); ?>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td>Date:</td>
							<td><input id="date" type="text" name="" class="form-control"></td>
							<td>
								<select class="form-control">
									<?php foreach($allOrders['result'] as $order){ ?>
										<option value="<?php echo $order->order_no; ?>">
											<?php echo $order->order_no; ?>
										</option>
									<?php } ?>
								</select>
							</td> 
						</tr>
						<tr>
							<td colspan="3">
								<center><a href="<?php echo base_url(); ?>invoice/generate" class="btn btn-invoice">Submit</a></center>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$('#date').datepicker({
			dateFormat: 'yy-mm'
		});
	</script>
</div>