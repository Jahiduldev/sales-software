<!--main content start-->

<?php 
	$uid = $this->session->userdata('user_id');
	$rol = $this->session->userdata('role_id'); if($rol==1) { 
	
	?>




		
		
		
		<section id="main-content">
    <section class="wrapper">
        <!--state overview start-->
        <div class="border-head">
            <h3><B>Customer Complain Manipulation</B></h3>
        </div>
        <div class="row state-overview">
           <div class="col-lg-6 col-sm-4">
                <a href="<?= base_url(); ?>service_details/complains_today_all">
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-tags"></i>
                        </div>
                        <div class="value">
                            <h1 class="">

                            </h1>
                            <p><B>Today Total Complain</B></p>
                            <?php $today = date('y-m-d');
								
							
								 
								$this->db->like('added_time',$today);
								$this->db->from('base_service_custom');
								$query = $this->db->get();
								$rowcount = $query->num_rows();
                            ?>

                          <p><B style="color:blue;"><h4><?= $rowcount ?></h4></B><a/></p>
                        </div>
                    </section>
                    </a>
            </div>

		   <div class="col-lg-6 col-sm-4">
                 <a href="<?= base_url(); ?>service_details/complains_all">
                <section class="panel">

                         <div class="symbol blue">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="value">
                        <h1 class="">

                        </h1>
                        <p><B>Total Complain</B></p>
                        <?php
						
						
							 
                            $this->db->from('base_service_custom');
							$query = $this->db->get();
							
							$rowcount = $query->num_rows();							
                        ?>

                        <p><B style="color:blue;"><h4><?= $rowcount ?></h4></B><a/></p>
                    </div>
                </section>
                     </a>
            </div>
            
         
        </div>
		<div class="border-head">
            <h3><B>Complete Pending Manipulation</B></h3>
        </div>
        <div class="row state-overview">
           <div class="col-lg-6 col-sm-4">
                <a href="<?= base_url(); ?>service_details/pendings_today_all">
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-tags"></i>
                        </div>
                        <div class="value">
                            <h1 class=" ">
                            </h1>
                            <p><B>Today Pending</B></p>
                            <?php 
							 $today = date('Y-m-d');
							 $queryRole = $this->db->query("SELECT * FROM base_service_custom WHERE (service_status=2 or service_status=3) and added_time like '$today%'");
							
							 $rowcount = $queryRole->num_rows();
                       
                            ?>
                          <p><B style="color:blue;"><h4><?=$rowcount?></h4></B><a/></p>
                        </div>
                    </section>
                    </a>
            </div>
		   
		   <div class="col-lg-6 col-sm-6">
                 <a href="<?= base_url(); ?>service_details/pendings_all">
                <section class="panel">

                         <div class="symbol blue">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="value">
                        <h1 class="">

                        </h1>
                        <p><B>Total Pending</B></p>
                        <?php
						
					
							$this->db->where('service_status',2);
							$this->db->or_where('service_status',3);
                            $this->db->from('base_service_custom');
							$query = $this->db->get();
							$rowcount = $query->num_rows();
							
                        ?>

                        <p><B style="color:blue;"><h4><?=$rowcount?></h4></B><a/></p>
                    </div>
                </section>
                     </a>
            </div>
            
		</div>
        <div class="border-head">
            <h3><B>Technical Manipulation</B></h3>
        </div>
        <div class="row state-overview">
            
            <div class="col-lg-6 col-sm-6">
                <a href="<?= base_url(); ?>service_details/technitians_today_all">
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-tags"></i>
                        </div>
                        <div class="value" style="padding-top: 7px;">
                            <h1 class=" ">
                            </h1>
                            <p><B>Today Total Technitian Assaign Pending</B></p>
                            <?php $today = date('y-m-d');
							
                            $this->db->where('service_status',2);
                            $this->db->like('added_time',$today);
                            $this->db->from('base_service_custom');
                            $query = $this->db->get();
                            $rowcount = $query->num_rows();
                            ?>
                          <p><B style="color:blue;"><h4><?=$rowcount?></h4></B><a/></p>
                        </div>
                    </section>
                    </a>
            </div>	

			<div class="col-lg-6 col-sm-6">
                 <a href="<?= base_url(); ?>service_details/technitians_all">
                <section class="panel">

                         <div class="symbol blue">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="value">
                        <h1 class="">

                        </h1>
                        <p><B>Total Technitian Assaign Pending</B></p>
                        <?php
						
						
							$this->db->where('service_status',2);
                            $this->db->from('base_service_custom');
							$query = $this->db->get();
							$rowcount = $query->num_rows();
							
                        ?>

                        <p><B style="color:blue;"><h4><?=$rowcount?></h4></B><a/></p>
                    </div>
                </section>
                     </a>
            </div>
            <!-- <div class="col-lg-6 col-sm-6">
                 <section class="panel">
                     <div class="symbol blue">
                         <i class="fa fa-bar-chart-o"></i>
                     </div>
                     <div class="value">
                         <h1 class=" count4">
                             0
                         </h1>
                         <p>Total Profit</p>
                     </div>
                 </section>
             </div>-->
        </div>
        	
		<div class="border-head">
			<h3><B>Reschedule Manipulation</B></h3>
        </div>
        <div class="row state-overview">
           <div class="col-lg-6 col-sm-6">
                <a href="<?= base_url(); ?>service_details/reschedules_today_all">
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-tags"></i>
                        </div>
                        <div class="value">
                            <h1 class=" ">
                            </h1>
                            <p><B>Today Total Reschedule</B></p>
                            <?php $today = date('Y-m-d');
							
                            $this->db->where('service_status',3);
                            $this->db->like('added_time',$today);
                            $this->db->from('base_service_custom');
                            $query = $this->db->get();
                            $rowcount = $query->num_rows();
                            ?>
                          <p><B style="color:blue;"><h4><?=$rowcount?></h4></B><a/></p>
                        </div>
                    </section>
                    </a>
           </div>
		   <div class="col-lg-6 col-sm-6">
                 <a href="<?= base_url(); ?>service_details/reschedules_all">
                <section class="panel">

                         <div class="symbol blue">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="value">
                        <h1 class="">

                        </h1>
                        <p><B>Total Reschedule</B></p>
                        <?php
						
							
							$this->db->where('service_status',3);
                            $this->db->from('base_service_custom');
							$query = $this->db->get();
							$rowcount = $query->num_rows();
							
                        ?>

                        <p><B style="color:blue;"><h4><?=$rowcount?></h4></B><a/></p>
                    </div>
                </section>
                     </a>
            </div>
            
		</div>	
		
        
            
		</div>
		
        <div class="row state-overview">
			<div class="col-lg-12 col-sm-12">
                
					<section class="panel">
                        <?php						
							$result='';
							$this->db->where('ref_type_id',2);
                            $this->db->from('base_employees');
							$query = $this->db->get();
							foreach($query->result() as $row){
								$result .='<div class="col-lg-6 col-sm-6" 
								style="background:#fff; padding:5px; border:1px solid">
								<form action="technitian_report/getDateSearch" method="post">';								
								$this->db->where('technitian',$row->em_id);
								$this->db->from('base_service_custom');
								$query2 = $this->db->get();
								$rowcount = $query2->num_rows();
								
								$result .= '<input type="hidden" name="proccess_type" value="2">
								<input type="hidden" name="technitian" value="'.$row->em_id.'">
								<input type="hidden" name="dashboard" value="1">
								<input type="submit" value="'.$row->employee_name.'" style="background: none;border: none;"> : 
								<strong>'.$rowcount.'</strong></form></div>';
							}							
                        ?>
                        <?= $result ?>                   
					</section>
                
            </div>
         
        </div>
         

    </section>
</section>
	<?php 
	
	}

	else if($rol==7) {  
?>

<section id="main-content">
    <section class="wrapper">
        <!--state overview start-->
      

        <div class="border-head">
            <h3><B>Customer Complain Manipulation</B></h3>
        </div>
        <div class="row state-overview">
            <div class="col-lg-6 col-sm-6">
                 <a href="add_service">
                <section class="panel">

                    <div class="symbol blue">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="value">
                        <h1 class="">

                        </h1>
                        <p><B>Total Complain</B></p>
                        <?php
						
							$this->db->where('added_by',$uid);
                            $this->db->from('base_service_custom');
							$query = $this->db->get();
							$rowcount = $query->num_rows();							
                        ?>
                        <p><B style="color:blue;"><h4><?=$rowcount?></h4></B><a/></p>
                    </div>
                </section>
                     </a>
            </div>
            <div class="col-lg-6 col-sm-6">
                <a href="add_service">
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-tags"></i>
                        </div>
                        <div class="value">
                            <h1 class=" ">

                            </h1>
                            <p><B>Today Total Complain</B></p>
                            <?php $today = date('y-m-d');
							$this->db->where('added_by',$uid);
                            $this->db->like('added_time',$today);
                            $this->db->from('base_service_custom');
                            $query = $this->db->get();
                            $rowcount = $query->num_rows();
                            ?>

                          <p><B style="color:blue;"><h4><?=$rowcount?></h4></B><a/></p>
                        </div>
                    </section>
                    </a>
            </div>
		</div>
		<div class="border-head">
            <h3><B>Technitian Manipulation</B></h3>
        </div>
        <div class="row state-overview">
			<div class="col-lg-12 col-sm-12">
                
					<section class="panel">
                        <?php						
							$result='';
							$this->db->where('ref_type_id',2);
                            $this->db->from('base_employees');
							$query = $this->db->get();
							foreach($query->result() as $row){
								$result .='<div class="col-lg-6 col-sm-6" 
								style="background:#fff; padding:5px; border:1px solid">
								<form action="technitian_report/getDateSearch" method="post">';								
								$this->db->where('technitian',$row->em_id);
								$this->db->from('base_service_custom');
								$query2 = $this->db->get();
								$rowcount = $query2->num_rows();
								
								$result .= '<input type="hidden" name="proccess_type" value="2">
								<input type="hidden" name="technitian" value="'.$row->em_id.'">
								<input type="hidden" name="dashboard" value="1">
								<input type="submit" value="'.$row->employee_name.'" style="background: none;border: none;"> : 
								<strong>'.$rowcount.'</strong></form></div>';
							}							
                        ?>
                        <?= $result ?>                   
					</section>
                
            </div>
          
        </div>
          
        </div>

     
		
		
	<?php } elseif($rol==3){ ?>
		
		
		
		<section id="main-content">
    <section class="wrapper">
        <!--state overview start-->
        <div class="border-head">
            <h3><B>Customer Complain Manipulation</B></h3>
        </div>
        <div class="row state-overview">
           <div class="col-lg-6 col-sm-6">
                <a href="<?= base_url(); ?>service_details/complains_today">
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-tags"></i>
                        </div>
                        <div class="value">
                            <h1 class="">

                            </h1>
                            <p><B>Today Total Complain</B></p>
                            <?php $today = date('y-m-d');
								
								$this->db->where('added_by', $uid);
								 
								$this->db->like('added_time',$today);
								$this->db->from('base_service_custom');
								$query = $this->db->get();
								$rowcount = $query->num_rows();
                            ?>

                          <p><B style="color:blue;"><h4><?= $rowcount ?></h4></B><a/></p>
                        </div>
                    </section>
                    </a>
            </div>

		   <div class="col-lg-6 col-sm-6">
                 <a href="<?= base_url(); ?>service_details/complains">
                <section class="panel">

                         <div class="symbol blue">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="value">
                        <h1 class="">

                        </h1>
                        <p><B>Total Complain</B></p>
                        <?php
						
							$this->db->where('added_by', $uid);
							 
                            $this->db->from('base_service_custom');
							$query = $this->db->get();
							
							$rowcount = $query->num_rows();							
                        ?>

                        <p><B style="color:blue;"><h4><?= $rowcount ?></h4></B><a/></p>
                    </div>
                </section>
                     </a>
            </div>
            
         
        </div>
		<div class="border-head">
            <h3><B>Complete Pending Manipulation</B></h3>
        </div>
        <div class="row state-overview">
           <div class="col-lg-6 col-sm-6">
                <a href="<?= base_url(); ?>service_details/pendings_today">
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-tags"></i>
                        </div>
                        <div class="value">
                            <h1 class=" ">
                            </h1>
                            <p><B>Today Total Complete Pending</B></p>
                            <?php $today = date('y-m-d');
							$this->db->where('added_by',$uid);
                            $this->db->where('service_status',2);
                            $this->db->or_where('service_status',3);
                            $this->db->like('added_time',$today);
                            $this->db->from('base_service_custom');
                            $query = $this->db->get();
                            $rowcount = $query->num_rows();
                            ?>
                          <p><B style="color:blue;"><h4><?=$rowcount?></h4></B><a/></p>
                        </div>
                    </section>
                    </a>
            </div>
		   
		   <div class="col-lg-6 col-sm-6">
                 <a href="<?= base_url(); ?>service_details/pendings">
                <section class="panel">

                         <div class="symbol blue">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="value">
                        <h1 class="">

                        </h1>
                        <p><B>Total Complete Pending</B></p>
                        <?php
						
							$this->db->where('added_by',$uid);
							$this->db->where('service_status',2);
							$this->db->or_where('service_status',3);
                            $this->db->from('base_service_custom');
							$query = $this->db->get();
							$rowcount = $query->num_rows();
							
                        ?>

                        <p><B style="color:blue;"><h4><?=$rowcount?></h4></B><a/></p>
                    </div>
                </section>
                     </a>
            </div>
            
		</div>
        <div class="border-head">
            <h3><B>Technical Manipulation</B></h3>
        </div>
        <div class="row state-overview">
            
            <div class="col-lg-6 col-sm-6">
                <a href="<?= base_url(); ?>service_details/technitians_today">
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-tags"></i>
                        </div>
                        <div class="value" style="padding-top: 7px;">
                            <h1 class=" ">
                            </h1>
                            <p><B>Today Total Technitian Assaign Pending</B></p>
                            <?php $today = date('y-m-d');
							$this->db->where('added_by',$uid);
                            $this->db->where('service_status',2);
                            $this->db->like('added_time',$today);
                            $this->db->from('base_service_custom');
                            $query = $this->db->get();
                            $rowcount = $query->num_rows();
                            ?>
                          <p><B style="color:blue;"><h4><?=$rowcount?></h4></B><a/></p>
                        </div>
                    </section>
                    </a>
            </div>	

			<div class="col-lg-6 col-sm-6">
                 <a href="<?= base_url(); ?>service_details/technitians">
                <section class="panel">

                         <div class="symbol blue">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="value">
                        <h1 class="">

                        </h1>
                        <p><B>Total Technitian Assaign Pending</B></p>
                        <?php
						
							$this->db->where('added_by',$uid);
							$this->db->where('service_status',2);
                            $this->db->from('base_service_custom');
							$query = $this->db->get();
							$rowcount = $query->num_rows();
							
                        ?>

                        <p><B style="color:blue;"><h4><?=$rowcount?></h4></B><a/></p>
                    </div>
                </section>
                     </a>
            </div>
            <!-- <div class="col-lg-6 col-sm-6">
                 <section class="panel">
                     <div class="symbol blue">
                         <i class="fa fa-bar-chart-o"></i>
                     </div>
                     <div class="value">
                         <h1 class=" count4">
                             0
                         </h1>
                         <p>Total Profit</p>
                     </div>
                 </section>
             </div>-->
        </div>
        	
		<div class="border-head">
			<h3><B>Reschedule Manipulation</B></h3>
        </div>
        <div class="row state-overview">
           <div class="col-lg-6 col-sm-6">
                <a href="<?= base_url(); ?>service_details/reschedules_today">
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-tags"></i>
                        </div>
                        <div class="value">
                            <h1 class=" ">
                            </h1>
                            <p><B>Today Total Reschedule</B></p>
                            <?php $today = date('y-m-d');
							$this->db->where('added_by',$uid);
                            $this->db->where('service_status',3);
                            $this->db->like('added_time',$today);
                            $this->db->from('base_service_custom');
                            $query = $this->db->get();
                            $rowcount = $query->num_rows();
                            ?>
                          <p><B style="color:blue;"><h4><?=$rowcount?></h4></B><a/></p>
                        </div>
                    </section>
                    </a>
           </div>
		   <div class="col-lg-6 col-sm-6">
                 <a href="<?= base_url(); ?>service_details/reschedules">
                <section class="panel">

                         <div class="symbol blue">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="value">
                        <h1 class="">

                        </h1>
                        <p><B>Total Reschedule</B></p>
                        <?php
						
							$this->db->where('added_by',$uid); 
							$this->db->where('service_status',3);
                            $this->db->from('base_service_custom');
							$query = $this->db->get();
							$rowcount = $query->num_rows();
							
                        ?>

                        <p><B style="color:blue;"><h4><?=$rowcount?></h4></B><a/></p>
                    </div>
                </section>
                     </a>
            </div>
            
		</div>	
		<div class="border-head">			
			<h3><B>Complete Services Manipulation</B></h3>
        </div>
        <div class="row state-overview">
           <div class="col-lg-6 col-sm-6">
                <a href="<?= base_url(); ?>service_details/complete_today">
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-tags"></i>
                        </div>
                        <div class="value">
                            <h1 class=" ">
                            </h1>
                            <p><B>Today Complete Services</B></p>
                            <?php $today = date('y-m-d');
							$this->db->group_by('service_date');
							$this->db->where('is_active',$uid); 
                            $this->db->where('service_date',$today);
                            $this->db->from('base_service_details');
                            $query = $this->db->get();
                            $rowcount = $query->num_rows();
                            ?>
                          <p><B style="color:blue;"><h4><?=$rowcount?></h4></B><a/></p>
                        </div>
                    </section>
                    </a>
           </div>
		   <div class="col-lg-6 col-sm-6">
                 <a href="<?= base_url(); ?>service_details/complete">
                <section class="panel">

                         <div class="symbol blue">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="value">
                        <h1 class="">

                        </h1>
                        <p><B>Total Complete Services</B></p>
                        <?php
						
							$this->db->group_by('service_date'); 
							$this->db->where('is_active',$uid); 
                            $this->db->where('service_date',$today);
                            $this->db->from('base_service_details');
							$query = $this->db->get();
							$rowcount = $query->num_rows();
							
                        ?>

                        <p><B style="color:blue;"><h4><?=$rowcount?></h4></B><a/></p>
                    </div>
                </section>
                     </a>
            </div>
            
        </div>    
           
         
		
		<?php }?>
		
		
      


    </section>
</section>
<!--main content end-->