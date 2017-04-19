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
<?php 
	$customerDetails = $this->customer->getCustomerById($this->session->userdata('user_id'));
?>
<section id="main_mid_sec">
	<div class="mig_logsec">
	<div class="container">
	
		<div class="row">
		<div class="col-lg-24">
			<div class="sign_top">
				<h1>Hello "<?php echo $customerDetails->first_name; ?>"</h1>
				<p>Please manage your profile</p>
			</div>
			
			
		</div>
	</div>
	
	
	
	<div class="row">
		<div class="col-lg-24">
			<form id="editCustomerForm">
				
				
			<div class="up_info">
				<ul>
					<li>
						<div class="form-group">
                             <label for="exampleInputEmail1">First Name</label>
                             <input class="validate form-control" type="text" name="first_name"  value="<?php echo $customerDetails->first_name; ?>">
                        </div>
					</li>
					<li>
						<div class="form-group">
                             <label for="exampleInputEmail1">Last Name</label>
                             <input class="validate form-control" type="text" name="last_name"  value="<?php echo $customerDetails->last_name; ?>">
                        </div>
					</li>
					<li>
						<div class="form-group">
                             <label for="exampleInputEmail1">Address</label>
                             <input class="validate form-control" type="text" name="address"  value="<?php echo $customerDetails->address; ?>">
                        </div>
					</li>
					<li>
						<div class="form-group">
                             <label for="exampleInputEmail1">City</label>
                             <input class="validate form-control" type="text" name="city"  value="<?php echo $customerDetails->city; ?>">
                        </div>
					</li>
					<li>
						<div class="form-group">
                             <label for="exampleInputEmail1">State</label>
                             <input class="validate form-control" type="text" name="state"  value="<?php echo $customerDetails->state; ?>">
                        </div>
					</li>
					<li>
						<div class="form-group">
                             <label for="exampleInputEmail1">Pin Code</label>
                             <input class="validate form-control" type="text" name="pincode"  value="<?php echo $customerDetails->pincode; ?>">
                        </div>
					</li>
					<li>
						<div class="form-group">
                             <label for="exampleInputEmail1">Email Id</label>
                             <input class="validate form-control" type="text" name="email"  value="<?php echo $customerDetails->email; ?>">
                        </div>
					</li>
					<li>
						<div class="form-group">
                             <label for="exampleInputEmail1">Contact No.</label>
                             <input class="validate form-control" type="text" name="phone"  value="<?php echo $customerDetails->phone; ?>">
                        </div>
					</li>
					<li>
						<div class="form-group">
                             <label for="exampleInputEmail1">User Id</label>
                             <input class="validate form-control" type="text" name="customer_id" readonly="" value="<?php echo $this->session->userdata('user_id'); ?>">
                        </div>
					</li>
					<li>
						<div class="form-group">
                             <label for="exampleInputEmail1">Data Plan</label>
                             <input class="validate form-control" type="text" name="data_plan" readonly="" value="<?php echo $customerDetails->data_plan; ?>">
                        </div>
					</li>
				</ul>
			 
				
			
				<div class="form_below">
					<div class="frm_left" style="margin-left:20px;">
						<input type="submit" value="Save" class="up_save_btn" />
					</div>
				</div>
			
			
			
			
			</div>
			
			</form>
			
			<div class="up_issue" style="margin:0 0 30px 0;">
				Wants to pay your Bill??? <a href="#">Click here to pay</a>
			</div>
			<div class="up_issue" style="margin:0 0 30px 0;">
				<a href="#">Invoices</a>
			</div>
		
		
		</div>
	</div>
	
	
	
	</div>
</div>
	
</section>
<script>
$("#editCustomerForm").submit(function(event) {
    event.preventDefault();
}).validate({
    rules: {
     	first_name: "required",
     	last_name: "required"
    },
    submitHandler: function(form) { 
    	
        $.ajax({
        	url:'<?php echo base_url(); ?>update/customer?id=<?php echo $this->session->userdata('user_id'); ?>',
        	type: 'POST',
            data: new FormData( form ),
	        processData: false,
	        contentType: false,
            dataType:'json',
            success:function(as){
            	if(as.status == true){
            		alert("Profile Successfully updated");
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