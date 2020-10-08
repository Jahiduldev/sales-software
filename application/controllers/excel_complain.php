<?php

class Excel_complain extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        //    $this->load->library('ExportXLS');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1,2,3,4,5,6,7,8,9,10,11,12,13))):
            $data['base_url'] = $this->config->item('base_url');
            include_once 'excelclass/export-xls.class.php';
            $filename = 'excel_others_service_report.xls';
            $xls = new ExportXLS($filename);

            $header[] = "Client Id";
			$header[] = "Client Name";
            $header[] = "Client Phone";
            $header[] = " Type";
            $header[] = "Status";
            $header[] = "Installation Date";
            $header[] = "Request Date";
            $header[] = "Complain By";

            $xls->addHeader($header);

            $sl=1; $data =''; $today = date('Y-m-d');
			$this->db->select('*');
			$this->db->from('base_service_custom');
			
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');		
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_clients.ci_id');		
			
		
		
			$query = $this->db->get(); 			
			foreach ($query->result() as $row){	
			
				if($row->is_in_service!=1){ $spNsp = 'NSP'; }else{ $spNsp = 'SP'; }
				
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='Not Assign Technitian'; }
				else if($service_statu==2){ $serstatus='Pending'; }
				else if($service_statu==3){ $serstatus='Reschedule'; }
				else{ $serstatus='Completed'; }
				
				if($row->service_priority==1) {	$priority='Managment';} else if($row->service_priority==2) {
				$priority='Dealer';	} else if($row->service_priority==3) {$priority='Customer Care'; }
				else if($row->service_priority==4) {$priority='Otehrs';} else if($row->service_priority==5) {
				$priority='Genaral Service'; } else { $priority=''; }			
				
				if(strtotime($row->request_date) < strtotime($today)){ 
				$dates = $row->request_date; 
				}else{
					$dates = $row->request_date; 
				}

                $k = 0;
                $user_data[$k++] = $row->client_code;
				$user_data[$k++] = $row->client_name;
                $user_data[$k++] = $row->client_phone ;
                $user_data[$k++] = $spNsp;
                $user_data[$k++] = $serstatus;
                $user_data[$k++] = $row->install_date;
                $user_data[$k++] = $dates ;
                $user_data[$k++] = $priority;


                $xls->addRow($user_data);
            }

            $xls->sendFile();

        else:
            redirect('home');
        endif;
    }





}
?>
