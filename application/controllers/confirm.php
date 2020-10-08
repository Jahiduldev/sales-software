<?php
date_default_timezone_set("Asia/Dhaka");
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Confirm extends CI_Controller {
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
            $data['active_menu'] = 'Complain Solution Area';
            $data['active_sub_menu'] = 'Installation Update';

            $data['get_base_service_custom_data'] = $this->common_model->updateInstall();

            $this->load->view('common/header',$data);
            $this->load->view('confirm_ssp/confirm',$data);
            $this->load->view('common/js',$data);
            $this->load->view('confirm_ssp/js_confirm',$data);
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
			

            $req_id = mysql_real_escape_string($this->input->post('req_id'));
            $install = mysql_real_escape_string($this->input->post('add_install'));
            $installdate = mysql_real_escape_string($this->input->post('install_date'));
            $service_type = mysql_real_escape_string($this->input->post('service_complete_type'));
			
			
			
            
			
			if($service_type==1){
				
				$query=$this->db->query("UPDATE `base_clients` SET is_active=1 where ci_id=$req_id");
            
			}elseif($service_type==2){
				
				
				if($install != '' && $installdate != ''){
				
					$data2 = array(
						'ref_install_by' => $install,
						'install_date' => $installdate
					);
					$this->common_model->updateData('base_service_master',$data2,'ref_client_id',$req_id);	
				}elseif($install == '' && $installdate != ''){
					
					$data2 = array(
						
						'install_date' => $installdate
					);
					$this->common_model->updateData('base_service_master',$data2,'ref_client_id',$req_id);	
				}elseif($install != '' && $installdate == ''){
					
					$data2 = array(
						
						'ref_install_by' => $install
					);
					$this->common_model->updateData('base_service_master',$data2,'ref_client_id',$req_id);	
				}else{
					
					$this->session->set_userdata('msg_title', 'Error');
					$this->session->set_userdata('msg_body','Failed' );
					
					
				}
				
				
                					
					
			}
			
			
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull');
           
			
            redirect('confirm');
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
		base_service_master.is_in_service, base_service_master.is_filter_change, sale.employee_name AS saler, install.employee_name AS installer, base_areas.area_name');
		
		$this->db->from('base_clients');
		
		$this->db->join('base_service_master', 'base_clients.ci_id = base_service_master.ref_client_id');
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



    public function confirmuser() {

        $data['base_url'] = $this->config->item('base_url');
        $ciid = mysql_real_escape_string($this->input->post('id'));

        $query=$this->db->query("UPDATE `base_clients` SET is_active=1 where ci_id=$ciid");
        
        echo 'ok';
		
		
			

    }
}
?>
