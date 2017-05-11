
<section id="home_banner">
    
                <div class="home_banplc">
                    <div class="ban_slider">
                        <!--own repeat-->
                        <!--single product in loop-->
                        <?php $getAllBanners = $this->admin->getAllBanners(); ?>
                        <?php foreach ($getAllBanners['result'] as $banner) {  ?>
                            <?php if($banner->status=="true"){ ?>
                        <div>
                            <div class="ban_rota_img">
                                <a href="#">
                                    <img src="<?php echo base_url(); ?>assets/resources/images/slider/<?php echo $banner->banner_img; ?>" alt="" />
                                </a> 
                            </div>
                        </div>  
                        <?php }} ?>
                        <!--ends here-->
                    </div>
                </div>
            
</section>

<section id="recent_ccie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="mscroll_section">
                    <div class="rece_head">News and<span>Events</span></div>
                    <div class="scroll_blck">
                        <div class="marquee" id="mycrawler">
                            <?php $getAllEvents = $this->admin->getAllEvents(); ?>
                            <?php foreach ($getAllEvents['result'] as $event) { ?>
                            <span><a href="#"><strong><?php echo $event->description; ?></a></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="main_mid_sec">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                    
            <div class="ip_plans_hm">
                <div class="sec_heading">Our Exclusive Internet Plans   <a href="#" class="view_all_btn">View all</a></div>
                
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
<div class="share_section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
            
            
                <div class="sec_heading">Please let me know the text here  </div>
                <div class="btm_smm_scr">
                        <div class="btm_five_add">
                                            <!--own repeat-->
                                            <!--single product in loop-->
                                    <?php $getAllBanners = $this->admin->getAllFooterBanners(); ?>
                                    <?php foreach ($getAllBanners['result'] as $banner) {  ?>
                                        <?php if($banner->status=="true"){ ?>
                                            <div>
                                                <div class="ban_rota_img">
                                                    <a href="#">
                                                        <img src="<?php echo base_url(); ?>assets/resources/images/footerslider/<?php echo $banner->banner_img; ?>" alt="" />
                                                    </a>
                                                </div>
                                            </div>  
                                            <!--ends here-->
                                    <?php }
                                        } 

                                    ?>
                                           
                        
                                    </div>
                </div>
                
            </div>
        </div>
            
            
    </div>
</div>
