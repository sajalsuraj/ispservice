<?php 
	$currentDate = date("Y-m-d G:i:s");
	if(!isset($_GET['user'])){
		header('Location: ' . base_url().'admin/error', false, 302);
  		exit; // Ensures, that there is no code _after_ the redirect executed
	}
	$user = preg_replace('/\s/', '+', $_GET['user']);
?>
<script type="text/javascript">
	var user_id = "";
	$.ajax({
		url:'<?php echo base_url();?>get/checkCustomerExpirationTime',
		data:{user:'<?php echo $user; ?>'},
		type:'POST',
		dataType:'json',
		success:function(as){
			console.log(as);
			if(as.status == false){
				location.href = "<?php echo base_url();?>error";
			}
			else if(as.status == true){
				user_id = as.data.customer_id;
			}
		}
	});
</script>
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
        	url:'<?php echo base_url(); ?>update/changepasswordCustomer',
        	type: 'POST',
            data: {pass:$('input[name=new_pass]').val(), id:user_id},
            dataType:'json',
            success:function(as){
            	if(as.status == true){
            		$.ajax({
			        	url:'<?php echo base_url(); ?>update/updateCustomerHash',
			        	type: 'POST',
			            data: {id:user_id},
			            dataType:'json',
			            success:function(as){
			            	if(as.status == true){
			            		alert("Your password has been changed successfully");
			            		location.href="<?php echo base_url(); ?>login";
			            	}
			            }
			        });
            	}
            }
        });
            	
    }
});
</script>