<?php 
	
	if($this->session->has_userdata('type') == true){
		if($this->session->userdata('type') == "customer"){
			
		}
		else{
			redirect('login');
		}
	}
	else{
		redirect('login');
	}

?>
<section id="main_mid_sec">
	<div class="mig_logsec">
	<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="sign_top">
				<h1>Pending Bills</h1>
			</div>	
		</div>
	</div>
	
	<div class="row">
		
		<div class="col-xs-24">
			<?php $allorders = $this->customer->getOrderByCustomer($this->session->userdata('user_id'));?>
			<table class="table table-bordered">
				<thead> 
					<tr> 	 
						<th>Invoice No.</th> 
						<th>Customer Name</th>
						<th>Capacity</th> 
						<th>Circuit ID</th> 
						<th>Order Status</th>
						<th>Location</th>
						<th>Actions</th>
					</tr> 
				</thead> 
				<tbody>
					<?php foreach($allorders as $order){ ?>
					<tr>
						<td><?php echo $order->invoice_no; ?></td>
						<td><?php echo $order->first_name." ".$order->last_name; ?></td>
						<td><?php echo $order->data_plan; ?></td>
						<td><?php echo $order->customer_id; ?></td>
						<td><?php echo $order->status; ?></td>
						<td><?php echo $order->city; ?></td>
						<td><a href="<?php echo base_url().'invoice/generate?order_no='.$order->order_no; ?>">Download Bill</a></td>
					</tr>
				    <?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
	
</section>