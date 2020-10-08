<?php
$con = mysql_connect('localhost','skrpcom_sknew','7pFfT%3Wk%bT'); 
$db = mysql_select_db('skrpcom_sknew', $con);
if(!$db){ echo mysql_error(); }else{ 

$query2 = mysql_query("Select * From table28"); $x=0;

	 
		for($i=1; $i<11229;$i++){ 
			$query = mysql_query("Select * From base_clients Where ci_id='$i'");
			if(mysql_num_rows($query) == 0){			
				$cids[$x] =  $i;	$x++;	
			}
		}
	 
	//print_r($cids);
	$err='';
	$x=0;
		while($r = mysql_fetch_array($query2)){
			
			$new = trim($r['COL2']);  
			$name = mysql_real_escape_string($r['COL3']);
			$addrss = mysql_real_escape_string($r['COL4']);
			$phone = mysql_real_escape_string($r['COL5']);
			$addTime = date('Y-m-d H:i:s', strtotime($r['COL1']));
			$addDate = date('Y-m-d', strtotime($r['COL1']));			
			$cid = $cids[$x];					
				
			$client = mysql_query("INSERT INTO `base_clients` (`ci_id`, `ref_area_id`, `client_code`, `client_name`, `client_address`, `client_phone`, `is_in_service`, `is_active`, `date_of_birth`, `email_address`, `added_by`, `added_time`) 
			VALUES ('$cid', '1', '$new', '$name', '$addrss', '$phone', '1', '1', '', '', '1', '$addTime')");
			
			if(!$client){ $err .= mysql_error(); }
			
			
			mysql_query("INSERT INTO `base_service_master` (`ref_client_id`, `ref_sale_by`, `ref_install_by`, `ref_area_id`, `ref_model_id`, `dealer_id`, `install_date`, `service_date`, `filter_date`, `service_total`, `is_in_service`, `is_active`, `default`, `is_filter_change`) 
			VALUES ('$cid',  '1', '1', '1', '1', '1', '$addDate', '$addDate', '$addDate', '0', '1', '1', '0', '0')");
			
			
			mysql_query("INSERT INTO `base_filter_changes` (`ref_client_id`, `change_date`, `change_note`) 
			VALUES ('$cid', '$addDate', 'Changed before 1 years')");
			
			
			$x++; 
			
			//echo $cid;
			
			
		}
		
		echo $err;
}


?>