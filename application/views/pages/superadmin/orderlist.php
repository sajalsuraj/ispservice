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
		<h3>Order List</h3> 
	</div>

	<div class="col-md-12">
		<div class="col-md-12 custList">
			<div class="col-md-6 col-md-offset-3"> 
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td>Date:</td>
							<td><input id="date" readonly="" type="text" name="" class="form-control"></td>
							<td>
								<select class="form-control">
									
								</select>
							</td> 
						</tr>
						<tr>
							<td colspan="3">
								<center><a id="getOrders" class="btn btn-invoice">Submit</a></center>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

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
						<th>Actions</th>
					</tr> 
				</thead> 
				<tbody id="customerDetail">
					
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
	        					<td id="dDate"></td>
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
		
		function customerBox(){
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
						$('#dDate').html(as.data.billing_cycle);
						$('#custBox').modal('show');
					}
				});
				
			});
		}

		var date = new Date();
		var month = date.getMonth()+1;
		var year = date.getFullYear();

		var option = "", count = 0;

		function getCustomerIdName(month, year){
			var obj = {month:month, year:year};
			$.ajax({
				url:'<?php echo base_url(); ?>get/getAllOrders',
				type:'POST',
				data: obj,
				dataType:'json',
				success:function(as){
					option = '';
					option += '<option value="all">All</option>';

					if(as.status == false){
						$('select').html(option);
					}
					else if(as.status == true){
						for(var i=0; i < as.data.length; i++){
							option += '<option value="'+as.data[i].order_no+'">'+as.data[i].order_no+'</option>';
						}
						$('select').html(option);
					}

					$('#getOrders').off().click(function(event){
						event.preventDefault();
						if($('select').val() == "all"){
							var obj = {month:month, year:year};
							$.ajax({
								url:'<?php echo base_url(); ?>get/getAllOrders',
								type:'POST',
								data: obj,
								dataType:'json',
								success:function(res){
									
									
									if(res.status == true){
										var info = "";

										
										for(var i=0;i<res.data.length;i++){
											info += '<tr>';
											info += '<td><a id="cust_'+res.data[i].customer_id+'" class="cursorpoint opencustbox">'+res.data[i].order_no+'</a></td>';
											info += '<td>'+res.data[i].first_name+' '+res.data[i].last_name+'</td>';
											info += '<td>'+res.data[i].data_plan+'</td>';
											info += '<td>'+res.data[i].customer_id+'</td>';
											info += '<td>'+res.data[i].status+'</td>';
											info += '<td>'+res.data[i].city+'</td>';
											info += '<td><a href="<?php echo base_url()."invoice/generate?order_no=" ?>'+res.data[i].order_no+'" class="btn btn-invoice">Download Invoice</a></td>';
											info += '</tr>';
										}

										$('#customerDetail').html(info);

										customerBox();

									}
									else if(res.status == false){
									
										alert('No Data available for this month !!');
									}
								}
							});
						}
						else{
							$.ajax({
								url:'<?php echo base_url(); ?>get/getorder',
								data:{id:$('select').val()},
								type:'POST',
								dataType:'json',
								success:function(as){
									
									console.log(as);
									var invoiceField = "";
									invoiceField += '<tr><td><a id="cust_'+as.data.circuit_id+'" class="cursorpoint opencustbox">'+as.data.order_no+'</a></td>';
									invoiceField += '<td>'+as.data.first_name+' '+as.data.last_name+'</td>';
									invoiceField += '<td>'+as.data.data_plan+'</td>';
									invoiceField += '<td>'+as.data.circuit_id+'</td>';
									invoiceField += '<td>'+as.data.status+'</td>';
									invoiceField += '<td>'+as.data.city+'</td>';
									invoiceField += '<td><a class="btn btn-invoice" href="<?php echo base_url()."invoice/generate?order_no=" ?>'+as.data.order_no+'">Download PDF</a></td></tr>';

									$('#customerDetail').html(invoiceField);

									customerBox();
								}
							});
						}
						
					});
				}
			});
		}
		
		getCustomerIdName(month, year);

		$('#date').datepicker({
			dateFormat: 'yy-mm',
		    changeMonth: true,
		    changeYear: true,
			onSelect: function(dateText, inst) {
						var yearMonth = $(this).val();
				      	month = yearMonth.split('-')[1];
				      	year = yearMonth.split('-')[0];
				      	getCustomerIdName(month, year);
				      }
		}).datepicker("setDate", new Date());

		

	</script>
</div>