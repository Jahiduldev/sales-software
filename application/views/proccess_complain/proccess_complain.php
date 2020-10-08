<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height" style="width:auto;" id="">


        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading" style="font-weight:bold; background:#F2682B; color:#fff;">
                        Proccess Complain
                        <span class="tools pull-right">
                            
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class="">
                            <table class="display table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="">SL</th>
										 <th>ACTION</th>
                                        <th class="">ADD BY</th>
                                        <th class="hidden-phone">CUSTOMER ID</th>
                                        <th>CUSTOMER NAME</th>
                                        <th class="hidden-phone">PHONE</th>
                                        <th class="hidden-phone">DEFAULT</th>
                                        <th class="hidden-phone">TYPE</th>
                                        
										<th class="hidden-phone">Assign Date</th>
                                        <th class="hidden-phone">REQUEST DATE</th>
                                        <th class="hidden-phone">Complain By </th>
                                        <th class="hidden-phone">DESCRIPTION</th>								
                                       
                                        <th class="hide_coloum">Test</th>
                                    </tr>
                                </thead>
                                <tbody style='color:black;'>

                                    <?php $sl=1; 
									$today = date('Y-m-d');
									foreach ($get_base_service_custom_data as $row) :
                                        
										$id=$row->cu_id;
                                        $ref_client_id=$row->ref_client_id;
                                        $is_active=$row->is_active;
                                        $description=$row->service_description;
                                        $service_statu=$row->service_status;
										$technitian=$row->technitian;
										$added_by=$row->added_by;
										$request_date=$row->request_date;
										$assign_date=date('Y-m-d', strtotime($row->added_time));
										
										if(strtotime($request_date) < strtotime($today)){ 
											$requ_date = '<span style="color:red;">'.$request_date.'</span>'; 
										}else{
											$requ_date=$request_date; 
										}
										
										if($service_statu==0) {
                                            $serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
                                        }else if($service_statu==2) {
                                            $serstatus='<span style="color:maroon;">Pending</span>';
                                        }else if($service_statu==3) {
                                            $serstatus='<span style="color:orange;">Reschedule</span>';
                                        }

                                        $res_clients= $this->db->query("select * from base_service_master where ref_client_id='$ref_client_id'");
                                        foreach ($res_clients->result() as $row0) :
                                            $m_id=$row0->m_id;
                                            $install_date=$row0->install_date;
                                            $ref_model_id=$row0->ref_model_id;
                                            $is_in_service=$row0->is_in_service;
                                            $default=$row0->default;
                                        endforeach;
										
										if($default==1) {
                                            $default='<span style="color:red">Yes</span>';
                                        }else {
                                            $default='No';
                                        }

                                        $res_clients= $this->db->query("select * from base_clients where ci_id='$ref_client_id'");
                                        foreach ($res_clients->result() as $row1) :
                                            $client_code=$row1->client_code;
                                            $client_name=$row1->client_name;
                                            $client_phone=$row1->client_phone;
                                            $client_address=$row1->client_address;
                                            $ref_area_id=$row1->ref_area_id;
                                        endforeach;

                                        $res_area= $this->db->query("select * from base_areas where a_id='$ref_area_id'");
                                        foreach ($res_area->result() as $row2) :
                                            $area_name=$row2->area_name;
                                        endforeach;

                                        $res_area= $this->db->query("select * from base_models where mo_id='$ref_model_id'");
                                        foreach ($res_area->result() as $row3) :
                                            $model_name=$row3->model_name;
                                        endforeach;

                                        //$request_date=$row->request_date;										
										
                                        $service_priority=$row->service_priority;
										
                                        if($service_priority==1) {
                                            $priority='Managment';
                                        }else if($service_priority==2) {
                                            $priority='Dealer';
                                        }else if($service_priority==3) {
                                            $priority='Hot Line';
                                        }else if($service_priority==4) {
                                            $priority='Others';
                                        }else if($service_priority==5) {
                                            $priority='Sales Team';
                                        }
                                        else if($service_priority==6) {
                                            $priority='Service Team';
                                        }
                                        else {
                                            $priority='';
                                        }

                                        if($is_in_service==2):
                                            $service_status="NSP";
                                        else:
                                            $service_status="SP";
                                        endif;
										
										//$em_id = $row->em_id;
										if($technitian!=0){	
											$queryMenu = $this->db->query("SELECT * FROM base_employees WHERE em_id='$technitian'");
											foreach ($queryMenu->result() as $rowMenu) {
												$technitian = $rowMenu->employee_name;
											}
										}else{$technitian='';}
										$user = $this->db->query("SELECT * FROM user WHERE user_id='$added_by'");
                                        foreach ($user->result() as $row) {
                                            $added_by = $row->name;
                                        }
										

                                    ?>
                                    <tr class="">
                                        <td class=""><?php echo $sl; ?></td>
										 <td>
											
											<?php if($service_statu ==0) { ?>
												<button class="btn btn-primary btn-xs" onclick="addModal('<?=$id."+".$ref_client_id.'+'.$request_date?>');" style="background-color:red;">
												<i class="fa fa-pencil">Not Assign</i></button>
											<?php } else { ?><span style="color:green;">Technitian Assigned</span><?php } ?>
											<!--<button class="btn btn-danger btn-xs" onclick="removeModal('<?=$id."-".$ref_client_id?>');">
											<i class="fa fa-eraser">Remove</i></button> -->
                                        </td>
                                        <td class=""><?php echo $added_by; ?></td>
                                        <td class="hidden-phone"><?php echo $client_code; ?></td>
                                        <td><?php echo $client_name; ?></td>
                                        <td class="hidden-phone"><?php echo $client_phone; ?></td>
                                        <td class="hidden-phone"><?php echo $default; ?></td>
                                        <td class="hidden-phone"><?php echo $service_status; ?></td>
   
										<td class="hidden-phone"><?php echo $assign_date; ?></td>
                                        <td class="hidden-phone"><?php echo $requ_date; ?></td>
                                        <td class="hidden-phone"><?php echo $priority; ?></td>
                                        <td class="hidden-phone"><?php echo $description; ?></td>
										 
                                       
                                        <td class="hide_coloum"><?php echo $id; ?></td>
                                    </tr>

                                    <?php $sl++; endforeach;  ?>
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
                <h4 class="modal-title">Proccess Complain</h4>
            </div>

            <div class="modal-body">
				
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
					<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Description :</label>
					<div class="col-lg-9">
						<strong><span id="description"  class="col-md-9 col-lg-9"></span></strong>
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
				action="<?php echo site_url('proccess_complain/addTechnitian');  ?>">
					<div class="form-group"></div>
                    <input type="hidden" class="form-control"  id="req_id" name="req_id">
                    <input type="hidden" class="form-control"  id="ref_cus_id" name="ref_cus_id">					
					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Select Technician *</label>
                        <div class="col-lg-9">                            
							<select class="form-control" name="add_technitian" required>
								<option value="">Select Technician</option>
								
								<?php
									$this->db->where('ref_type_id',2);
                                                                        $this->db->where('is_active',1);
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
                    </div>
                    <!-- <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Filter Change </label>
                        <div class="col-lg-9">
                            <input type="checkbox" name="filter_change" id="filter_change"  value="1">

                        </div> 
                    </div> -->
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














