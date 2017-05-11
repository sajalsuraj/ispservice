<section id="main_mid_sec">
	<div class="mig_logsec">
	<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="sign_top">
				<h1>Our Exclusive Internet Plans </h1>
				<p>Join our one of our exclusive Internet plan and enjoy the connectivity around you.</p>
			</div>
			
			
		</div>
	</div> 
	
	<div class="row">
		
		<div class="col-xs-12">
			
			<section id="main_mid_sec">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
					
			<div class="ip_plans_hm">
				
				
				<div class="int_plans_list">
					<div class="row">
						<?php 
                        $allPlans = $this->dataplan->getAll();
                        
                        foreach ($allPlans['result'] as $plan) { ?>
	                        <div class="col-md-4">
	                            <div class="combo_block">
	                                <div class="combo_heading"><?php echo $plan->plan_name; ?></div>
	                                <div class="combo_des"><p><?php echo $plan->data; ?> GB, <?php echo $plan->download_speed; ?>MBPS, <?php echo $plan->validity; ?></p></div>
	                                <div class="combo_more"><a href="">Enquire Now</a></div>
	                            </div>
	                        </div>
	                    <?php } ?>
					</div>
				</div>
			
			</div>
			</div>
		</div>
	</div>	
</section>
			
		</div>
	</div>
</div>
</div>
	
</section>