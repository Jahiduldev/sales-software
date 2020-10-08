<?php
date_default_timezone_set("Asia/Dhaka");
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class General_request_sp extends CI_Controller {
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
            $data['active_menu'] = 'Newsletter Campaign';
            $data['active_sub_menu'] = 'General SP';
			$data['getSp']= $this->common_model->getSp();
			
            $this->load->view('common/header',$data);
            $this->load->view('general_request_sp/general_request_sp',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
            $this->load->view('general_request_sp/js_general_request_sp',$data);

            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }



    public function addRequestService() {
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

            $client_id= mysql_real_escape_string($this->input->post('client_id'));
            $master_id= mysql_real_escape_string($this->input->post('master_id'));
            $add_mobile_number = mysql_real_escape_string($this->input->post('add_mobile_number'));
            $add_service_priority = mysql_real_escape_string($this->input->post('add_service_priority'));
            $add_request_date = mysql_real_escape_string($this->input->post('add_request_date'));
            $add_service_description = mysql_real_escape_string($this->input->post('add_service_description'));
            $today=date('Y-m-d H:i:s');


            $data2 = array(
                    'ref_master_id' => $master_id,
                    'ref_client_id' => $client_id,
                    'service_date' =>date('Y-m-d'),
                    'service_description' =>$add_service_description,
                    'service_status' => 0,
                    'is_active' => 1,
                    'service_priority' =>$add_service_priority,
                    'general_or_request' => 0
            );
            $table_name='base_service_details';
            $insert_result = $this->common_model->insertData($table_name,$data2);

            $data3 = array(

                    'ref_client_id' => $client_id,
                    'request_date' => $add_request_date,
                    'service_description' =>$add_service_description,
                    'service_status'=>0,
                    'is_active' => 1,
                    'service_priority' =>$add_service_priority,
                    'added_time' =>$today


            );
            $table_name='base_service_custom';
            $insert_result = $this->common_model->insertData($table_name,$data3);

            if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
            redirect('general_request_sp');
        else:

            redirect('home');
        endif;
    }


    public function sendSms() {


        $today=date('Y-m-d');

        $joinQuery = "SELECT `c`.`ci_id`,`c`.`client_phone`,`m`.`m_id` FROM `base_service_master` AS `m`  JOIN `base_clients` AS `c` ON (`c`.`ci_id` = `m`.`ref_client_id`)  JOIN `nsp_status` AS `ns` ON (`m`.`is_in_service` = `ns`.`id`)
        JOIN `base_areas` AS `a` ON (`a`.`a_id` = `c`.`ref_area_id`)
        WHERE `m`.`m_id` NOT IN (SELECT ref_master_id FROM base_service_details) and `m`.`is_in_service`=1
        group by `m`.`ref_client_id`  HAVING DATEDIFF('$today',max(`m`.`install_date`))>120";

        $result=$this->db->query($joinQuery);


        if($result->num_rows()>0):

            foreach($result->result() as $row):

                $m_id=$row->m_id;
                $ci_id=$row->ci_id;
                $client_phone=$row->client_phone;

                $format_phone=  trim(str_replace("-","",$client_phone));

                $data2 = array(
                        'ref_master_id' => $m_id,
                        'ref_client_id' => $ci_id,
                        'service_date' => date('Y-m-d'),

                        'service_status' => 0,
                        'is_active' => 1,
                        'service_priority' =>1,
                        'general_or_request' => 0
                );
                $table_name='base_service_details';
                $insert_result = $this->common_model->insertData($table_name,$data2);

                $data3 = array(

                        'ref_client_id' => $ci_id,
                        'request_date' => date('Y-m-d'),
                        'service_status'=>0,
                        'is_active' => 1,
                        'added_time' =>$today


                );
                $table_name='base_service_custom';
                $insert_result = $this->common_model->insertData($table_name,$data3);


                $sms= mysql_real_escape_string($this->input->post('sms'));
                $data4 = array(
                        'ref_client_id' => $ci_id,
                        'sms' =>$sms,
                        'date_time' =>date('Y-m-d H:i:s')
                );
                $table_name='sms_history';
                $sms_result = $this->common_model->insertData($table_name,$data4);





            endforeach;
        endif;

        if($insert_result):
            $this->session->set_userdata('msg_title', 'Success');
            $this->session->set_userdata('msg_body','Successfull');
        else:
            $this->session->set_userdata('msg_title', 'Error');
            $this->session->set_userdata('msg_body','Failed' );
        endif;

        redirect('general_request_sp');

    }



    public function getTableDataSp() {

        $table = 'base_service_master';
        $primaryKey = 'm_id';
        $columns = array(
                array('db' => '`c`.`client_code`', 'dt' => 0,'field' =>'client_code' ),
                array('db' => '`m`.`install_date`', 'dt' => 1,'field' =>'install_date'),
                array('db' => '`c`.`client_name`', 'dt' => 2,'field' =>'client_name'),
                array('db' => '`c`.`client_phone`', 'dt' => 3,'field' =>'client_phone'),
                array('db' => '`c`.`client_address`', 'dt' => 4,'field' =>'client_address'),
                array('db' => '`ns`.`name`', 'dt' => 5,'field' =>'name'),
                array('db' => '`a`.`area_name`', 'dt' => 6,'field' =>'area_name'),
                array('db' => '`m`.`m_id`', 'dt' => 7,'field' =>'m_id','formatter' => function ($rowvalue, $row) {
                            return '<a  href="#" >
      <button class="btn btn-primary btn-xs" onclick="addModal('.$rowvalue.')">Add</button></a>';
                        })






        );




        $this->load->database();
        $sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
        );
        $today=date('Y-m-d');
        $this->load->library('SSP');
        //$joinQuery = "FROM `{$table}` AS `m`
       // JOIN `base_clients` AS `c` ON (`c`.`ci_id` = `m`.`ref_client_id`)  
		//JOIN `nsp_status` AS `ns` ON (`m`.`is_in_service` = `ns`.`id`)
       // JOIN `base_areas` AS `a` ON (`a`.`a_id` = `c`.`ref_area_id`)
       //  WHERE `m`.`m_id` NOT IN (SELECT ref_master_id FROM base_service_details) and `m`.`is_in_service`=1
       //   group by `m`.`ref_client_id` HAVING DATEDIFF('$today', max(`m`.`install_date`))>120";  

		$joinQuery = "FROM `{$table}` AS `m`  
		JOIN `base_service_details` AS `d` ON (`m`.`m_id` = `d`.`ref_master_id` AND `d`.`service_type`= 1) 
        JOIN `base_clients` AS `c` ON (`c`.`ci_id` = `m`.`ref_client_id`)  
		JOIN `nsp_status` AS `ns` ON (`m`.`is_in_service` = `ns`.`id`)
        JOIN `base_areas` AS `a` ON (`a`.`a_id` = `c`.`ref_area_id`)
        group by `d`.`ref_client_id` HAVING DATEDIFF('$today', max(`d`.`service_date`))>120";


        echo json_encode(
        SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery)
        );


    }
	
	 public function getDateSearch() { 
	 
		$fm = mysql_real_escape_string($this->input->post('date_from'));   
		$to = mysql_real_escape_string($this->input->post('date_to')); 
		
		$fmb4 = strtotime('-4 month', strtotime($fm));
		$fmb4 = date('Y-m-d', $fmb4);
		$tob4 = strtotime('-4 month', strtotime($to));
		$tob4 = date('Y-m-d', $tob4);

		$getTable = $this->common_model->getSpDateWise($fmb4, $tob4);
		echo  $getTable;
	 
	 }



    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
		
        $d_id = mysql_real_escape_string($this->input->post('d_id'));       
        
		
		
		$this->db->select('base_clients.ci_id, base_clients.client_code, base_clients.client_name, base_clients.client_address, base_clients.client_phone, 
		base_service_master.m_id, base_service_master.is_in_service, base_service_master.is_filter_change, sale.employee_name AS saler, install.employee_name AS installer, base_areas.area_name');
		
		$this->db->from('base_clients');
		$this->db->join('base_service_master', 'base_clients.ci_id = base_service_master.ref_client_id');
		$this->db->join('base_employees sale', 'sale.em_id  = base_service_master.ref_sale_by');
		$this->db->join('base_employees install', 'install.em_id  = base_service_master.ref_install_by');
		$this->db->join('base_areas', 'base_areas.a_id  = base_service_master.ref_area_id');
		
		$this->db->where('base_clients.ci_id', $d_id); 
		
		$result = $this->db->get();
		echo json_encode($result->result()); 


    }
	
	
	public function addTechnitian() {

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
	
	
        if (in_array($this->session->userdata('role_id'), $per_role_arr)){
            $data['base_url'] = $this->config->item('base_url');

            $cid = mysql_real_escape_string($this->input->post('req_id'));
            $m_id = mysql_real_escape_string($this->input->post('ref_cus_id'));
            $technitian = mysql_real_escape_string($this->input->post('add_technitian'));
            $add_notes = mysql_real_escape_string($this->input->post('add_notes'));
            $request_date = mysql_real_escape_string($this->input->post('request_date'));
			$user_id = $this->session->userdata('user_id');
			
            $clientresponse = mysql_real_escape_string($this->input->post('clientresponse'));
			if($clientresponse==1){
			
				$data = array(
				
					'ref_client_id' => $cid,
					'request_date' => date('Y-m-d H:i:s'),
					'technitian' => $technitian,
					'service_description' => 'From Genaral SP',
					'service_status' => 0,
					'is_active' => 1,
					'service_priority' => 5,
					'note_text' => $add_notes,
					'added_by' => $user_id,
					'added_time' => date('Y-m-d H:i:s')
				);
				$table_name='base_service_custom';
				$insert_result = $this->common_model->insertData($table_name,$data);
				
			}else{
				
				if($clientresponse==2){$clientresponse="Not Agree";}
				elseif($clientresponse==3){$clientresponse="Switch Off";}
				
				$data2 = array(
				
						'ref_master_id' => $m_id,
						'ref_client_id' => $cid,
						'service_date' => date('Y-m-d H:i:s'),
						'service_description' =>$clientresponse,
						'service_type'=>2,
						'service_status' => 1,
						'is_active' => 1,
						'service_priority' =>5,
						'note_text' => '',
						'general_or_request' => 1							
				);				
				
				$insert_result = $this->common_model->insertData('base_service_details', $data2);
				
				$spOrNsp=1;
				$get_result = $this->common_model->getDataWhere('base_service_master','m_id',$m_id);
				foreach ($get_result as $row) {					
					 
					$service_total=$row->service_total;
					$service_total=$service_total+1;
					if($service_total>3){ $spOrNsp=2; }
					$data2 = array(
						
						'service_date' => date('Y-m-d H:i:s'),
						'service_total' => $service_total,
						'is_in_service' => $spOrNsp
					);					
					$this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);

				}
				
				
			}
			
			
			
			$user_id = $this->session->userdata('user_id');
				
				 $data49 = array(
                    'uid' => $user_id,
					'action_name' => "General SP",
                    'datetime' => date('Y-m-d H:i:s')
                    
                );
                $table_name = 'user_record';
                $insert_result = $this->common_model->insertData($table_name, $data49);
			
			
			
			
			//$data = array(
			
				//'service_status'=>2,
				//'technitian'=>$technitian,
				//'note_text' => $add_notes,
				//'added_time' => $request_date				
            //);
            //$table_name='base_service_custom';
            //$insert_result = $this->common_model->updateData($table_name,$data,'cu_id',$req_id);
			
			
			if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
            redirect('general_request_sp');
	
		}
		
	 }


}
?>
