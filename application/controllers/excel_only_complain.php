<?php

class Excel_only_complain extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        //    $this->load->library('ExportXLS');
    }

	
	
    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1,2,3,4,5,6,7,8,9,10,11,12,13))):
            $data['base_url'] = $this->config->item('base_url');
			
			$date_from = mysql_real_escape_string($this->input->post('date_from'));
            $date_to = mysql_real_escape_string($this->input->post('date_to'));
		
            include_once 'excelclass/export-xls.class.php';
            $filename = 'excel_complete_report.xls';
            $xls = new ExportXLS($filename);
			

            $header[] = "Client Id";
			$header[] = "Client Name";
            $header[] = "Client Phone";
            $header[] = "Technical Name ";
			$header[] = "Type ";
            $header[] = "Status";
         
            $header[] = "Service Date";
            $header[] = "Notes";

            $xls->addHeader($header);
			
	      	function code($army_id)
			{
			 $sql_get_data ="select * from base_clients where ci_id = '$army_id' ";
			
		
            $results = mysql_query($sql_get_data);
            while($sql_get_data_result_2 = mysql_fetch_array($results))   // Date Filter
            {
			  $client_code = $sql_get_data_result_2['client_code'];
			}
			$nnn = mysql_num_rows($results);
			if($nnn==0)
			{
			$client_code=1;
			return $client_code;
			}
			else
			{
			
			return $client_code;
			}
			}
			
			
			
				function tech($army_id)
			{
			 $sql_get_data ="select * from base_employees where em_id = '$army_id' ";
			
		
            $results = mysql_query($sql_get_data);
            while($sql_get_data_result_2 = mysql_fetch_array($results))   // Date Filter
            {
			  $em_id = $sql_get_data_result_2['employee_name'];
			}
			$nnn = mysql_num_rows($results);
			if($nnn==0)
			{
			$em_id=0;
			return $em_id;
			}
			else
			{
			
			return $em_id;
			}
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
			function name($army_id)
			{
			 $sql_get_data ="select * from base_clients where ci_id = '$army_id' ";
			
		
            $results = mysql_query($sql_get_data);
            while($sql_get_data_result_2 = mysql_fetch_array($results))   // Date Filter
            {
			  $client_name = $sql_get_data_result_2['client_name'];
			}
			$nnn = mysql_num_rows($results);
			if($nnn==0)
			{
			$client_name=1;
			return $client_name;
			}
			else
			{
			
			return $client_name;
			}
			}
			
			
			function mobile($army_id)
			{
			 $sql_get_data ="select * from base_clients where ci_id = '$army_id' ";
			
		
            $results = mysql_query($sql_get_data);
            while($sql_get_data_result_2 = mysql_fetch_array($results))   // Date Filter
            {
			  $client_phone = $sql_get_data_result_2['client_phone'];
			}
			
			$nnn = mysql_num_rows($results);
			if($nnn==0)
			{
			$client_phone=1;
			return $client_phone;
			}
			else
			{
			
			return $client_phone;
			}
			}
			
			function insdate($army_id)
			{
			 $sql_get_data ="select * from base_clients where ci_id = '$army_id' ";
			
		
            $results = mysql_query($sql_get_data);
            while($sql_get_data_result_2 = mysql_fetch_array($results))   // Date Filter
            {
			  $amt = $sql_get_data_result_2['client_name'];
			}
			return $amt;
			}
			
			
         if($date_from=='' && $date_to=='')
		 {
		 $sql_get_data ="select * from base_service_details ";
		 }
		 else
		 {
		  $sql_get_data ="select * from base_service_details where date(service_date) between '$date_from' and '$date_to'";
		 }
		 
            $results = mysql_query($sql_get_data);
            while($sql_get_data_result = mysql_fetch_array($results))   // Date Filter
            {
			
			  
                $k = 0;
				
				$typ = $sql_get_data_result['service_type'];
				if($typ==1)
				{
				$tp = 'NSP';
				}
				else
				{
				$tp = 'SP';
				}
                $user_data[$k++] = code($sql_get_data_result['ref_client_id']);
				$user_data[$k++] = name($sql_get_data_result['ref_client_id']);
                $user_data[$k++] = mobile($sql_get_data_result['ref_client_id']);
                $user_data[$k++] = tech($sql_get_data_result['ref_emp_id']);
				$user_data[$k++] = $tp;
                $user_data[$k++] = 'Complete';
        
                $user_data[$k++] = $sql_get_data_result['service_date'];
                $user_data[$k++] = $sql_get_data_result['note_text'];


                $xls->addRow($user_data);
            }

            $xls->sendFile();

        else:
            redirect('home');
        endif;
    }





}
?>
