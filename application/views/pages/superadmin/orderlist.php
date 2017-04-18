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
		<h3>Order List</h3>
	</div>
	<?php $allorders = $this->customer->getOrders();?>

	<div class="col-md-12">
		<div class="col-md-12 custList">
			<table class="table table-bordered">
				<thead> 
					<tr> 	 
						<th>Order No.</th> 
						<th>Customer Name</th>
						<th>Capacity</th>
						<th>Circuit ID</th> 
						<th>Order Status</th>
						<th>Location</th>
					</tr> 
				</thead> 
				<tbody>
					<?php foreach($allorders as $order){ ?>
					<tr>
						<td><a id="cust_<?php echo $order->customer_id; ?>" class="cursorpoint opencustbox"><?php echo $order->order_no; ?></a></td>
						<td><?php echo $order->first_name." ".$order->last_name; ?></td>
						<td><?php echo $order->data_plan; ?></td>
						<td><?php echo $order->customer_id; ?></td>
						<td><?php echo $order->status; ?></td>
						<td><?php echo $order->city; ?></td>
					</tr>
				    <?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<div id="custBox" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"></h4>
	      </div>
	      <div class="modal-body">
	        <div class="container-fluid editcustbox">	
	        	<fieldset>
	        		<legend>
	        			<h4>Client Information</h4>
	        		</legend>
	        		<table class="table table-bordered">
	        			<tbody>
	        				<tr>
	        					<td>Order No.</td>
	        					<td id="order_no"></td>
	        				</tr>
	        				<tr>
	        					<td>First Name</td>
	        					<td id="fName"></td>
	        				</tr>
	        				<tr>
	        					<td>Last Name</td>
	        					<td id="lName"></td>
	        				</tr>
	        				<tr>
	        					<td>Mobile No.</td>
	        					<td id="mobile"></td>
	        				</tr>
	        				<tr>
	        					<td colspan="2"><h4>Billing Address</h4></td>
	        				</tr>
	        				<tr>
	        					<td>Address</td>
	        					<td id="address"></td>
	        				</tr>
	        				<tr>
	        					<td>City</td>
	        					<td id="city"></td>
	        				</tr>
	        				<tr>
	        					<td>State</td>
	        					<td id="state"></td>
	        				</tr>
	        				<tr>
	        					<td>Pincode</td>
	        					<td id="pincode"></td>
	        				</tr>
	        				<tr>
	        					<td>Billing Mode</td>
	        					<td id="bMode"></td>
	        				</tr>
	        				<tr>
	        					<td colspan="2"><h4>Technical Information</h4></td>
	        				</tr>
	        				<tr>
	        					<td>Capacity</td>
	        					<td id="capacity"></td>
	        				</tr>
	        				<tr>
	        					<td>IP Address</td>
	        					<td id="ipAdd"></td>
	        				</tr>
	        				<tr>
	        					<td>Delivery Date</td>
	        					<td id="date"></td>
	        				</tr>
	        				<tr>
	        					<td>Equipment Provided by</td>
	        					<td>Customer</td>
	        				</tr>
	        			</tbody>
	        		</table>
        		</fieldset>
	        </div>
	      </div>
	      <div class="modal-footer">
	         
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<script type="text/javascript">
		$('.opencustbox').click(function(){

			var order_no = $(this).html();
			var obj = {id:order_no};
			$.ajax({
				url:'<?php echo base_url(); ?>get/getorder',
				type:'POST',
				data: obj,
				dataType:'json',
				success:function(as){

					$('#order_no').html(as.data.order_no);
					$('#fName').html(as.data.first_name);
					$('#lName').html(as.data.last_name);
					$('#mobile').html(as.data.phone);
					$('#address').html(as.data.address);
					$('#city').html(as.data.city);
					$('#state').html(as.data.state);
					$('#pincode').html(as.data.pincode);
					$('#bMode').html(as.data.billing_mode);
					$('#capacity').html(as.data.data_plan);
					$('#ipAdd').html(as.data.ip_details);
					$('#date').html(as.data.billing_cycle);
					$('#custBox').modal('show');
				}
			});
			
		});

	</script>
</div>