<?php 
	
	if($this->session->has_userdata('type') == true){
		if($this->session->userdata('type') == "customer"){
			
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
						<p>In case you need any query, fill the form given below:</p>
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
									<div class="form-group con_area">
			                             <label for="exampleInputEmail1">Your Query </label>
			                              <textarea class="con_area validate form-control" name="query"></textarea>
			                        </div>
								</li>	
							</ul>

							<div class="form_below">
								<div class="frm_left" style="margin-left:20px;">
									<input type="submit" value="Submit" class="up_save_btn" />
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>	
</section>
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