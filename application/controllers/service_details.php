<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service_details extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        $per_role_arr = array();
        $url = $this->uri->segment(1);
        $table_name = 'subs_menu';
        $column_name = 'url';
        $column_value = $url;
        $get_url_data = $this->common_model->getDataWhere($table_name, $column_name, $column_value);
        foreach ($get_url_data as $row):
            $sub_menu_id = $row->sub_menu_id;
            $get_role_data = $this->common_model->getDataWhere('permission', 'sub_menu_id', $sub_menu_id);
            foreach ($get_role_data as $row2):
                $role_id = $row2->role_id;
                array_push($per_role_arr, $role_id);
            endforeach;
        endforeach;
		
		$data['service'] = $this->uri->segment(2);
		$uid = $this->session->userdata('user_id');
		$data['servicedetails'] = $this->common_model->servicedetails($data['service'],$uid);	

        //if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Reports';
            $data['active_sub_menu'] = 'Complain Report';
            $table_name = 'base_service_custom';
            $column_name = 'service_status';
            //$column_value = 0; $column_value2 = 2; $column_value3 = 3;
            //$data['get_base_service_custom_data'] 
			//= $this->common_model->getDataOrWhere($table_name, $column_name, $column_value, $column_value2, $column_value3);

            $this->load->view('common/header', $data);
            $this->load->view('service_details/service_details', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('service_details/js_service_details', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
       // else:
         //   redirect('home');
       // endif;
    }

    
    
     public function dateSearch() {
        $per_role_arr = array();
        $url = $this->uri->segment(1);
        $table_name = 'subs_menu';
        $column_name = 'url';
        $column_value = $url;
        $get_url_data = $this->common_model->getDataWhere($table_name, $column_name, $column_value);
        foreach ($get_url_data as $row):
            $sub_menu_id = $row->sub_menu_id;
            $get_role_data = $this->common_model->getDataWhere('permission', 'sub_menu_id', $sub_menu_id);
            foreach ($get_role_data as $row2):
                $role_id = $row2->role_id;
                array_push($per_role_arr, $role_id);
            endforeach;
        endforeach;


        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Reports';
            $data['active_sub_menu'] = 'Request Service Report';
            
            $date_from = mysql_real_escape_string($this->input->post('date_from'));
            $date_to = mysql_real_escape_string($this->input->post('date_to'));
            
            $table_name = 'base_service_custom';
            $column_name = 'service_status';
            $column_value = 0;
            $result=$this->db->query("select * from base_service_custom where service_status=0 and (`request_date` between '$date_from' and '$date_to') ");
            $data['get_base_service_custom_data'] = $result->result();

            $this->load->view('common/header', $data);
            $this->load->view('request_service_report/request_service_report', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('request_service_report/js_request_service_report', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }
    
    
    
    
    public function addCompletedService() {

        $per_role_arr = array();
        $url = $this->uri->segment(1);
        $table_name = 'subs_menu';
        $column_name = 'url';
        $column_value = $url;
        $get_url_data = $this->common_model->getDataWhere($table_name, $column_name, $column_value);
        foreach ($get_url_data as $row):
            $sub_menu_id = $row->sub_menu_id;
            $get_role_data = $this->common_model->getDataWhere('permission', 'sub_menu_id', $sub_menu_id);
            foreach ($get_role_data as $row2):
                $role_id = $row2->role_id;
                array_push($per_role_arr, $role_id);
            endforeach;
        endforeach;


        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');

            $req_id = mysql_real_escape_string($this->input->post('req_id'));
            $ref_cus_id = mysql_real_escape_string($this->input->post('ref_cus_id'));

            $get_result = $this->common_model->getDataWhere('base_service_custom', 'cu_id', $req_id);
            foreach ($get_result as $row) :
                $service_description = $row->service_description;
                $service_priority = $row->service_priority;
            endforeach;
            $add_notes = mysql_real_escape_string($this->input->post('add_notes'));
            $filter_change = mysql_real_escape_string($this->input->post('filter_change'));

            if ($filter_change == ""):
                $filter_change = 0;
            endif;


            $data = array(
                'service_status' => 1,
                'note_text' => $add_notes,
                'added_time' => date('Y-m-d H:i:s')
            );

            $table_name = 'base_service_custom';
            $insert_result = $this->common_model->updateData($table_name, $data, 'cu_id', $req_id);


            $get_result = $this->common_model->getDataWhere('base_service_master', 'ref_client_id', $ref_cus_id);

            foreach ($get_result as $row) :
                $m_id = $row->m_id;
                $service_total = $row->service_total;
                $service_total = $service_total + 1;
                if ($service_total > 3):
                    $data2 = array(
                        'service_total' => $service_total,
                        'is_in_service' => 2,
                        'is_filter_change' => $filter_change
                    );
                    $service_type = 2;
                    $this->common_model->updateData('base_service_master', $data2, 'm_id', $m_id);
                else:
                    $data2 = array(
                        'service_total' => $service_total,
                        'is_filter_change' => $filter_change
                    );
                    $service_type = 1;
                    $this->common_model->updateData('base_service_master', $data2, 'm_id', $m_id);
                endif;

            endforeach;



            if ($filter_change == 1):
                $data3 = array(
                    'ref_client_id' => $ref_cus_id,
                    'change_date' => date('Y-m-d H:i:s'),
                    'change_note' => $add_notes
                );
                $table_name = 'base_filter_changes';
                $insert_result = $this->common_model->insertData($table_name, $data3);
            endif;

            $data4 = array(
                'ref_master_id' => $m_id,
                'ref_client_id' => $ref_cus_id,
                'service_date' => date('Y-m-d H:i:s'),
                'service_description' => $service_description,
                'service_type' => $service_type,
                'service_status' => 1,
                'is_active' => 1,
                'service_priority' => $service_priority,
                'note_text' => $add_notes,
                'general_or_request' => 1
            );
            $table_name = 'base_service_details';
            $insert_result = $this->common_model->insertData($table_name, $data4);

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('request_service_report');
        else:

            redirect('home');
        endif;
    }

    public function removeCompletedService() {
        $per_role_arr = array();
        $url = $this->uri->segment(1);
        $table_name = 'subs_menu';
        $column_name = 'url';
        $column_value = $url;
        $get_url_data = $this->common_model->getDataWhere($table_name, $column_name, $column_value);
        foreach ($get_url_data as $row):
            $sub_menu_id = $row->sub_menu_id;
            $get_role_data = $this->common_model->getDataWhere('permission', 'sub_menu_id', $sub_menu_id);
            foreach ($get_role_data as $row2):
                $role_id = $row2->role_id;
                array_push($per_role_arr, $role_id);
            endforeach;
        endforeach;
        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');

            $req_id = mysql_real_escape_string($this->input->post('req_id_remove'));
            $ref_cus_id = mysql_real_escape_string($this->input->post('ref_cus_id_remove'));

            $get_result = $this->common_model->getDataWhere('base_service_custom', 'cu_id', $req_id);
            foreach ($get_result as $row) :
                $service_description = $row->service_description;
                $service_priority = $row->service_priority;
            endforeach;
            $add_notes = mysql_real_escape_string($this->input->post('add_notes'));
            $filter_change = mysql_real_escape_string($this->input->post('filter_change'));

            $data = array(
                'service_status' => 1,
                'note_text' => $add_notes,
                'added_time' => date('Y-m-d H:i:s')
            );

            $table_name = 'base_service_custom';
            $insert_result = $this->common_model->updateData($table_name, $data, 'cu_id', $req_id);


            $get_result = $this->common_model->getDataWhere('base_service_master', 'ref_client_id', $ref_cus_id);

            foreach ($get_result as $row) :
                $m_id = $row->m_id;
                $service_total = $row->service_total;
                $service_total = $service_total + 1;
                if ($service_total > 3):
                    $data2 = array(
                        'service_total' => $service_total,
                        'is_in_service' => 2
                            //  'is_filter_change' =>$filter_change
                    );
                    $service_type = 2;
                    $this->common_model->updateData('base_service_master', $data2, 'm_id', $m_id);
                else:
                    $data2 = array(
                        'service_total' => $service_total
                            //  'is_filter_change' =>$filter_change
                    );
                    $service_type = 1;
                    $this->common_model->updateData('base_service_master', $data2, 'm_id', $m_id);
                endif;

            endforeach;

            $data3 = array(
                'ref_master_id' => $m_id,
                'ref_client_id' => $ref_cus_id,
                'service_date' => date('Y-m-d H:i:s'),
                'service_description' => $service_description,
                'service_type' => $service_type,
                'service_status' => 0,
                'is_active' => 1,
                'service_priority' => $service_priority,
                'note_text' => $add_notes,
                'general_or_request' => 1
            );
            $table_name = 'base_service_details';
            $insert_result = $this->common_model->insertData($table_name, $data3);

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('add_completed_service');
        else:

            redirect('home');
        endif;
    }

    public function getData1() {

        $data['base_url'] = $this->config->item('base_url');
        $user_id = mysql_real_escape_string($this->input->post('user_id'));

        $table_name = 'base_clients';
        $result = $this->common_model->getDataWhere($table_name, "ci_id", $user_id);
        echo json_encode($result);
    }
	
	public function getProccessData() {
        
		$data['base_url'] = $this->config->item('base_url');
		$data['active_menu'] = 'Reports';
		$data['active_sub_menu'] = 'Complain Report';
         
        $type = mysql_real_escape_string($this->input->post('type'));
        $fm = mysql_real_escape_string($this->input->post('date_from'));
        $to = mysql_real_escape_string($this->input->post('date_to'));
		
		if($fm != '' && $to == ''){$to=date('Y-m-d');}
		$data['type'] = $type;
		$data['fm'] = $fm;
		$data['to'] = $to;
		if($type!=1){
			if(($fm != '' && $to != '')||($fm == '' && $to == '')){	
				
					
					$data['processData'] = $this->common_model->getProccessData($type, $fm, $to);				
					$this->load->view('common/header', $data);
					$this->load->view('request_service_report/request_service_report', $data);
					$this->load->view('common/js', $data);
					$this->load->view('request_service_report/js_request_service_report', $data);
					$this->load->view('common/footer', $data);
					
				 
			}else{
				 
				$data['err'] = True;			
				$this->load->view('common/header', $data);
				$this->load->view('request_service_report/request_service_report', $data);
				$this->load->view('common/js', $data);
				$this->load->view('request_service_report/js_request_service_report', $data);
				$this->load->view('common/footer', $data);
				
			}
		}else{
			if(($fm != '' && $to != '')){	
				
					
					$data['processData'] = $this->common_model->getProccessData($type, $fm, $to);				
					$this->load->view('common/header', $data);
					$this->load->view('request_service_report/request_service_report', $data);
					$this->load->view('common/js', $data);
					$this->load->view('request_service_report/js_request_service_report', $data);
					$this->load->view('common/footer', $data);
					
				 
			}else{
				 
				$data['err'] = True;			
				$this->load->view('common/header', $data);
				$this->load->view('request_service_report/request_service_report', $data);
				$this->load->view('common/js', $data);
				$this->load->view('request_service_report/js_request_service_report', $data);
				$this->load->view('common/footer', $data);
				
			}
			
			
		}
		
        //echo $result;
    }

   

}

?>
