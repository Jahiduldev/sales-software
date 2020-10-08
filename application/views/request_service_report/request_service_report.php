
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading" style="font-weight:bold; background:#F2682B; color:#fff;">
                        Complain Report 
                        <span class="tools pull-right">
                            
                        </span>
                    </header>
                    <div class="panel-body">
					
					<a href="<?php echo site_url('excel_complain');  ?>">  <button type="button" class="btn btn-default pull-right" style="font-weight:bold; background:white; color:Green; ">Others Export</button></a>
					
				
					 
						 
						 
						 <div class="row">
							<div class="col-lg-12">
								<form role="form" class="cmxform form-horizontal tasi-form" method="post"  id="RoleForm" action="<?php echo base_url();?>excel_only_complain/index">
									
									<div class="form-group">
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><?php echo(isset($err)?'<span style="color:red">From Date</span>':'From Date'); ?></label>
                                        <div class="col-lg-4">
                                            <input type="text" value="<?php echo(isset($fm)?$fm:''); ?>" class="default-date-picker form-control" placeholder="Enter From Date" id="date_from"  name="date_from">
                                        </div>
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">To Date</label>
                                        <div class="col-lg-4">
                                            <input type="text" value="<?php echo(isset($to)?$to:''); ?>" class="default-date-picker form-control" placeholder="Enter To Date" id="date_to"  name="date_to">
                                        </div>
                                    </div>
									
									
									<button type="submit" name="submitDate" class="btn btn-info pull-right" >Only Complete Export </button>
								</form>
							</div>
						</div>
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						<div class="row">
							<div class="col-lg-12">
								<form role="form" class="cmxform form-horizontal tasi-form" method="post"  id="RoleForm" action="<?php echo base_url();?>request_service_report/getProccessData">
									
									<div class="form-group">
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><?php echo(isset($err)?'<span style="color:red">From Date</span>':'From Date'); ?></label>
                                        <div class="col-lg-4">
                                            <input type="text" value="<?php echo(isset($fm)?$fm:''); ?>" class="default-date-picker form-control" placeholder="Enter From Date" id="date_from"  name="date_from">
                                        </div>
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">To Date</label>
                                        <div class="col-lg-4">
                                            <input type="text" value="<?php echo(isset($to)?$to:''); ?>" class="default-date-picker form-control" placeholder="Enter To Date" id="date_to"  name="date_to">
                                        </div>
                                    </div>
									
									<div class="form-group">
										<label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select A Proccess Type</label>
										<div class="col-lg-10">	
											<select class="form-control" name="type" required>
											
												<option value="">Select Proccess Type</option>
												<option <?php if(isset($type) && $type==0){echo 'Selected'; } ?> value="0">Not Assign Technitian</option>
												<option <?php if(isset($type) && $type==2){echo 'Selected'; } ?> value="2">Pending</option>
												<option <?php if(isset($type) && $type==3){echo 'Selected'; } ?> value="3">Reschedule</option>
												<option <?php if(isset($type) && $type==1){echo 'Selected'; } ?> value="1">Complete</option>											
											</select>
											
										</div>
										
									</div>
									<button type="submit" name="submitDate" class="btn btn-info pull-right" >Submit</button>
								</form>
							</div>
						</div>
						<br>
						
					     
                        
                        <div class="adv-table">
                            <table class="display table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="hidden-phone">SL</th>
                                        <th class="hidden-phone">CUSTOMER ID</th>
                                        <th>CUSTOMER NAME</th>
                                        <th class="hidden-phone">PHONE</th>
										<th class="hidden-phone">Type</th> 
                                        <th class="hidden-phone">STATUS</th>
                                        <th class="hidden-phone">INSTALL DATE</th>
                                        <?php if(isset($type) && $type!=1){ ?><th class="hidden-phone">REQUEST DATE</th><?php }else{ ?>
										<th class="hidden-phone">SERVICE DATE</th><?php }  ?>
                                        <?php if(isset($type) && $type!=1){ ?> <th class="hidden-phone">PRIORITY</th><?php } ?>                                         
										<th class="hidden-phone">Action</th> 
									</tr>
                                </thead>
                                <tbody id="" style="color:black;">
                                     <?php echo(isset($processData)?$processData:''); ?>
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
                <form class="cmxform form-horizontal tasi-form" id="addCompletedServiceForm"  role="form" method="post"  action="<?php echo site_url('request_service_report/addCompletedService');  ?>">

                    <input type="hidden" class="form-control"  id="req_id" name="req_id">
                    <input type="hidden" class="form-control"  id="ref_cus_id" name="ref_cus_id">

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Add notes about service *</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" placeholder="Enter Notes About Service" id="add_notes" name="add_notes"></textarea>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Filter Change </label>
                        <div class="col-lg-9">
                            <input type="checkbox" name="filter_change" id="filter_change"  value="1">

                        </div>
                    </div>
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
                <form class="cmxform form-horizontal tasi-form" id="addCompletedServiceForm"  role="form" method="post"  action="<?php echo site_url('request_service_report/removeCompletedService');  ?>">
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














