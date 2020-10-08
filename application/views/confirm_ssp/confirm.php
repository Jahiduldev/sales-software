<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height" style="width:auto;">


        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading" style="font-weight:bold; background:#F2682B; color:#fff;">
                        Add Completed  Service
                        <span class="tools pull-right">
                           <!--  <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a> -->
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class="advtable">
                            <table class="display table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>C_ID</th>
                                        <th>INS.DATE</th>
                                        <th>C_NAME</th>
                                        <th>PHONE</th>
                                        <th>SALES BY</th>
                                        <th>Install BY</th>
                                        <th>ZONE</th>
                                        <th>Action</th>							
                                    </tr>
                                </thead>
                                <tbody style='color:black;'>

                                    <?php $sl=1; 
									foreach ($get_base_service_custom_data as $row):                                        
										

                                    ?>
                                    <tr class="">
										<td class=""><?php echo $sl; ?></td>
                                        <td class=""><?php echo $row->client_code; ?></td>
										<td class=""><?php echo $row->install_date; ?></td>
										<td class=""><?php echo $row->client_name; ?></td>
										<td class=""><?php echo $row->client_phone; ?></td>
										<td class=""><?php echo $row->saler; ?></td>
										<td class=""><?php echo $row->installer; ?></td>
										<td class=""><?php echo $row->area_name; ?></td>										
										<td>
                                            <button style="background: red; color:white;" class="btn btn-xs" onclick="addModal('<?= $row->ci_id; ?>');">
											<i class="fa fa-pencil"><strong>Upadte</strong></i></button>
                                             
                                        </td>
                                    </tr>

                                    <?php $sl++; 
									endforeach;  ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </section>
            </div>
        </div>




    </section>
</section>
<!--main content end-->



<!-- Modal -->
<div class="modal fade" id="myModalADD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Service Confirmation</h4>
            </div>

            <div class="modal-body">
			
				<div id="basicInfo" style="display:none">	
									
					<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Client Info :</label>
					<div class="col-lg-9">
						<strong class="col-md-12 col-lg-12"><span id="client_id"  class=""></span>,
						<span id="add_customer_name"  class=""></span>,
						<span id="add_mobile_number"></span></strong>						
					</div><div class="clearfix"></div>	<hr style="margin:5px 0px;">				
					<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Client Address :</label>
					<div class="col-lg-9">
						<strong><span id="add_client_address"  class="col-md-9 col-lg-9"></span></strong>
					</div><div class="clearfix"></div><hr style="margin:5px 0px;">
					<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Sales By :</label>
					<div class="col-lg-9">
						<strong><span id="add_sales_by"  class="col-md-9 col-lg-9"></span></strong>
					</div><div class="clearfix"></div><hr style="margin:5px 0px;">
					<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Install By :</label>
					<div class="col-lg-9">
						<strong><span id="add_install_by"  class="col-md-9 col-lg-9"></span></strong>
					</div><div class="clearfix"></div><hr style="margin:5px 0px;">
					<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Tech Zone :</label>
					<div class="col-lg-9">
						<strong><span id="add_tech_zone"  class="col-md-9 col-lg-9"></span></strong>
					</div><div class="clearfix"></div><hr style="margin:5px 0px;">
					<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Machine Status :</label>
					<div class="col-lg-9">
						<strong><span id="add_status_number"  class="col-md-9 col-lg-9"></span></strong>
					</div><div class="clearfix"></div><hr style="margin:5px 0px;">
					<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Filter Status :</label>
					<div class="col-lg-9">
						<strong><span id="add_filterStatus_number"  class="col-md-9 col-lg-9"></span></strong>
					</div><div class="clearfix"></div>
				
				</div>	
			
			
			
                <form class="cmxform form-horizontal tasi-form" id="addCompletedServiceForm"  role="form" method="post"  
				action="<?php echo site_url('confirm/re_addCompletedService');  ?>">
					<div class="form-group"></div>
                    
					<input type="hidden" class="form-control"  id="req_id" name="req_id">
                    
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">service Status *</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="service_complete_type" onchange="serviceStatus(this.value)">
								<option>Select Status</option>
								<option value="1">Done</option>
								<option value="2">Re-Schedule</option>
							</select>

                        </div>
                    </div>
					
					<div id="reschudule" style="display:none">						
					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Install By *</label>
                        <div class="col-lg-9">                            
							<select class="form-control" name="add_install" required>
								<option value="">Select Installer</option>								
								<?php
									$this->db->where('ref_type_id', 2);
                                    $this->db->where('is_active', 1);
									
									$technitian = $this->db->get('base_employees');
                                    foreach ($technitian->result() as $techs){ 
										if($techs->employee_name!='')
										echo '<option value="'. $techs->em_id .'">'. $techs->employee_name .'</option>';										
									}									
								?>								
							</select>
                        </div>
                    </div>						
					<div class="form-group" id="">
                        <label for="" class="col-sm-3 control-label col-lg-3">Install Date *</label>
                        <div class="col-lg-9">
                            <input type="text" name="install_date" id="add_request_date" class="form-control form-control-inline input-medium default-date-picker">

                        </div>
                    </div>					
				</div>	
					
					<br>
                    <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-3">
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- modal -->



<!-- Modal -->
<div class="modal fade" id="myModalRemove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Remove Service Confirmation</h4>
            </div>

            <div class="modal-body">
                <form class="cmxform form-horizontal tasi-form" id="addCompletedServiceForm"  role="form" method="post"  action="<?php echo site_url('add_completed_service/removeCompletedService');  ?>">
                    <input type="hidden" class="form-control"  id="req_id_remove" name="req_id_remove">
                    <input type="hidden" class="form-control"  id="ref_cus_id_remove" name="ref_cus_id_remove">
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-12 control-label col-lg-12">Do you want to remove this service? </label>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-3">
                            <button type="submit" class="btn btn-info pull-right">Yes</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- modal -->


</section>
</section>
<!--main content end-->














