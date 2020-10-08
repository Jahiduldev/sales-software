
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Complain Report 
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        
                        <div class="adv-table">
                            <table class="display table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="hidden-phone">SL</th>
                                        <th class="hidden-phone">CUSTOMER ID</th>
                                        <th>CUSTOMER NAME</th>
                                        <th class="hidden-phone">PHONE</th>
										<th class="hidden-phone">Type</th> 
                                        <?php if($service == 'complete' || $service == 'complete_today'){?><?php } else { ?>   
											<th class="hidden-phone">STATUS</th> 
										<?php } ?>
                                        <th class="hidden-phone">REQUEST DATE</th> 
										<th class="hidden-phone">TECHNITIAN</th> 
                                        <th class="hidden-phone">NOTE</th>                                         
										<th class="hidden-phone">Action</th> 
									</tr>
                                </thead>
                                <tbody id="">
                                     <?php echo(isset($servicedetails)?$servicedetails:''); ?>
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














