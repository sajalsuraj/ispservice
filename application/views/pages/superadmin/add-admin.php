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
		<?php if($this->session->userdata('type') == "superadmin"){ ?>
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
		<h3>Add a new admin</h3>
	</div>

	<div class="col-md-12">
		<div class="col-md-4 col-md-offset-4">
			<form id="addAdminForm">
				<div class="form-group">
					<label>First name</label>
					<input type="text" name="first_name" class="form-control">
				</div>
				<div class="form-group">
					<label>Last name</label>
					<input type="text" name="last_name" class="form-control">
				</div>
				<div class="form-group">
					<label>Photo</label>
					<input type="file" name="profile_pic" />
				</div>
				<div class="form-group">
					<label>Email ID</label>
					<input type="email" name="email_id" class="form-control">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control">
				</div>
				<div class="form-group">
					<label>Company</label>
					<input type="text" name="company" class="form-control">
				</div>
				<div class="form-group">
					<label>Mobile number</label>
					<input type="number" name="mobile" class="form-control">
				</div>
				<div class="form-group">
					<label>Address</label>
					<textarea name="address" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label>City</label>
					<input type="text" name="city" class="form-control">
				</div>
				<div class="form-group">
					<label>State</label>
					<input type="text" name="state" class="form-control">
				</div>
				<div class="form-group">
					<label>Pincode</label>
					<input type="number" name="pincode" class="form-control">
				</div>
				<div class="form-group">
					<label>Admin Type</label>
					<select class="form-control" name="type">
						<option value="superadmin" selected>Superadmin</option>
						<option value="subadmin">Subadmin</option>
					</select>
				</div>
				<div class="form-group">
					<center><button type="submit" class="btn btn-plan">Add Admin</button></center>
				</div>
			</form>
		</div>
	</div> 

	<div class="col-md-12">
		<h4><u>List of Superadmins/Admins:</u></h4>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Admin ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Image</th>
						<th>Email ID</th>
						<th>Phone</th>
						<th>Address</th>
						<th>City</th>
						<th>State</th>
						<th>Type</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $allAdmins = $this->admin->getAllAdmin(); ?>
					<?php foreach ($allAdmins['result'] as $admin) { ?> 
					<tr>
						<td><?php echo $admin->user_id; ?></td>
						<td><?php echo $admin->first_name; ?></td>
						<td><?php echo $admin->last_name; ?></td>
						<td><?php if($admin->profile_pic != ""){ ?><a href="<?php echo base_url() ?>assets/images/<?php echo $admin->profile_pic; ?>" target="_blank">View</a><?php } else{ echo "No Image";} ?></td>
						<td><?php echo $admin->email_id; ?></td>
						<td><?php echo $admin->mobile; ?></td>
						<td style="width: 12%;"><?php echo $admin->address; ?></td>
						<td><?php echo $admin->city; ?></td>
						<td><?php echo $admin->state; ?></td>
						<td><?php echo $admin->type; ?></td>
						<td><?php if($admin->status == "true"){ echo "Enabled";}else{ echo "Disabled"; } ?></td>
						<td><?php if($admin->status == "true"){ echo "<button id='disable_".$admin->user_id."' class='btn btn-danger status'>Disable</button>";}else{ echo "<button id='enable_".$admin->user_id."' class='btn btn-success status'>Enable</button>"; } ?>&nbsp;&nbsp;<button id="editAdmin_<?php echo $admin->user_id; ?>" class="btn editAdmin">Edit</button> &nbsp;&nbsp;<button id="event_<?php echo $admin->user_id; ?>" class="btn delAdmin">Delete</button></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
	</div>
</div>

<div id="adminEditBox" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid editcustbox">	
        	<form id="editAdminForm" enctype="multipart/form-data">
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
        					<td>Admin Image</td>
        					<td><input type="file" name="profile_pic" class="form-control"><a id="profile_pic"></a></td>
        				</tr>
        				<tr>
        					<td>Email ID</td>
        					<td><input type="email" name="email_id" class="form-control"></td>
        				</tr>
        				<tr>
        					<td>Company</td>
        					<td><input type="text" name="company" class="form-control"></td>
        				</tr>
        				<tr>
        					<td>Phone</td>
        					<td><input type="number" name="mobile" class="form-control"></td>
        				</tr>
        				<tr>
        					<td>Address</td>
        					<td><textarea class="form-control" name="address"></textarea></td>
        				</tr>
        				<tr>
        					<td>City</td>
        					<td><input type="text" name="city" class="form-control"></td>
        				</tr>
        				<tr>
        					<td>State</td>
        					<td><input type="text" name="state" class="form-control"></td>
        				</tr>
        				<tr>
        					<td>Pincode</td>
        					<td><input type="number" name="pincode" class="form-control"></td>
        				</tr>
        				<tr>
        					<td>Type</td>
        					<td>
        						<select class="form-control" name="type">
        							<option value="superadmin">Superadmin</option>
        							<option value="subadmin">Subadmin</option>
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

<script type="text/javascript">
	
	$("#addAdminForm").submit(function(event) {
	    event.preventDefault();
	}).validate({
	    rules: {
	     name:"required",
	     email_id:"required"
	    },
	    submitHandler: function(form) { 
	    	
	        $.ajax({
	        	url:'<?php echo base_url(); ?>add/addAdmin',
	        	type: 'POST',
                data: new FormData( form ),
		        processData: false,
		        contentType: false,
                dataType:'json',
                success:function(as){
                	
                	if(as.status == true){
                		alert("Admin added");
                		location.reload();
                	}
                    else if(as.status == false){
                    	alert("Admin Not added");
                    }
                }
	        });
	    }
	});

	//Function to update the status
	$('.status').click(function(){
		var detail = $(this).attr('id'), status = "", id = "";
		if(detail.split('_')[0] == "enable"){
			status = "true";
		}
		else if(detail.split('_')[0] == "disable"){
			status = "false";
		}

		var obj = {id:detail.split('_')[1], status:status};
		$.ajax({
	        	url:'<?php echo base_url(); ?>update/changeadminstatus',
	        	type: 'POST',
                data: obj,
		        dataType:'json',
                success:function(as){
                	if(as.status == true){
                		alert(as.message);
                		location.reload();
                	}
                    else if(as.status == false){
                    	alert(as.message);
                    }
                }
	        });
	});

	//Edit Admin
	var adminId = "";
	$('.editAdmin').click(function(){
		eventId = $(this).attr('id');
		var obj = {id:eventId.split("_")[1]};
	        $.ajax({
	        	url:'<?php echo base_url(); ?>get/getAdminById',
	        	type: 'POST',
                data: obj,
                dataType:'json',
                success:function(as){
                	$('#editAdminForm input[name=first_name]').val(as.data.first_name);
                	$('#editAdminForm input[name=last_name]').val(as.data.last_name);
                	$('#editAdminForm input[name=email_id]').val(as.data.email_id);
                	$('#editAdminForm input[name=company]').val(as.data.company);
                	$('#editAdminForm input[name=mobile]').val(as.data.mobile);
                	$('#editAdminForm textarea[name=address]').val(as.data.address);
                	$('#editAdminForm input[name=city]').val(as.data.city);
                	$('#editAdminForm input[name=state]').val(as.data.state);
                	$('#editAdminForm input[name=pincode]').val(as.data.pincode);
                	$('#editAdminForm select[name=type]').val(as.data.type);

                	if(as.data.profile_pic != ""){
						$('#profile_pic').attr('href', '<?php echo base_url()."assets/images/" ?>'+as.data.profile_pic);
						$('#profile_pic').html('See Current Image');
					}
					else{
						$('#profile_pic').attr('href','');
						$('#profile_pic').html('');
					}
                	$('#adminEditBox').modal({backdrop: 'static', keyboard: false});
                	$('#adminEditBox').modal('show');
                	
                }
	        });
	});

	//Function for updating customer 
	$("#editAdminForm").submit(function(event) {
	    event.preventDefault();
	}).validate({
	    rules: {
	     	first_name: "required",
	     	last_name: "required"
	    },
	    submitHandler: function(form) { 
	    	
	        $.ajax({
	        	url:'<?php echo base_url(); ?>update/admin?id='+eventId.split("_")[1],
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
</script>