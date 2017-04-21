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
		<div class="col-xs-12">
			<div class="sign_top">
				<h1>Change your Password</h1>
				<p>You can change your password by entering the fields given below:</p>
			</div>	
		</div>
	</div>
	
	<div class="row">
		
		<div class="col-xs-24">
			
			<div class="cus_log">
				<form id="changePass">
					<ul>
						<li>
							<input type="password" name="old_pass" placeholder="Current Password" class="ipfield" />
						</li>
						<li>
							<input type="password" id="newpass" name="new_pass" placeholder="New Password" class="ipfield" />
						</li>
						<li>
							<input type="password" name="re_pass" placeholder="Re-Type Password" class="ipfield" />
						</li>
						
						<li>
							<input type="submit" value="Submit" class="sign_in_btn"/>
						</li>
					</ul>
				</form>
			</div>
			
		</div>
	</div>
</div>
</div>
	
</section>
<script>
$("#changePass").submit(function(event) {
    event.preventDefault();
}).validate({
    rules: {
     	old_pass: "required",
     	new_pass : {
            minlength : 5,
            required:true
        },
        re_pass : {
            minlength : 5,
            required:true,
            equalTo : "#newpass"
        }
    },
    submitHandler: function(form) {   
    	
        $.ajax({
        	url:'<?php echo base_url(); ?>get/checkCustomerpass',
        	type: 'POST',
            data: {oldpass:$('input[name=old_pass]').val(), id:"<?php echo $this->session->userdata('user_id') ?>"},
            dataType:'json',
            success:function(as){
            	if(as.data == "FALSE"){
            		alert("Wrong Old Password");
            	}
            	else if(as.data == "TRUE"){
            		$.ajax({
			        	url:'<?php echo base_url(); ?>update/changepasswordCustomer',
			        	type: 'POST',
		                data: {pass:$('input[name=new_pass]').val(), id:"<?php echo $this->session->userdata('user_id') ?>"},
		                dataType:'json',
		                success:function(as){
		                	if(as.status == true){
		                		alert(as.message);
		                		location.reload();
		                	}
		                }
			        });
            	}
            }
        });
    }
});
</script>