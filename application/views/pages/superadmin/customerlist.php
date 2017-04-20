<?php
	if($this->session->has_userdata('type') == true){
		if($this->session->userdata('type') == "superadmin" || $this->session->userdata('type') == "subadmin"){
			
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
			    <li><a href="invoiceorderlist">Invoice</a></li>
			    <li><a href="customerlist">Customer List</a></li>
			    <li><a href="dataplan">Data Plan</a></li> 
			    <li><a href="banner">HomePage Banner</a></li> 
			    <li><a href="add-event">Manage Events</a></li> 
			</ul>
		</div>
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
		<h3>ABC iService Customer List</h3>
	</div>

	<div class="col-md-12">
		<div class="col-md-12">
			<a href="add-customer" class="btn btn-success">Add New Customer</a>
			<a href="<?php echo base_url(); ?>excelgenerate/getCustomerExcel" class="btn btn-success">Download customer list</a>
		</div>
		<div class="col-md-12 custList">
			<table class="table table-bordered">
				<thead> 
					<tr> 	
						<th>Customer ID</th> 
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>DOJ</th>
						<th>Data Plan</th> 
						<th>Status</th>
						<th>Actions</th>
					</tr> 
				</thead> 
				<tbody> 
					<?php 
							$allCustomer = $this->customer->getAll();
							
							foreach ($allCustomer['result'] as $customer) { ?>
								<tr> 	
									<td><?php echo $customer->customer_id; ?></td>
									<td><?php echo $customer->first_name; ?></td> 
									<td><?php echo $customer->last_name; ?></td>
									<td><?php echo $customer->email; ?></td>
									<td><?php echo $customer->phone; ?></td> 
									<td><?php echo $customer->doj; ?></td>
									<td><?php echo $customer->data_plan; ?></td>  
									<td><?php echo $customer->status; ?></td>
									<td><button id="cust_<?php echo $customer->customer_id; ?>" class="btn custEdit">Edit</button> <button id="cusdel_<?php echo $customer->customer_id; ?>" class="btn delCust">Delete</button> <a id="cusInfo_<?php echo $customer->customer_id; ?>" href="<?php echo base_url(); ?>customer/detail?id=<?php echo $customer->customer_id; ?>" class="btn btn-invoice">Download</a></td>
								</tr> 
						<?php }?> 
				</tbody> 
			</table>
		</div>
	</div>

	<div id="custEditBox" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"></h4>
	      </div>
	      <div class="modal-body">
	        <div class="container-fluid editcustbox">	
	        	<form id="editCustomerForm" enctype="multipart/form-data">
	        		<table class="table table-bordered">
	        			<thead>
	        				<th>Fields</th>
	        				<th>Details</th>
	        			</thead>
	        			<tbody>
	        				<tr>
	        					<td>First Name</td>
	        					<td><input type="text" name="first_name" class="form-control"></td>
	        				</tr>
	        				<tr>
	        					<td>Last Name</td>
	        					<td><input type="text" name="last_name" class="form-control"></td>
	        				</tr>
	        				<tr>
	        					<td>Address</td>
	        					<td><input type="text" name="address" class="form-control"></td>
	        				</tr>
	        				<tr>
	        					<td>City</td>
	        					<td><input type="text" name="city" class="form-control"></td>
	        				</tr>
	        				<tr>
	        					<td>Pincode</td>
	        					<td><input type="text" name="pincode" class="form-control"></td>
	        				</tr>
	        				<tr>
	        					<td>Email ID</td>
	        					<td><input type="email" name="email" class="form-control"></td>
	        				</tr>
	        				<tr>
	        					<td>Phone</td>
	        					<td><input type="text" name="phone" class="form-control"></td>
	        				</tr>
	        				<tr>
	        					<td>Connectivity Type</td>
	        					<td>
	        						<select class="form-control" name="connectivity_type">
	        							<option value="RF">RF</option>
	        							<option value="Fiber">Fiber</option>
	        							<option value="DSL">DSL</option>
	        							<option value="Ethernet">Ethernet</option>
	        							<option value="GETH">GETH</option>
	        						</select>
	        					</td>
	        				</tr>
	        				<tr>
	        					<td>IP Type</td>
	        					<td>
	        						<select class="form-control" name="ip_type">
	        							<option value="DHCP">DHCP</option>
	        							<option value="STATIC">STATIC</option>
	        						</select>
	        					</td>
	        				</tr>
	        				<tr>
	        					<td>IP Details</td>
	        					<td><input type="text" name="ip_details" class="form-control"></td>
	        				</tr>
	        				<tr>
	        					<td>Data Plan</td>
	        					<td> 
	        						<select class="form-control" name="data_plan">
										<?php 
										$allPlans = $this->dataplan->getAll();
										
										foreach ($allPlans['result'] as $plan) { ?>
											<option value="<?php echo $plan->plan_name; ?>"><?php echo $plan->plan_name; ?></option>
										<?php } ?>
										
									</select>
	        					</td>
	        				</tr>
	        				<tr>
	        					<td>Billing Mode</td>
	        					<td>
	        						<select class="form-control" name="billing_mode">
	        							<option value="monthly">Monthly</option>
	        						</select>
	        					</td>
	        				</tr>
	        				<tr>
	        					<td>Equipment Details</td>
	        					<td>
	        						<label>Model</label>
	        						<input type="text" name="eq_mode" class="form-control"><br />
	        						<label>Serial</label>
	        						<input type="text" name="eq_serial" class="form-control"><br />
	        						<label>Mac Address</label>
	        						<input type="text" name="eq_mac" class="form-control"><br />
	        						<label>Manufacturer</label>
	        						<input type="text" name="eq_manufacture" class="form-control">
	        					</td>
	        				</tr>
	        				<tr>
	        					<td>Customer Photo</td>
	        					<td><input type="file" name="profile_pic"><a id="profilePic" target="_blank"></a></td>
	        				</tr>
	        				<tr>
	        					<td>KYC Form</td>
	        					<td><input type="file" name="kyc_form"> <a id="kyc" target="_blank"></a></td>
	        				</tr>
	        				<tr>
	        					<td>ID Proof</td>
	        					<td><input type="file" name="id_proof"><a id="idProof" target="_blank"></a></td>
	        				</tr>
	        				<tr>
	        					<td>Address Proof</td>
	        					<td><input type="file" name="address_proof"><a id="addProof" target="_blank"></a></td>
	        				</tr>
	        				<tr>
	        					<td>Status</td>
	        					<td>
	        						<select class="form-control" name="status">
	        							<option value="Active">Active</option>
	        							<option value="Inactive">Inactive</option>
	        							<option value="Suspended">Suspended</option>
	        						</select>
	        					</td>
	        				</tr>
	        			</tbody>
	        		</table>
	        		<div>
	        			<center>
		        			<button type="button" class="btn btn-default wid20" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</center>
	        		</div>
        		</form>
	        </div>
	      </div>
	      <div class="modal-footer">
	         
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<script>

		var id = "";
		$('.custEdit').click(function(){
			id = $(this).attr('id');
			var obj = {id:id.split("_")[1]};
			$.ajax({
				url:'<?php echo base_url(); ?>get/getCustomerDetails',
				type:'POST',
				data:obj,
				dataType:'json',
				success:function(as){
					console.log(as.data.connectivity_type);
					$('input[name=first_name]').val(as.data.first_name);
					$('input[name=last_name]').val(as.data.last_name);
					$('input[name=address]').val(as.data.address);
					$('input[name=city]').val(as.data.city);
					$('input[name=pincode]').val(as.data.pincode);
					$('input[name=email]').val(as.data.email);
					$('input[name=phone]').val(as.data.phone);
					$('select[name=connectivity_type]').val(as.data.connectivity_type);
					$('select[name=ip_type]').val(as.data.ip_type);
					$('input[name=ip_details]').val(as.data.ip_details);
					$('select[name=data_plan]').val(as.data.data_plan);
					$('select[name=billing_mode]').val(as.data.billing_mode);
					$('input[name=eq_mode]').val(as.data.eq_mode);
					$('input[name=eq_serial]').val(as.data.eq_serial);
					$('input[name=eq_mac]').val(as.data.eq_mac);
					$('input[name=eq_manufacture]').val(as.data.eq_manufacture);
					$('select[name=status]').val(as.data.status);
					if(as.data.kyc_form != ""){
						$('#kyc').attr('href', '<?php echo base_url()."assets/kyc/" ?>'+as.data.kyc_form);
						$('#kyc').html('View');
					}
					else{
						$('#kyc').attr('href','');
						$('#kyc').html('');
					}
					if(as.data.id_proof != ""){
						$('#idProof').attr('href', '<?php echo base_url()."assets/idproof/" ?>'+as.data.id_proof);
						$('#idProof').html('View');
					}
					else{
						$('#idProof').attr('href','');
						$('#idProof').html('');
					}
					if(as.data.address_proof != ""){
						$('#addProof').attr('href', '<?php echo base_url()."assets/addressproof/" ?>'+as.data.address_proof);
						$('#addProof').html('View');
					}
					else{
						$('#addProof').attr('href','');
						$('#addProof').html('');
					}
					if(as.data.profile_pic != ""){
						$('#profilePic').attr('href', '<?php echo base_url()."assets/images/" ?>'+as.data.profile_pic);
						$('#profilePic').html('View');
					}
					else{
						$('#profilePic').attr('href','');
						$('#profilePic').html('');
					}
					$('#custEditBox').modal('show');
				}
			});
			
		});

		//Function for updating customer 
		$("#editCustomerForm").submit(function(event) {
		    event.preventDefault();
		}).validate({
		    rules: {
		     	first_name: "required",
		     	last_name: "required"
		    },
		    submitHandler: function(form) { 
		    	
		        $.ajax({
		        	url:'<?php echo base_url(); ?>update/customer?id='+id.split("_")[1],
		        	type: 'POST',
	                data: new FormData( form ),
			        processData: false,
			        contentType: false,
	                dataType:'json',
	                success:function(as){
	                	if(as.status == true){
	                		alert("Profile Successfully updated");
	                		location.reload();
	                	}
	                	else{
	                		alert("Error while updating");
	                	}
	                }
		        });
		    }
		});

		//Function for deleting plans
		$('.delCust').click(function(){  
			id = $(this).attr('id');
			if (confirm("Do you really want to delete this ?") == true) {

				var obj = {id:id.split("_")[1]};
		        $.ajax({
		        	url:'<?php echo base_url(); ?>delete/deleteCustomer',
		        	type: 'POST',
	                data: obj,
	                dataType:'json',
	                success:function(as){
	                	if(as.status == true){
	                		alert(as.message);
	                		location.reload();
	                	}
	                	else{
	                		alert("Error while updating");
	                	}
	                }
		        });
		    } else {
		        
		    }
		});


	</script>
</div>