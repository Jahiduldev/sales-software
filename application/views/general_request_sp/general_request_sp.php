<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height" style="width:auto;">


        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading" style="font-weight:bold; background:#F2682B; color:#fff;">
                        View NSP
                        <?php 
                        $role = $this->session->userdata('role_id');
                        if($role==1):
                         ?>
                         <a href="<?site_url('excel_nsp')?>" class="pull-right"><b></b></a>
                         <?php endif;  ?>
                    </header>
                    <div class="panel-body">
						
						<div class="row">
                            <div class="col-lg-12">

                                <form role="form" class="cmxform form-horizontal tasi-form" method="post"  id="RoleForm" action="#">
                                    <div class="form-group">
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">From Date</label>
                                        <div class="col-lg-4">
                                            <input required type="text" class="default-date-picker form-control" placeholder="Enter From Date" id="date_from"  name="date_from"  required>
                                        </div>
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">To Date</label>
                                        <div class="col-lg-4">
                                            <input required type="text" class="default-date-picker form-control" placeholder="Enter To Date" id="date_to"  name="date_to"  required>
                                        </div>
                                    </div>
                                    <button type="button" name="submitDate" class="btn btn-info pull-right" onclick="getDateSearch()">Submit</button>
                                </form>


                            </div>
                        </div>
                        <br>


                        <div class="adv-table">
                            <table class="display table table-bordered" id="myTable"> <!--hidden-table-info   -->
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>C_ID</th>
                                        <th>INS.DATE</th>
                                        <th>C_NAME</th>
                                        <th>PHONE</th>
                                        <th>ADDRESS</th>                                       
                                        <th>Default</th> 
                                        <th>STATUS</th>
                                        <th>ZONE</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
								<tbody id="dateTable" style="color:black;">
									<?php echo $getSp; ?>
								</tbody>
                            </table>
                        </div>

                    </div>
                </section>
            </div>
        </div>



    <!--    <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Send Sms To All
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body">

                        <form class="cmxform form-horizontal tasi-form" id="addCustomerForm"  role="form" method="post"  action="<?php echo site_url('general_request/sendSms');  ?>">


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Sms Box *</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Text" id="sms" name="sms" required></textarea>

                                </div>
                            </div>

                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>


                    </div>
                </section>
            </div>
        </div> -->





    </section>
</section>
<!--main content end-->

<!-- Modal -->
<div class="modal fade" id="myModalAd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Service Confirmation</h4>
            </div>

            <div class="modal-body">
				<div id="notFound"></div>
                <div id="basicInfo" style="display:none">	
									
					<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Client Info :</label>
					<div class="col-lg-9">
						<strong class="col-md-12 col-lg-12"><span id="client_id"  class=""></span>,
						<span id="add_customer_name"  class=""></span>,
						<span id="add_mobile_number"></span></strong>						
					</div><div class="clearfix"></div><hr style="margin:5px 0px;">					
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
					<!-- <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Description :</label>
					<div class="col-lg-9">
						<strong><span id="description"  class="col-md-9 col-lg-9"></span></strong>
					</div><div class="clearfix"></div><hr style="margin:5px 0px;"> -->
					
					<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Machine Status :</label>
					<div class="col-lg-9">
						<strong><span id="add_status_number"  class="col-md-9 col-lg-9"></span></strong>
					</div><div class="clearfix"></div><hr style="margin:5px 0px;">
					<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Filter Status :</label>
					<div class="col-lg-9">
						<strong><span id="add_filterStatus_number"  class="col-md-9 col-lg-9"></span></strong>
					</div><div class="clearfix"></div><hr style="margin:5px 0px;"><br>
				
				</div>
				
				
				<form class="cmxform form-horizontal tasi-form" id="addCompletedServiceForm"  role="form" method="post"  
				action="<?php echo site_url('general_request_sp/addTechnitian');  ?>">
					<div class="form-group">
					
						<input type="hidden" class="form-control"  id="cid" name="req_id">
						<input type="hidden" class="form-control"  id="ccode" name="ref_cus_id">					
					</div>
					
					<div class="form-group">
						<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Customer Opinion *</label>
                        <div class="col-lg-9">                            
							
							<select class="form-control" name="clientresponse">
								
								<option value="">Select Opinion</option>
								<option value="1">Agree</option>
								<option value="2">Not Agree</option>
								<option value="3">Switch Off</option>								
							</select>
                        </div>				
					</div>	
					<div id="showHideForm" style="display:none">
											
						<div class="form-group">
							<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Add notes about service *</label>
							<div class="col-lg-9">                            
								<select class="form-control" name="add_technitian">
									<option value="">Select Technitian</option>
									
									<?php
										$this->db->where('ref_type_id',1);
										$technitian = $this->db->get('base_employees');
										foreach ($technitian->result() as $techs){ 
											if($techs->employee_name!='')
											echo '<option value="'. $techs->em_id .'">'. $techs->employee_name .'</option>';										
										}
										
									?>
									
								</select>
							</div>
						</div>					
						<div class="form-group">
							<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Request Date *</label>
							<div class="col-lg-9">
								<input type="text" value="" name="request_date" id="request_date" class="form-control form-control-inline input-medium default-date-picker">
							</div>
						</div>					
						<div class="form-group">
							<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Add notes about service *</label>
							<div class="col-lg-9">
								<textarea class="form-control" placeholder="Enter Notes About Service" id="add_notes" name="add_notes"></textarea>

							</div>
						</div><br>
						<!-- <div class="form-group">
							<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Filter Change </label>
							<div class="col-lg-9">
								<input type="checkbox" name="filter_change" id="filter_change"  value="1">

							</div> 
						</div> -->						
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