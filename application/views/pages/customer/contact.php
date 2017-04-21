<?php 
	
	if($this->session->has_userdata('type') == true){
		if($this->session->userdata('type') == "customer"){
			
		}
		else{
			redirect('customer/login');
		}
	}
	else{
		redirect('customer/login');
	}

?>  
<div class="container-fluid">
	<div class="col-md-12 menubar"> 
		<div class="menu fleft"><a href="home">Home</a></div>
		<div class="menu fleft btn-group">
			<a href="invoices">Invoices</a>
		</div>
		<div class="menu fleft"><a href="changepassword">Password Change</a></div>
		<div class="menu fleft btn-group">
			<a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Support</a>
			<ul class="dropdown-menu">
			    <li><a href="contact">Contact Us</a></li>
			</ul>
		</div>
		<div class="menu fleft"><a href="<?php echo base_url(); ?>user/logout">Logout</a></div>
	</div>

	<div class="col-md-12 heading">
		<h3>Submit your query</h3>
	</div>

	<div class="col-md-12">
		<div class="col-md-4 col-md-offset-4 form-style">
			<form id="createQuery">
				<div class="form-group">
					<label>Subject:</label>
					<input type="text" name="subject" class="form-control">
				</div>
				<div class="form-group">
					<label>Query:</label>
					<textarea name="query" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-login">Submit</button>
				</div>
			</form>
		</div>	
	</div>

	<script type="text/javascript">
		$('#createQuery').submit(function(event){
			event.preventDefault();
		}).validate({
		    rules: {
		     	subject: "required",
		     	query: "required"
		    },
		    submitHandler: function(form) {  
		    	$.ajax({
		    		url:'<?php echo base_url(); ?>add/createQuery',
		    		type:'POST',
		    		data: {subject:$('input[name=subject]').val(), query:$('textarea[name=query]').val()},
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
</div>