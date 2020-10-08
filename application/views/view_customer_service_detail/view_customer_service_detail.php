<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Service Details
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                   
                    <?php
                    if(count($base_clients_data)>0):
						foreach ($base_clients_data as $row1) :
										   
							$ref_area_id=$row1->ref_area_id;
							$client_code=$row1->client_code;
							$client_name=$row1->client_name;
							$client_phone=$row1->client_phone;
							$client_address=$row1->client_address;

							$res_install_by= $this->db->query("select * from base_areas where a_id='$ref_area_id'");       
							foreach ($res_install_by->result() as $row6) :
								$area_name=$row6->area_name;     
							endforeach;                                      
						endforeach;                                      
                    endif;
                    if(count($base_service_master_data)>0):
						foreach ($base_service_master_data as $row2) :
						    $ref_sale_by=$row2->ref_sale_by;     
						    $ref_install_by =$row2->ref_install_by ;   
                                
							$res_sale_by= $this->db->query("select * from base_employees where em_id='$ref_sale_by'");       
							foreach ($res_sale_by->result() as $row3) :
								
								$employee_code=$row3->employee_code;
								$employee_name=$row3->employee_name;
								$sale_per=$employee_code."-".$employee_name; 
     
							endforeach;  
							$res_install_by= $this->db->query("select * from base_employees where em_id='$ref_install_by'");       
							foreach ($res_install_by->result() as $row4) :
								$employee_code=$row4->employee_code;
								$employee_name=$row4->employee_name;
								$install_per=$employee_code."-".$employee_name; 

							endforeach;
                        endforeach;                                      
                    endif;
                    
                    
                    
                    
                    
                    ?>
                    
                    <div class="row">
                    <div class="col-lg-6">
                                      <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Client Code   :</label>
                                      <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$client_code?></label>
                                      <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Client Name :</label>
                                      <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$client_name?></label>
                                      
                                       <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Client Phone:</label>
                                      <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$client_phone?></label>
                                      <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Client Address:</label>
                                      <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$client_address?></label>
                                      
                                       <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Sales By:</label>
                                      <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$sale_per?></label>
                                       <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Install By:</label>
                                      <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$install_per?></label>
                                      
                                      <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Tech Zone:</label>
                                      <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$area_name?></label>
                                      
                                      
                      </div>
                    </div>
                    <hr>
                    
                    
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hiddentable-info">
                                <thead>
                                    <tr>  
									
                                        <th class="hidden-phone">STATUS</th>                                       
                                        <th class="hidden-phone">INS_DATE</th>
                                        <th class="hidden-phone">SER_DATE</th>
                                        <th class="hidden-phone">PRIORITY</th>
										<th class="hidden-phone">TECHNICIAN </th>
                                        <th class="hidden-phone">G/R</th>
                                        <th class="hidden-phone">SERVICE TYPE</th>
                                        <th class="hidden-phone">NOTE</th>
                                        <th class="hidden-phone">ACTION</th>
                                        <th class="hide_coloum">Test</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($base_service_details_data as $row) :
                                        $id=$row->de_id;
                                        $ref_master_id=$row->ref_master_id;
                                        $ref_client_id=$row->ref_client_id;
                                        $note_text=$row->note_text;

                                        $res_clients= $this->db->query("select * from base_clients where ci_id='$ref_client_id'");
                                        foreach ($res_clients->result() as $row1) :
                                            $ref_area_id=$row1->ref_area_id;
                                            $client_code=$row1->client_code;
                                            $client_name=$row1->client_name;
                                            $client_phone=$row1->client_phone;
                                            $client_address=$row1->client_address;


                                        endforeach;
										
										
										
										$res_clients= $this->db->query("select * from base_service_custom where ref_client_id='$ref_client_id'");
                                        
										
										foreach ($res_clients->result() as $row1) :
                                            $technicianid=$row1->technitian;
                                          


                                        endforeach;
										
										

										


                                        $res_masters= $this->db->query("select * from base_service_master where m_id='$ref_master_id'");
                                        foreach ($res_masters->result() as $row2) :
                                            $ref_model_id=$row2->ref_model_id;
                                            $install_date=$row2->install_date;
                                            $is_in_service=$row2->is_in_service;

                                        endforeach;


                                        $service_date=$row->service_date;
                                        $service_description=$row->service_description;
                                        $service_type=$row->service_type;
                                        $service_status=$row->service_status;
                                        $sms=$row->sms;
										$sdetails='';
										if($service_description==1){ $sdetails='Filter Change';}
										if($service_description==2){ $sdetails='Service';}
										if($service_description==3){ $sdetails='Spare Parts';}
										if($service_description==4){ $sdetails='Default Customer';}
										
                                        if($sms==1) {
                                            $ss="Send Sms";
                                        }
                                        else if($service_status==1) {
                                            $ss="Completed";
                                        }else {
                                            $ss="Incompleted";
                                        }
                                        $is_active=$row->is_active;
                                        $service_priority=$row->service_priority;
                                        
										if($service_priority==1) {                                            $priority='Managment';
                                        }else if($service_priority==2) {
                                            $priority='Dealer';
                                        }else if($service_priority==3) {
                                            $priority='Customer Care';
                                        }else if($service_priority==4) {
                                            $priority='Otehrs';
                                        }else if($service_priority==5) {
                                            $priority='Genaral Service';
                                        }else {
                                            $priority='';
                                        }

                                        $general_or_request=$row->general_or_request;
                                        if($general_or_request==0) {
                                            $gr="General";
                                        }else {
                                            $gr="Request";
                                        }

                                        $note_text=$row->note_text;
                                        $res_area= $this->db->query("select * from base_areas where a_id='$ref_area_id'");
                                        foreach ($res_area->result() as $row3) :
                                            $area_name=$row3->area_name;
                                        endforeach;

                                        $res_models= $this->db->query("select * from base_models where mo_id='$ref_model_id'");
                                        foreach ($res_models->result() as $row4) :
                                            $model_name=$row4->model_name;
                                        endforeach;

                                        if($is_in_service==2):
                                            $service_status="NSP";
                                        else:
                                            $service_status="SP";
                                        endif;
							


                                        ?>
                                    <tr class="gradeX">
                                       
                                        <td class="hidden-phone"><?php echo $service_status; ?></td>
                                      
                                        <td class="hidden-phone"><?php echo $install_date; ?></td>
                                        <td class="hidden-phone"><?php echo $service_date; ?></td>
                                        <td class="hidden-phone"><?php echo $priority; ?></td>
										<td class="hidden-phone"><?php echo $priority; ?></td>
                                        <td class="hidden-phone"><?php echo $gr; ?></td>
                                        <td class="hidden-phone"><?php echo $sdetails; ?></td>
                                        <td class="hidden-phone"><?php echo $note_text; ?></td>
                                        <td class="hidden-phone"><?php echo $ss; ?></td>
                                        <td class="hide_coloum"><?php echo $id; ?></td>
                                    </tr>

                                    <?php endforeach;  ?>
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
                <form class="cmxform form-horizontal tasi-form" id="addServiceForm"  role="form" method="post"  action="<?php echo site_url('add_service/addReqService');  ?>">

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Customer Code *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" readonly="readonly" placeholder="Enter Customer Code" id="add_customer_code" name="add_customer_code">
                            <input type="hidden" class="form-control"  id="client_id" name="client_id">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Mobile NUmber *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" readonly="readonly" placeholder="Enter Mobile Number" id="add_mobile_number" name="add_mobile_number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Service Priority *</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="add_service_priority" id="add_service_priority" required>
                                <option value="">Select Priority</option>
                                <option value="1">Normal</option>
                                <option value="2">Moderate</option>
                                <option value="3">High</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Request Date *</label>
                        <div class="col-lg-9">
                            <input class="form-control form-control-inline input-medium default-date-picker" size="16" placeholder="Enter Request Date" value="" type="text" id="add_request_date" name="add_request_date">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Service Description *</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" placeholder="Enter Service Description" id="add_service_description" name="add_service_description"></textarea>

                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info pull-right">Submit</button>
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














