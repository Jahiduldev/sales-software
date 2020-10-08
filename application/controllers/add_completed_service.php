<?php
date_default_timezone_set("Asia/Dhaka");
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Add_completed_service extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
		$per_role_arr=array();
        $url = $this->uri->segment(1);
        $table_name='subs_menu';
        $column_name='url';
        $column_value=$url;
        $get_url_data= $this->common_model->getDataWhere($table_name,$column_name,$column_value);
        foreach($get_url_data as $row):
            $sub_menu_id=$row->sub_menu_id;
            $get_role_data= $this->common_model->getDataWhere('permission','sub_menu_id',$sub_menu_id);
            foreach( $get_role_data as $row2):
                $role_id=$row2->role_id;
                array_push($per_role_arr,$role_id);
            endforeach;
        endforeach;


        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Manipulation';
            $data['active_sub_menu'] = 'Add Completed Service';
            $table_name='base_service_custom';
            $column_name='service_status';
            $column_value=2;
			$column_value2=3;
            $data['get_base_service_custom_data'] = $this->common_model->getDataOrWhere1($table_name,$column_name,$column_value,$column_value2);

            $this->load->view('common/header',$data);
            $this->load->view('add_completed_service/add_completed_service',$data);
            $this->load->view('common/js',$data);
            $this->load->view('add_completed_service/js_add_completed_service',$data);
            $this->load->view('common/footer',$data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }
	
	
	 public function re_addCompletedService() {

	  $per_role_arr=array();
        $url = $this->uri->segment(1);
        $table_name='subs_menu';
        $column_name='url';
        $column_value=$url;
        $get_url_data= $this->common_model->getDataWhere($table_name,$column_name,$column_value);
        foreach($get_url_data as $row):
            $sub_menu_id=$row->sub_menu_id;
            $get_role_data= $this->common_model->getDataWhere('permission','sub_menu_id',$sub_menu_id);
            foreach( $get_role_data as $row2):
                $role_id=$row2->role_id;
                array_push($per_role_arr,$role_id);
            endforeach;
        endforeach;
	
	
        if (in_array($this->session->userdata('role_id'), $per_role_arr)):  
            $data['base_url'] = $this->config->item('base_url'); 
			$custom_update=false; $master_update=false; $service_status =false; $spOrNsp = 1;

            $req_id = mysql_real_escape_string($this->input->post('req_id'));
            $ref_cus_id = mysql_real_escape_string($this->input->post('ref_cus_id'));
            $req_date = mysql_real_escape_string($this->input->post('req_date'));
            $tech_id = mysql_real_escape_string($this->input->post('tech_id'));
            $uid = $this->session->userdata('user_id');
	    $add_mobile_number = mysql_real_escape_string($this->input->post('add_mobile_number'));

//die();

			$service_type= mysql_real_escape_string($this->input->post('service_complete_type'));
			
            $re_sechdule_date = mysql_real_escape_string($this->input->post('re_sechdule_date'));
            $technitian = mysql_real_escape_string($this->input->post('add_technitian'));
            $service_priority = mysql_real_escape_string($this->input->post('add_service_priority'));
            $service_description = mysql_real_escape_string($this->input->post('add_service_description'));
            
			$filter_change = mysql_real_escape_string($this->input->post('filter_change'));
            $service_only = mysql_real_escape_string($this->input->post('service_only'));
			$service_only_note = mysql_real_escape_string($this->input->post('service_only_note'));
            $spare_change = mysql_real_escape_string($this->input->post('spare_change'));
            $spare_change_note = mysql_real_escape_string($this->input->post('spare_change_note'));
            $default_customer = mysql_real_escape_string($this->input->post('default_customer'));
            $default_customer_note = mysql_real_escape_string($this->input->post('default_customer_note'));
			$desc=''; $note=''; $filter=0;
			
			if($service_type==1){
				$service_priority=0;
				if($filter_change != ""){
					

					$get_result = $this->common_model->getDataWhere('base_service_custom','cu_id',$req_id);
					foreach ($get_result as $row) {
						$service_priority=$row->service_priority;	
					}
					$this->common_model->deleteData('base_service_custom','cu_id',$req_id);
					$custom_update=true; 
					
					$get_result = $this->common_model->getDataWhere('base_service_master','ref_client_id',$ref_cus_id);
					foreach ($get_result as $row) {
						
						$m_id=$row->m_id;
						$service_total=$row->service_total;						
						$service_total=$service_total+1;
						
						if($service_total>3){ $spOrNsp=2;
							$data2 = array(
									
								'filter_date' => date('Y-m-d H:i:s'),
								'service_total' => $service_total,
								'is_in_service' => 2,
								'is_filter_change' =>$filter_change,
								'default' => 0
							);
							
							$this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
							$master_update=true;
						}else{
							
							$data2 = array(
							
								'service_date' => date('Y-m-d H:i:s'),
								'service_total' => $service_total,
								'is_filter_change' =>$filter_change,
								'default' => 0
							);							
							$this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
							$master_update=true;
						}

					}
					
					$data3 = array(
					
						'ref_client_id' => $ref_cus_id,							
						'change_date' => date('Y-m-d H:i:s'),
						'change_note' => 'Filter Change'
					);
					
					$insert_result = $this->common_model->insertData('base_filter_changes',$data3);
					
					
					$data4 = array(
				
						'ref_master_id' => $m_id,
						'ref_client_id' => $ref_cus_id,
						'ref_emp_id' => $tech_id,
						'service_date' => date('Y-m-d H:i:s'),
						'service_description' =>1,
						'service_type'=>$spOrNsp,
						'service_status' => 1,
						'is_active' => $uid,
						'service_priority' =>$service_priority,
						'note_text' => 'Filter Change',
						'general_or_request' => 1							
					);
					
					
					
					$insert_result = $this->common_model->insertData('base_service_details',$data4);					
					$desc = '1';
					$note = $filter_change;
					$filter = 1;
				
				
				}
				if($service_only != ""){
					
					// && $custom_update==false && $master_update==false  && $service_status==false
					if($custom_update==false){
						
						$get_result = $this->common_model->getDataWhere('base_service_custom','cu_id',$req_id);
						foreach ($get_result as $row) {
							$service_priority=$row->service_priority;	
						}					
						$this->common_model->deleteData('base_service_custom','cu_id',$req_id);
						$custom_update=true;  
					}
					
					if($master_update==false){
						$get_result = $this->common_model->getDataWhere('base_service_master','ref_client_id',$ref_cus_id);
						foreach ($get_result as $row) {
							
							$m_id=$row->m_id;
							$service_total=$row->service_total;
							$service_total=$service_total+1;
							if($service_total>3){ $spOrNsp=2;
								$data2 = array(
								
									'service_date' => date('Y-m-d H:i:s'),
									'service_total' => $service_total,
									'is_in_service' => 2,
									'default' => 0
								);
								
								$this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
								$master_update=true;
							}else{
								$data2 = array(
								
									'service_date' => date('Y-m-d H:i:s'),
									'service_total' => $service_total,
									'default' => 0
								);
								
								$this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
								$master_update=true;
							}

						}
						
					}	
					$data4 = array(
				
						'ref_master_id' => $m_id,
						'ref_client_id' => $ref_cus_id,
						'ref_emp_id' => $tech_id,
						'service_date' => date('Y-m-d H:i:s'),
						'service_description' =>2,
						'service_type'=> $spOrNsp,
						'service_status' => 1,
						'is_active' => $uid,
						'service_priority' =>$service_priority,
						'note_text' => $service_only_note,
						'general_or_request' => 1							
					);					
					
					$insert_result = $this->common_model->insertData('base_service_details',$data4);
					
					$desc .= ',2';
					$note .= '='.$service_only_note;

				}
				if($spare_change != ""){
					
					
					if($custom_update==false){
						
						$get_result = $this->common_model->getDataWhere('base_service_custom','cu_id',$req_id);
						foreach ($get_result as $row) {
							$service_priority=$row->service_priority;	
						}				
						$this->common_model->deleteData('base_service_custom','cu_id',$req_id);
						$custom_update=true; $service_status =true;
					}
					if($master_update==false){	
						$get_result = $this->common_model->getDataWhere('base_service_master','ref_client_id',$ref_cus_id);
						foreach ($get_result as $row) {
							
							$m_id=$row->m_id;
							$service_total=$row->service_total;
							$service_total=$service_total+1;
							if($service_total>3){ $spOrNsp=2;
								$data2 = array(
								
									'service_date' => date('Y-m-d H:i:s'),
									'service_total' => $service_total,
									'is_in_service' => 2,
									'default' => 0
								);
								
								$this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
								$master_update=true;
							}else{
								$data2 = array(
								
									'service_date' => date('Y-m-d H:i:s'),
									'service_total' => $service_total,
									'default' => 0
								);
								
								$this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
								$master_update=true;
							}

						}
					}
					
					$data4 = array(
			
						'ref_master_id' => $m_id,
						'ref_client_id' => $ref_cus_id,
						'ref_emp_id' => $tech_id,
						'service_date' => date('Y-m-d H:i:s'),
						'service_description' =>3,
						'service_type'=>$spOrNsp,
						'service_status' => 1,
						'is_active' => $uid,
						'service_priority' =>$service_priority,
						'note_text' => $spare_change_note,
						'general_or_request' => 1
							
					);
					
					
					
					
					$insert_result = $this->common_model->insertData('base_service_details',$data4);
					
					$desc .= ',3';
					$note .= '='.$spare_change_note;
					
					
				}
				if($default_customer != ""){
					//&& $custom_update==false && $master_update==false  && $service_status==false
					
					if($custom_update==false){
						
						$get_result = $this->common_model->getDataWhere('base_service_custom','cu_id',$req_id);
						foreach ($get_result as $row) {
							$service_priority=$row->service_priority;	
						}				
						$this->common_model->deleteData('base_service_custom','cu_id',$req_id);
						$custom_update=true; $service_status =true;
					}
					if($master_update==false){	
						$get_result = $this->common_model->getDataWhere('base_service_master','ref_client_id',$ref_cus_id);
						foreach ($get_result as $row) {
							
							$m_id=$row->m_id;
							$service_total=$row->service_total;
							$service_total=$service_total+1;
							if($service_total>3){ $spOrNsp=2;
								$data2 = array(
								
									'service_date' => date('Y-m-d H:i:s'),
									'service_total' => $service_total,
									'is_in_service' => 2,
									'default' => 1

								);
								
								$this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
								$master_update=true;
							}else{
								$data2 = array(
															
									'service_date' => date('Y-m-d H:i:s'),
									'service_total' => $service_total,
									'default' => 1

								);								
								$this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
								$master_update=true;
							}

						}
					}
					
					$data4 = array(
			
						'ref_master_id' => $m_id,
						'ref_client_id' => $ref_cus_id,
						'ref_emp_id' => $tech_id,
						'service_date' => date('Y-m-d H:i:s'),
						'service_description' =>4,
						'service_type'=> $spOrNsp,
						'service_status' => 1,
						'is_active' => $uid,
						'service_priority' => $service_priority,
						'note_text' => $default_customer_note,
						'general_or_request' => 1
							
					);					
					
					
					$insert_result = $this->common_model->insertData('base_service_details',$data4);
					
					$desc .= ',4';
					$note .= '='.$default_customer_note;

				}
				
				$data6 = array(
				
					'ref_master_id' => $m_id,
					'ref_client_id' => $ref_cus_id,
					'tech_id' => $tech_id,
					'req_date' => $req_date,
					'service_date' => date('Y-m-d H:i:s'),
					'service_description' =>trim($desc,","),
					'service_type'=>$spOrNsp,
					'service_status' => 1,
					'is_active' => $filter,
					'service_priority' =>'',
					'note_text' => trim($note,"="),
					'general_or_request' => 1						
				);				
				
				
				
				
				$queryPermission = $this->db->query("SELECT * FROM sms ");

                        foreach ($queryPermission->result() as $rowMenu) {
                            $complain=$rowMenu->sms3;
                            
                        }
			
             $complaintext = urlencode($complain);
             $sms_slice = explode('/',$add_mobile_number);

             $msist = $sms_slice[0];




			 $msis = strlen($msist);
			
			
            if($msis==11)
            {
			$msisfinal = '88'.$msist;
			
			$url2='http://api..com/api/v3/sendsms/plain?user=SKRPGROUP&password=KDoeQWZ6&SMSText='.$complaintext.'&GSM='.$msisfinal.'&TYPE=longSMS&unicode=8';
			
			
	     // $send = file_get_contents($url2);
			}
            else if($msis==10)
            {
			$msisfinal = '880'.$msist;
			
			$url2='http://api..com/api/v3/sendsms/plain?user=SKRPGROUP&password=KDoeQWZ6&SMSText='.$complaintext.'&GSM='.$msisfinal.'&TYPE=longSMS&unicode=8';
			
			
	     //    $send = file_get_contents($url2);
			}			
			
			 
				
				
				
				
				
				
				
				
				
				
				//$this->common_model->deleteData('unique_service_details','ref_client_id',$ref_cus_id);								
				//$this->common_model->insertData('unique_service_details',$data6);
				
            
			}else{
				
				//$get = $this->common_model->getDataWhere('base_service_custom','cu_id',$req_id);
				//$service_statuss = $get->service_status;
					
				$data = array(
			
					'service_status'=> 3,
					'note_text' => $service_description,
					'added_time' => $re_sechdule_date,
					'technitian' => $technitian
					
				);
				
				$insert_result = $this->common_model->updateData('base_service_custom',$data,'cu_id',$req_id);	
				
				
				
				
				
				
				
				$queryPermission = $this->db->query("SELECT * FROM sms ");

                        foreach ($queryPermission->result() as $rowMenu) {
                            $complain=$rowMenu->sms4;
                            
                        }
			
             $complaintext = urlencode($complain);
             $sms_slice = explode('/',$add_mobile_number);

             $msist = $sms_slice[0];




			 $msis = strlen($msist);
			
			
            if($msis==11)
            {
			$msisfinal = '88'.$msist;
			
			$url2='http://api.rankstelecom.com/api/v3/sendsms/plain?user=SKRPGROUP&password=KDoeQWZ6&SMSText='.$complaintext.'&GSM='.$msisfinal.'&TYPE=longSMS&unicode=8';
			
			
	//         $send = file_get_contents($url2);
			}
            else if($msis==10)
            {
			$msisfinal = '880'.$msist;
			
			$url2='http://api.rankstelecom.com/api/v3/sendsms/plain?user=SKRPGROUP&password=KDoeQWZ6&SMSText='.$complaintext.'&GSM='.$msisfinal.'&TYPE=longSMS&unicode=8';
			
			
	    //     $send = file_get_contents($url2);
			}			
			
			 
				
				
				
				
				
				
				
				
				
				
				
				
				
						
					
			}
			

			
			
			
				$user_id = $this->session->userdata('user_id');
				
				 $data49 = array(
                    'uid' => $user_id,
					'action_name' => "Complete Updates",
                    'datetime' => date('Y-m-d H:i:s')
                    
                );
                $table_name = 'user_record';
                $insert_result = $this->common_model->insertData($table_name, $data49);
			
			
			
			
			if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
			
            redirect('add_completed_service');
        else:

            redirect('home');
        endif;
    }



    public function addCompletedService() {

	  $per_role_arr=array();
        $url = $this->uri->segment(1);
        $table_name='subs_menu';
        $column_name='url';
        $column_value=$url;
        $get_url_data= $this->common_model->getDataWhere($table_name,$column_name,$column_value);
        foreach($get_url_data as $row):
            $sub_menu_id=$row->sub_menu_id;
            $get_role_data= $this->common_model->getDataWhere('permission','sub_menu_id',$sub_menu_id);
            foreach( $get_role_data as $row2):
                $role_id=$row2->role_id;
                array_push($per_role_arr,$role_id);
            endforeach;
        endforeach;
	
	
        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');

            $req_id= mysql_real_escape_string($this->input->post('req_id'));
            $ref_cus_id= mysql_real_escape_string($this->input->post('ref_cus_id'));

            $get_result = $this->common_model->getDataWhere('base_service_custom','cu_id',$req_id);
            foreach ($get_result as $row) :
                $service_description=$row->service_description;
                $service_priority=$row->service_priority;
            endforeach;
			 
            $add_notes = mysql_real_escape_string($this->input->post('add_notes'));
            $filter_change = mysql_real_escape_string($this->input->post('filter_change'));
			
			if($filter_change==""):
			    $filter_change=0;
			endif;
			
			
            $data = array(
                    'service_status'=>1,
                    'note_text' => $add_notes,
                    'added_time' => date('Y-m-d H:i:s')
            );

            $table_name='base_service_custom';
            $insert_result = $this->common_model->updateData($table_name,$data,'cu_id',$req_id);


            $get_result = $this->common_model->getDataWhere('base_service_master','ref_client_id',$ref_cus_id);

            foreach ($get_result as $row) :
                $m_id=$row->m_id;
                $service_total=$row->service_total;
                $service_total=$service_total+1;
                if($service_total>3):
                    $data2 = array(
                            'service_total' => $service_total,
                            'is_in_service' => 2,
                            'is_filter_change' =>$filter_change

                    );
                    $service_type=2;
                    $this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
                else:
                    $data2 = array(
                            'service_total' => $service_total,
                            'is_filter_change' =>$filter_change

                    );
                    $service_type=1;
                    $this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
                endif;

            endforeach;



            if($filter_change ==1):
                $data3 = array(
                        'ref_client_id' => $ref_cus_id,
                        'change_date' => date('Y-m-d H:i:s'),
                        'change_note' => $add_notes
                );
                $table_name='base_filter_changes';
                $insert_result = $this->common_model->insertData($table_name,$data3);
            endif;

            $data4 = array(
			
                    'ref_master_id' => $m_id,
                    'ref_client_id' => $ref_cus_id,
                    'service_date' => date('Y-m-d H:i:s'),
                    'service_description' =>$service_description,
                    'service_type'=>$service_type,
                    'service_status' => 1,
                    'is_active' => 1,
                    'service_priority' =>$service_priority,
                    'note_text' => $add_notes,
                    'general_or_request' => 1
					
            );
            $table_name='base_service_details';
            $insert_result = $this->common_model->insertData($table_name,$data4);

            if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
            redirect('add_completed_service');
        else:

            redirect('home');
        endif;
    }



 public function removeCompletedService() {
  $per_role_arr=array();
        $url = $this->uri->segment(1);
        $table_name='subs_menu';
        $column_name='url';
        $column_value=$url;
        $get_url_data= $this->common_model->getDataWhere($table_name,$column_name,$column_value);
        foreach($get_url_data as $row):
            $sub_menu_id=$row->sub_menu_id;
            $get_role_data= $this->common_model->getDataWhere('permission','sub_menu_id',$sub_menu_id);
            foreach( $get_role_data as $row2):
                $role_id=$row2->role_id;
                array_push($per_role_arr,$role_id);
            endforeach;
        endforeach;
        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');

            $req_id= mysql_real_escape_string($this->input->post('req_id_remove'));
            $ref_cus_id= mysql_real_escape_string($this->input->post('ref_cus_id_remove'));

            $get_result = $this->common_model->getDataWhere('base_service_custom','cu_id',$req_id);
            foreach ($get_result as $row) :
                $service_description=$row->service_description;
                $service_priority=$row->service_priority;
            endforeach;
            $add_notes = mysql_real_escape_string($this->input->post('add_notes'));
            $filter_change = mysql_real_escape_string($this->input->post('filter_change'));

            $data = array(
                    'service_status'=>1,
                    'note_text' => $add_notes,
                    'added_time' => date('Y-m-d H:i:s')
            );

            $table_name='base_service_custom';
            $insert_result = $this->common_model->updateData($table_name,$data,'cu_id',$req_id);


            $get_result = $this->common_model->getDataWhere('base_service_master','ref_client_id',$ref_cus_id);

            foreach ($get_result as $row) :
                $m_id=$row->m_id;
                $service_total=$row->service_total;
                $service_total=$service_total+1;
                if($service_total>3):
                    $data2 = array(
                            'service_total' => $service_total,
                            'is_in_service' => 2
                          //  'is_filter_change' =>$filter_change

                    );
                    $service_type=2;
                    $this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
                else:
                    $data2 = array(
                            'service_total' => $service_total
                          //  'is_filter_change' =>$filter_change

                    );
                    $service_type=1;
                    $this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
                endif;

            endforeach;

            $data3 = array(
                    'ref_master_id' => $m_id,
                    'ref_client_id' => $ref_cus_id,
                    'service_date' => date('Y-m-d H:i:s'),
                    'service_description' =>$service_description,
                    'service_type'=>$service_type,
                    'service_status' => 0,
                    'is_active' => 1,
                    'service_priority' =>$service_priority,
                    'note_text' => $add_notes,
                    'general_or_request' => 1
            );
            $table_name='base_service_details';
            $insert_result = $this->common_model->insertData($table_name,$data3);

            if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
            redirect('add_completed_service');
        else:

            redirect('home');
        endif;
    }


	
		public function getData2() {

       
        $user_id = mysql_real_escape_string($this->input->post('user_id'));

        
		
		$this->db->select('base_clients.ci_id, base_clients.client_code, base_clients.client_name, base_clients.client_address, base_clients.client_phone, 
		base_service_master.is_in_service, base_service_master.is_filter_change, sale.employee_name AS saler, install.employee_name AS installer, base_areas.area_name, base_service_custom.technitian');
		
		$this->db->from('base_clients');
		
		$this->db->join('base_service_master', 'base_clients.ci_id = base_service_master.ref_client_id');
		$this->db->join('base_service_custom', 'base_clients.ci_id = base_service_custom.ref_client_id');
		$this->db->join('base_employees sale', 'sale.em_id  = base_service_master.ref_sale_by');
		$this->db->join('base_employees install', 'install.em_id  = base_service_master.ref_install_by');
		$this->db->join('base_areas', 'base_areas.a_id  = base_service_master.ref_area_id');
		
		$this->db->where('base_clients.ci_id', $user_id);		
        
		$result = $this->db->get();
        echo json_encode($result->result());


    }





    public function getData1() {

        $data['base_url'] = $this->config->item('base_url');
        $user_id = mysql_real_escape_string($this->input->post('user_id'));

        $table_name='base_clients';
        $result = $this->common_model->getDataWhere($table_name,"ci_id",$user_id);
        echo json_encode($result);


    }
}
?>
