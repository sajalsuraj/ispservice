<?php 
	$currentDate = date("Y-m-d G:i:s");
	$user = $_GET['user'];
?>
<script type="text/javascript">
	var user_id = "";
	$.ajax({
		url:'<?php echo base_url();?>get/checkExpirationTime',
		data:{user:'<?php echo $user; ?>'},
		type:'POST',
		dataType:'json',
		success:function(as){
			if(as.status == false){
				location.href = "<?php echo base_url();?>admin/error";
			}
			else if(as.status == true){
				user_id = as.data.user_id;
			}
		}
	});
</script>
<div class="container-fluid">
	<div class="col-md-12 heading">
		<h3>ABC iService Change Password</h3>
	</div>

	<div class="col-md-12">
			<div class="col-md-4 col-md-offset-4 form-style">
			<form id="changePass">
				<div class="form-group">
					<label>New Password:</label> 
					<input id="newpass" type="password" name="new_pass" class="form-control">
				</div>
				<div class="form-group">
					<label>Confirm Password:</label>
					<input type="password" name="re_pass" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-login">Submit</button>
				</div>
			</form>
		</div>	
	</div>
</div>
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
        	url:'<?php echo base_url(); ?>update/changepasswordSuperadmin',
        	type: 'POST',
            data: {pass:$('input[name=new_pass]').val(), id:user_id},
            dataType:'json',
            success:function(as){
            	if(as.status == true){
            		$.ajax({
			        	url:'<?php echo base_url(); ?>update/updateAdminHash',
			        	type: 'POST',
			            data: {id:user_id},
			            dataType:'json',
			            success:function(as){
			            	if(as.status == true){
			            		alert("Your password has been changed successfully");
			            		location.href="<?php echo base_url(); ?>admin/login";
			            	}
			            }
			        });
            	}
            }
        });
            	
    }
});
</script>