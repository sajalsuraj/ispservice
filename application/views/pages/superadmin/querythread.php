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
<?php

	$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$pos = strrpos($url, '/');
	$id = $pos === false ? $url : substr($url, $pos + 1);

?>
<div class="container-fluid">
	<div class="col-md-12 menubar"> 
		<?php if($this->session->userdata('type') == "superadmin"){ ?>
		<div class="menu fleft"><a href="<?php echo base_url(); ?>admin/home">Home</a></div>
		<div class="menu fleft btn-group">
			<a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
			<ul class="dropdown-menu">
			    <li><a href="<?php echo base_url(); ?>admin/orderlist">Order List</a></li>
			    <li><a href="<?php echo base_url(); ?>admin/invoiceorderlist">Customer Invoice List</a></li>
			    <li><a href="<?php echo base_url(); ?>admin/customerlist">Customer List</a></li>
			    <li><a href="<?php echo base_url(); ?>admin/dataplan">Data Plan</a></li>
			    <li><a href="<?php echo base_url(); ?>admin/banner">HomePage Banner</a></li> 
			    <li><a href="<?php echo base_url(); ?>footer-banner">HomePage Footer Banner</a></li> 
			    <li><a href="<?php echo base_url(); ?>admin/add-event">Manage Events</a></li>  
			</ul>
		</div>
		<?php } ?>
		<div class="menu fleft"><a href="<?php echo base_url(); ?>admin/changepassword">Password Change</a></div>
		<?php if($this->session->userdata('type') == "superadmin"){ ?>
		<div class="menu fleft btn-group">
			<a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Support</a>
			<ul class="dropdown-menu">
			    <li><a href="<?php echo base_url(); ?>admin/queries">Queries</a></li>
			</ul>
		</div>
		<div class="menu fleft"><a href="<?php echo base_url(); ?>admin/add-admin">Create Sub-Admin</a></div>
		<?php } ?>
		<div class="menu fleft"><a href="<?php echo base_url(); ?>user/logout">Logout</a></div>
	</div>

	<?php $ticketDetail = $this->message->getCustomerdetail($id); ?>
	<div class="col-md-12">
		<div class="col-md-3 ticket-detail">
			<div class="row">Ticket ID - <?php echo $ticketDetail[0]->id; ?></div>
			<div class="row">Name - <?php echo $ticketDetail[0]->first_name." ".$ticketDetail[0]->last_name; ?></div>
			<div class="row">Subject - <?php echo $ticketDetail[0]->subject; ?></div>
			<div class="row"><?php if($ticketDetail[0]->status == "Open") { ?><a id="closeTicket" class="cursorpoint">Close this ticket</a> <?php } else if($ticketDetail[0]->status == "Closed") { ?>Status - Closed<?php } ?></div>
		</div>


		
		<div class="col-md-8">
			<?php $allMessages = $this->message->getMessages($id);?>
			<?php foreach($allMessages as $message){ ?>
			<div class="col-md-12 msg-box pad21">
			   <?php if($message->sender_type == "customer"){ ?>
				<img class="user-img fleft" src="<?php echo base_url(); ?>assets/images/<?php echo $message->profile_pic; ?>">
				<div class="fleft msg-upper">
					<span class="fleft user-name-query"><?php echo $message->first_name; ?></span>
					<span class="pull-right msg-date-time"><?php echo $message->created_at; ?></span>
				</div>
				
				<div class="fleft msg-upper msg-style"><?php echo $message->message; ?></div>
				<?php } else if($message->sender_type == "admin"){ ?>
					<img class="user-img fleft" src="<?php echo base_url(); ?>assets/images/avatar.png">
					<div class="fleft msg-upper">
						<span class="fleft user-name-query">Admin</span>
						<span class="pull-right msg-date-time"><?php echo $message->created_at; ?></span>
					</div>
					
					<div class="fleft msg-upper msg-style"><?php echo $message->message; ?></div>
				<?php } ?>
			</div>
			<?php } ?>

			<?php if($ticketDetail[0]->status == "Open") { ?>
			<div class="col-md-12 msg-box pad21">
				<form id="msgForm">
					<div class="form-group">
						<textarea name="message" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<button class="btn">Submit</button>
					</div>
				</form>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#msgForm').submit(function(event){
		event.preventDefault();
	}).validate({
	    rules: {
	     	message: "required"
	    },
	    submitHandler: function(form) {  
	    	$.ajax({
	    		url:'<?php echo base_url(); ?>add/createMessage',
	    		type:'POST',
	    		data: {ticket_id: '<?php echo $id; ?>', sender_type:'admin', message:$('textarea[name=message]').val()},
	    		dataType: 'json',
	    		success:function(as){
	    			if(as.status == true){
	    				
	    				location.reload();
	    			}
	    		}
	    	});
	    }
	});

	//Function to close ticket
	$('#closeTicket').click(function(){
		$.ajax({
    		url:'<?php echo base_url(); ?>update/ticket',
    		type:'POST',
    		data: {id: '<?php echo $id; ?>', status:"Closed"},
    		dataType: 'json',
    		success:function(as){
    			if(as.status == true){
    				alert(as.message);
    				location.reload();
    			}
    		}
    	});
	});
</script>