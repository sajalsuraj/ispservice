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
		<h3>Add Banner</h3>
	</div>

	<div class="col-md-12">
		<div class="col-md-4 col-md-offset-4">
			<form id="addBanner">
				<div class="form-group">
					<label>Upload Banner Image</label>
					<input type="file" name="banner_img" class="form-control">
				</div>
				<div class="form-group">
					<center><button type="submit" class="btn btn-plan">Add Banner</button></center>
				</div>
			</form>
		</div>
		<?php $getAllBanners = $this->admin->getAllBanners(); ?>
		<div class="col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Banner ID</th>
						<th>Banner Image</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($getAllBanners['result'] as $banner) { ?>
					<tr>
						<td><?php echo $banner->id; ?></td>
						<td><a href="<?php echo base_url().'assets/resources/images/slider/'. $banner->banner_img; ?>" target="_blank"><?php echo $banner->banner_img; ?></a></td>
						<td><?php if($banner->status == "true"){ echo "Enabled";}else{ echo "Disabled"; } ?></td>
						<td><?php if($banner->status == "true"){ echo "<button id='disable_".$banner->id."' class='btn btn-danger status'>Disable</button>";}else{ echo "<button id='enable_".$banner->id."' class='btn btn-success status'>Enable</button>"; } ?>&nbsp;&nbsp;<button id="banner_<?php echo $banner->id; ?>" class="btn delBanner">Delete</button></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#addBanner").submit(function(event) {
	    event.preventDefault();
	}).validate({
	    rules: {
	     banner_img:"required"
	    },
	    submitHandler: function(form) { 
	    	
	        $.ajax({
	        	url:'<?php echo base_url(); ?>add/addBanner',
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
	        	url:'<?php echo base_url(); ?>update/changebannerstatus',
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
	$('.delBanner').click(function(){  
		var id = $(this).attr('id');
		if (confirm("Do you really want to delete this Banner ?") == true) {

			var obj = {id:id.split("_")[1]};
	        $.ajax({
	        	url:'<?php echo base_url(); ?>delete/deleteBanner',
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
