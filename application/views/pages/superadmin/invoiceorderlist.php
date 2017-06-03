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
		<div class="menu fleft"><a href="home">Home</a></div>
		<div class="menu fleft btn-group"> 
			<a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
			<ul class="dropdown-menu">
			    <li><a href="orderlist">Order List</a></li>
			    <li><a href="invoiceorderlist">Customer Invoice List</a></li>
			    <li><a href="customerlist">Customer List</a></li>
			    <li><a href="dataplan">Data Plan</a></li>
			    <li><a href="banner">HomePage Banner</a></li> 
			    <li><a href="footer-banner">HomePage Footer Banner</a></li> 
			    <li><a href="add-event">Manage Events</a></li> 
			</ul>
		</div>
		<div class="menu fleft"><a href="changepassword">Password Change</a></div>
		<div class="menu fleft btn-group">
			<a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Support</a>
			<ul class="dropdown-menu">
			    <li><a href="queries">Queries</a></li>
			</ul>
		</div>
		<div class="menu fleft"><a href="add-admin">Create Sub-Admin</a></div>
		<div class="menu fleft"><a href="<?php echo base_url(); ?>user/logout">Logout</a></div>
	</div>

	<div class="col-md-12 heading">
		<h3>AuthorStream Invoices</h3>
	</div> 

	<div class="col-md-12">
		<div class="col-md-12 custList">
			<div class="col-md-6 col-md-offset-3"> 
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td>Date:</td>
							<td><input id="date" readonly="" type="text" name="" class="form-control"></td>
							<td>
								<select class="form-control">
										
								</select>
							</td> 
						</tr>
						<tr>
							<td colspan="3">
								<center><a id="getPDF" class="btn btn-invoice">Submit</a></center>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<table class="table table-bordered">
			<thead>
				<th>Customer ID</th>
				<th>Invoice No</th>
				<th>Amount (INR)</th>
				<th>Service Tax</th>
				<th>Due Date</th>
				<th>Action</th>
			</thead>
			<tbody>
				<tr id="invoiceField">
					
				</tr>
			</tbody>
		</table>
	</div>

	<script type="text/javascript">

		var date = new Date();
		var month = date.getMonth()+1;
		var year = date.getFullYear();

		function updateInvoices(month, year){
			$.ajax({
				url:'<?php echo base_url(); ?>update/invoicestatus',
				data:{month:month, year:year},
				type:'POST',
				dataType:'json',
				success:function(as){
					
					getInvoices(month, year);

				}
			});
		}

		function getInvoices(month, year){
			$.ajax({
				url:'<?php echo base_url(); ?>get/getInvoices',
				data:{month:month, invoice_status:"Active", year:year},
				type:'POST',
				dataType:'json',
				success:function(as){
					console.log(as);
					var option = "";
					if(as.status == true){
						option = "";
						for(var i = 0; i < as.data.length;i++){
							option += '<option value="'+as.data[i].invoice_no+'">'+as.data[i].customer_id+'-'+as.data[i].first_name+'</option>';
						}
						$('select').html(option);
					}
					else if(as.status == false){
						$('select').html('');
					}

				}
			});
		}

		updateInvoices(month, year);
		
		$('#date').datepicker({
			dateFormat: 'yy-mm',
		    changeMonth: true,
		    changeYear: true,
			onSelect: function(dateText, inst) {
						var yearMonth = $(this).val();
				      	month = yearMonth.split('-')[1];
				      	year = yearMonth.split('-')[0];
				      	updateInvoices(month, year);
				      }
		}).datepicker("setDate", new Date());

		$('#getPDF').click(function(){
			if($('select').val() == null){
				alert('No order selected');
			}
			else{
				
				$.ajax({
					url:'<?php echo base_url(); ?>get/getorder',
					data:{id:$('select').val()},
					type:'POST',
					dataType:'json',
					success:function(as){
						
						
						var invoiceField = "";
						invoiceField += '<td>'+as.data.circuit_id+'</td>';
						invoiceField += '<td>'+as.data.invoice_no+'</td>';
						invoiceField += '<td>'+as.data.total_amount+'</td>';
						invoiceField += '<td>'+as.data.service_tax+'</td>';
						invoiceField += '<td>'+as.data.next_payment_date+'</td>';
						invoiceField += '<td><a class="btn btn-invoice" href="<?php echo base_url()."invoice/generate?invoice_no=" ?>'+as.data.invoice_no+'">Download PDF</a></td>';

						$('#invoiceField').html(invoiceField);
					}
				});
			}
		});
	</script>
</div>