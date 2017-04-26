<?php 
	
	if($this->session->has_userdata('customer_type') == true){
		if($this->session->userdata('customer_type') == "customer"){
			
		}
		else{
			redirect('login'); 
		}
	}
	else{
		redirect('login');
	}

?>
<?php

	$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$pos = strrpos($url, '/');
	$id = $pos === false ? $url : substr($url, $pos + 1);

?>
<div class="col-md-12" style="min-height:550px;">
	<?php $ticketDetail = $this->message->getCustomerdetail($id); ?>
	<div class="col-md-3 ticket-detail">
		<div class="row">Ticket ID - <?php echo $ticketDetail[0]->id; ?></div>
		<div class="row">Name - <?php echo $ticketDetail[0]->first_name." ".$ticketDetail[0]->last_name; ?></div>
		<div class="row">Subject - <?php echo $ticketDetail[0]->subject; ?></div>
		<div class="row">Status - <?php echo $ticketDetail[0]->status; ?></div>
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
				<img class="user-img fleft" src="<?php echo base_url(); ?>assets/images/<?php echo $message->profile_pic; ?>">
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
	    		data: {ticket_id: '<?php echo $id; ?>', sender_type:'customer', message:$('textarea[name=message]').val()},
	    		dataType: 'json',
	    		success:function(as){
	    			if(as.status == true){
	    				
	    				location.reload();
	    			}
	    		}
	    	});
	    }
	});
</script>