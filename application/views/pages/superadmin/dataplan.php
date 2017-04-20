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
		<h3>ABC iService Data Plans</h3>
	</div>

	<div class="col-md-12">
		<div class="col-md-12">
			<a href="add-plan" class="btn btn-success">Add New Plan</a>
		</div>
		<div class="col-md-12 custList">
			<table class="table table-bordered">
				<thead> 
					<tr> 	
						<th>Plan Name</th> 
						<th>Price</th>
						<th>Validity</th> 
						<th>Speed(In MBPS)</th>
						<th>Actions</th>
					</tr> 
				</thead> 
				<tbody> 
						<?php 
							$allPlans = $this->dataplan->getAll();
							
							foreach ($allPlans['result'] as $plan) { ?>
								<tr> 	
									<td><?php echo $plan->plan_name; ?></td> 
									<td><?php echo $plan->price; ?></td>
									<td><?php echo $plan->validity; ?></td> 
									<td><?php echo $plan->speed; ?></td>  
									<td><button id="plan_<?php echo $plan->id; ?>" class="btn planEdit">Edit</button> <button id="delplan_<?php echo $plan->id; ?>" class="btn delPlan">Delete</button></td>
								</tr> 
						<?php }?>
				</tbody> 
			</table>
		</div>
	</div>

	<div id="planEditBox" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"></h4>
	      </div>
	      <div class="modal-body">
	        <div class="container-fluid">	
	        	<form id="editPlanForm">
	        		<table class="table table-bordered">
	        			<thead>
	        				<th>Fields</th>
	        				<th>Details</th>
	        			</thead>
	        			<tbody>
	        				<tr>
	        					<td>Plan Name</td>
	        					<td><input type="text" name="plan_name" class="form-control"></td>
	        				</tr>
	        				<tr>
	        					<td>Price</td>
	        					<td><input type="number" name="price" class="form-control"></td>
	        				</tr>
	        				<tr>
	        					<td>Validity</td>
	        					<td><input type="text" name="validity" class="form-control"></td>
	        				</tr>
	        				<tr>
	        					<td>Speed (In MBPS)</td>
	        					<td><input type="number" name="speed" class="form-control"></td>
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

	<script type="text/javascript">

		$('input[name=validity]').datepicker({
			dateFormat: 'dd-mm-yy'
		});
		var id = "";
		$('.planEdit').click(function(){
			id = $(this).attr('id');
			var obj = {id:id.split("_")[1]};
			$.ajax({
				url:'<?php echo base_url(); ?>get/getDataplan',
				type:'POST',
				data:obj,
				dataType:'json',
				success:function(as){
					
					$('input[name=plan_name]').val(as.data.plan_name);
					$('input[name=price]').val(as.data.price);
					$('input[name=validity]').val(as.data.validity);
					$('input[name=speed]').val(as.data.speed);
					$('#planEditBox').modal('show');
				}
			});
			
		});

		//Function for updating plan
		$("#editPlanForm").submit(function(event) {
		    event.preventDefault();
		}).validate({
		    rules: {
		     	plan_name: "required",
		     	price: "required"
		    },
		    submitHandler: function(form) { 
		    	
		        $.ajax({
		        	url:'<?php echo base_url(); ?>update/dataplan?id='+id.split("_")[1],
		        	type: 'POST',
	                data: new FormData( form ),
			        processData: false,
			        contentType: false,
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
		    }
		});

		//Function for deleting plans
		$('.delPlan').click(function(){
			id = $(this).attr('id');
			if (confirm("Do you really want to delete this plan ?") == true) {

				var obj = {id:id.split("_")[1]};
		        $.ajax({
		        	url:'<?php echo base_url(); ?>delete/deleteDataplan',
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