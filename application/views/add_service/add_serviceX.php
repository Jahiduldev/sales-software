<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading" style="font-weight:bold; background:#F2682B; color:#fff;">
                       Find Customer
                    </header>
                    <div class="panel-body">                       
						<div class="form-group">
							<div class="col-lg-6">
								<input type="text" class="form-control" placeholder="Enter Customer Code/Mobile Number" id="customer_code" name="customer_code" required>
							<br><div id="notFound"></div></div>
							<div class="col-lg-3">
								<button onclick="addModal();" class="btn btn-info pull-left">Search</button>
							</div><div class="clearfix"></div>	
						</div>
                    </div>
                </section>
            </div>
        </div>
		<style type="text/css">
            .dataTables_filter{ display:none; }             
        </style>
        <div class="row" id="basicInfo" style="display:none">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading" style="font-weight:bold; background:#F2682B; color:#fff;">
					Add Complain
                        <span class="tools pull-right">
                            <a style="color:#fff;" href="javascript:;" class="fa fa-chevron-down"></a>
                            <a style="color:#fff;" href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body" style="color:black;">
                        <div class="adv-table">
								<div>	
									
								<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Client Code :</label>
								<div class="col-lg-9">
									<strong><span id="client_id"  class="col-md-9 col-lg-9"></span></strong>
								</div><div class="clearfix"></div><hr style="margin:5px 0px;">
								
								<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Client Name :</label>
								<div class="col-lg-9">
									<strong><span id="add_customer_name"  class="col-md-9 col-lg-9"></span></strong>
								</div><div class="clearfix"></div><hr style="margin:5px 0px;">
								<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Client Phone:</label>
								<div class="col-lg-9">
									<strong><span id="add_mobile_number"  class="col-md-9 col-lg-9"></span></strong>
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
								
								<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Dealer :</label>
								<div class="col-lg-9">
									<strong><span id="dealer"  class="col-md-9 col-lg-9"></span></strong>
								</div><div class="clearfix"></div><hr style="margin:5px 0px;">
								
								<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Customer Status :</label>
								<div class="col-lg-9">
									<strong><span id="custo_status"  class="col-md-9 col-lg-9"></span></strong>
								</div><div class="clearfix"></div><hr style="margin:5px 0px;">
								
								<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Machine Status :</label>
								<div class="col-lg-9">
									<strong><span id="add_status_number"  class="col-md-9 col-lg-9"></span></strong>
								</div><div class="clearfix"></div><hr style="margin:5px 0px;">
								
								<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Filter Status :</label>
								<div class="col-lg-9">
									<strong><span id="add_filterStatus_number"  class="col-md-9 col-lg-9"></span></strong>
								</div><div class="clearfix"></div><hr style="margin:5px 0px;">
								<div style="color:black;">
									
								<form class="cmxform form-horizontal tasi-form" id="addServiceForm"  role="form" 
								method="post"  action="<?php echo site_url('add_service/addReqService');  ?>">
									
									<div class="form-group" style="color:black; font-weight:bold">
										<label for="inputSuccess" class="col-sm-3 control-label col-lg-3" style="color:black; font-weight:bold">Complain By *</label>
										<div class="col-lg-9">
											<select class="form-control" name="add_service_priority" id="add_service_priority" style="color:black; font-weight:bold"  required>
												
												<option value="">Complain By</option>
												<option value="1">Management</option>
												<option value="2">Dealer</option>
												<option value="3">Hot Line</option>
                                                                                                <option value="5">Sales Team </option>
                                                                                                <option value="6">Service Team</option>
												<option value="4">Others</option>

											</select>
											<input type="hidden" name="client_id" id="hidden_client_id" />
										</div>
									</div>

									<div class="form-group" style="color:black;font-weight:bold">
										<label for="inputSuccess" class="col-sm-3 control-label col-lg-3" style="color:black; font-weight:bold">Request Date *</label>
										<div class="col-lg-9" style="color:black; font-weight:bold">
											<input class="form-control form-control-inline input-medium default-date-picker" size="16" placeholder="Enter Request Date" value="<?= date('Y-m-d')?>" type="text" id="add_request_date" name="add_request_date">

										</div>
									</div>

									<div class="form-group" style="color:black;font-weight:bold">
										<label for="inputSuccess" class="col-sm-3 control-label col-lg-3" style="color:black; font-weight:bold">Service Description *</label>
										<div class="col-lg-9">
											<textarea class="form-control" placeholder="Enter Service Description" id="add_service_description" name="add_service_description"></textarea>

										</div>
									</div>
									<div class="form-group" style="color:black;font-weight:bold">
										<div class="col-lg-9 col-lg-offset-3">
											<button type="submit" class="btn btn-info pull-right" style="color:black; font-weight:bold">Submit</button>
										</div>
									</div>
								</form>
							</div>
							</div>
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














