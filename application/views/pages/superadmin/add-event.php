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
		<h3>Add News</h3>
	</div>

	<div class="col-md-12">
		<div class="col-md-4 col-md-offset-4">
			<form id="addEvent">
				<div class="form-group">
					<label>Title</label>
					<input type="text" name="name" class="form-control">
				</div>
				<div class="form-group">
					<label>Description</label>
					<input type="text" name="description" class="form-control">
				</div>
				<div class="form-group">
					<label>Start Date</label>
					<input type="text" name="startDate" class="form-control">
				</div>
				<div class="form-group">
					<label>End Date</label>
					<input type="text" name="endDate" class="form-control">
				</div>
				<div class="form-group">
					<center><button type="submit" class="btn btn-plan">Add News</button></center>
				</div>
			</form>
		</div>
		<?php $getAllEvents = $this->admin->getAllEvents(); ?>
		<div class="col-md-12">
			<h4><u>List of all Events/News:</u></h4>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Event Title</th>
						<th>Description</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($getAllEvents['result'] as $event) { ?>
					<tr>
						<td><?php echo $event->name; ?></td>
						<td><?php echo $event->description; ?></td>
						<td><?php echo $event->startDate; ?></td>
						<td><?php echo $event->endDate; ?></td>
						<td><?php if($event->status == "true"){ echo "Enabled";}else{ echo "Disabled"; } ?></td>
						<td><?php if($event->status == "true"){ echo "<button id='disable_".$event->id."' class='btn btn-danger status'>Disable</button>";}else{ echo "<button id='enable_".$event->id."' class='btn btn-success status'>Enable</button>"; } ?>&nbsp;&nbsp;<button id="event_<?php echo $event->id; ?>" class="btn delEvent">Delete</button></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">

	$('input[name=startDate], input[name=endDate]').datepicker({
		dateFormat: 'dd-mm-yy'
	});

	$("#addEvent").submit(function(event) {
	    event.preventDefault();
	}).validate({
	    rules: {
	     name:"required",
	     description:"required",
	    },
	    submitHandler: function(form) { 
	    	
	        $.ajax({
	        	url:'<?php echo base_url(); ?>add/addEvent',
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
                    else if(as.status == false){
                    	alert(as.message);
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
	        	url:'<?php echo base_url(); ?>update/changeeventstatus',
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

	//Delete banner
	$('.delEvent').click(function(){  
		var id = $(this).attr('id');
		if (confirm("Do you really want to delete this Event/News ?") == true) {

			var obj = {id:id.split("_")[1]};
	        $.ajax({
	        	url:'<?php echo base_url(); ?>delete/deleteEvent',
	        	type: 'POST',
                data: obj,
                dataType:'json',
                success:function(as){
                	if(as.status == true){
                		alert(as.message);
                		location.reload();
                	}
                	else{
                		alert("Error while deleting");
                	}
                }
	        });
	    } else {
	        
	    }
	});
</script>
