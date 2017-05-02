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
<section id="main_mid_sec">
	<div class="mig_logsec">
		<div class="container">
		
			<div class="row">
				<div class="col-lg-24">
					<div class="sign_top">
						<h1>We are Here to help you</h1>
						<p>In case you need any help, create a query ticket here:</p>
					</div>
					
					
				</div>
			</div>

			<div class="row">
				<div class="col-lg-24">
					<form id="createQuery">	
						<div class="up_info">
							<ul>
								<li>
									<div class="form-group">
			                             <label for="exampleInputEmail1">Subject</label>
			                             <input class="validate form-control" type="text" name="subject" />
			                        </div>
								</li>
								<li>
									<div class="form-group">
			                             <label for="exampleInputEmail1">Problem Statement</label>
			                             <textarea class="validate form-control" name="description"></textarea>
			                        </div>
								</li>
									
							</ul>

							<div class="form_below">
								<div class="frm_left" style="margin-left:20px;">
									<input type="submit" value="Create Ticket" class="up_save_btn" />
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>	

	<div class="col-md-12">
		
		<div class="col-md-8 col-md-offset-2">
			<h3>Your Query Tickets:-</h3>
			<?php $allTickets = $this->customer->getAllTickets($this->session->userdata('customer_user_id'));?>
			<table class="table table-bordered">
				<thead> 
					<tr> 	 
						<th>Ticket ID</th> 
						<th>Subject</th>
						<th>Description</th>
						<th>Status</th> 
						<th>Created At</th> 
					</tr> 
				</thead> 
				<tbody>
					<?php foreach($allTickets as $ticket){ ?>
					<tr>
						<td><?php echo $ticket->id; ?></td>
						<td><a href="querythread/<?php echo $ticket->id; ?>"><?php echo $ticket->subject; ?></a></td>
						<td><?php echo $ticket->description; ?></td>
						<td><?php echo $ticket->status; ?></td>
						<td><?php echo $ticket->created_at; ?></td>
					</tr>
				    <?php } ?>
				</tbody>
			</table>
		</div>
	</div>

</section>
<script type="text/javascript">
	$('#createQuery').submit(function(event){
		event.preventDefault();
	}).validate({
	    rules: {
	     	subject: "required"
	    },
	    submitHandler: function(form) {  
	    	$.ajax({
	    		url:'<?php echo base_url(); ?>add/createQuery',
	    		type:'POST',
	    		data: {subject:$('input[name=subject]').val(), description:$('textarea[name=description]').val()},
	    		dataType: 'json',
	    		success:function(as){
	    			if(as.status == true){
	    				alert('Your query has been successfully submitted');
	    				location.reload();
	    			}
	    		}
	    	});
	    }
	});
</script>