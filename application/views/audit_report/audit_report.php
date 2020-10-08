
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading" style="font-weight:bold; background:#F2682B; color:#fff;">
                        Audit Report 
                        <span class="tools pull-right">
                            
                        </span>
                    </header>
                    <div class="panel-body">
						
						<div class="row">
							<div class="col-lg-12">
								<form role="form" class="cmxform form-horizontal tasi-form" method="post"  id="RoleForm" action="<?php echo base_url();?>audit_report/getProccessData">
									
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
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select User </label>
                                <div class="col-lg-10">  
                                    <select class="form-control" name="dealeby" id="dealeby" required>
                                        <option value="">Select User Name</option>
                                        <?php
                                        foreach ($name_user as $row) :
                                            
											$id=$row->user_id;
                                          
                                            $name=$row->name;

                                            ?>
                                        <option value="<?=$id?>"><?=$name?></option>
                                        <?php endforeach;  ?>

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
                                        <th class="hidden-phone">USER NAME</th>
                                        <th>OPERATION MENU NAME</th>
                                        <th class="hidden-phone">DATE TIME</th>
									
                                       
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
<!-- modal -->



<!-- Modal -->
<!-- modal -->


</section>
</section>
<!--main content end-->














