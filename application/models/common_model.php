<?php 

class Common_Model extends CI_Model {
    public  function  __construct() {
        parent::__construct();
    }

    public function insertData($table_name,$data) {
        return $this->db->insert($table_name, $data);
    }



    public function updateData($table_name,$data,$column_name,$column_value) {
        $this->db->where($column_name, $column_value);
        return  $this->db->update($table_name, $data);
    }



    public function updateData2($table_name,$data,$column_name,$column_value,$column_name2,$column_value2) {
        $this->db->where($column_name, $column_value);
        $this->db->where($column_name2, $column_value2);
        return  $this->db->update($table_name, $data);
    }



    public function insertDataGetId($table_name,$data) {
        $this->db->insert($table_name, $data);
        return  $this->db->insert_id();
    }



    public function getData($table_name) {
        $query= $this->db->get($table_name);
        return $query->result();
    }
    
    public function getData_model($table_name) {  	
		$this->db->where('is_active', 1);
        $query= $this->db->get($table_name);
        return $query->result();
    }
	

    public function getDataLimit($table_name,$offset,$rownum) {
        $this->db->limit($offset,$rownum);
        $query= $this->db->get($table_name);

        return $query->result();
    }

    public function getDataWhere($table_name,$column_name,$column_value) {
        $this->db->where($column_name, $column_value);
        $query= $this->db->get($table_name);
        return $query->result();
    }
	
	public function getDataWhereOrdeby($table_name,$column_name,$column_value) {
        $this->db->where($column_name, $column_value);
		$this->db->order_by('cu_id');
        $query= $this->db->get($table_name);
        return $query->result();
    }

   public function getDataWhere2($table_name,$column_name,$column_value,$column_name2,$column_value2) {
        $this->db->where($column_name, $column_value);
         $this->db->where($column_name2, $column_value2);
        $query= $this->db->get($table_name);
        return $query->result();
    }
	
	public function getDataOrWhere1($table_name,$column_name,$column_value,$column_value2) {
        $this->db->where($column_name, $column_value);
         $this->db->or_where($column_name, $column_value2);
        $query= $this->db->get($table_name);
        return $query->result();
    }
	
	public function getDataOrWhere($table_name,$column_name,$column_value,$column_value2,$column_value3) {
        $this->db->where($column_name, $column_value);
         $this->db->or_where($column_name, $column_value2);
         $this->db->or_where($column_name, $column_value3);
        $query= $this->db->get($table_name);
        return $query->result();
    }
	
	public function getDataWhere2IsExist($table_name,$column_name,$column_value,$column_name2,$column_value2) {
        $this->db->where($column_name, $column_value);
         $this->db->where($column_name2, $column_value2);
        $query= $this->db->get($table_name);
        return $query->num_rows();
    }

    public function joinDataWhere($table_name1,$table_name2,$column_name1,$column_name2,$column_name3,$column_value) {
        
		$this->db->select('*');
        $this->db->from($table_name1);
        $this->db->join($table_name2,$table_name1.".".$column_name1 ."=".$table_name2.".".$column_name2);
        $this->db->where($column_name3,$column_value);
        $query= $this->db->get();
        return $query->result();
		
    }

    public function deleteData($table_name,$column_name,$column_value) {
        
		$this->db->where($column_name, $column_value);
        return $this->db->delete($table_name);

    }
	
	public function getTechnitian($tech=false) {
        
		$data ='';
		$this->db->where('ref_type_id', 2);
        $query = $this->db->get('base_employees');
		foreach($query->result() as $row){
			if($tech!='' && $tech==$row->em_id){			
				$data .= '<option selected value="'.$row->em_id.'">'.$row->employee_name.'</option>';
			}else{
				$data .= '<option value="'.$row->em_id.'">'.$row->employee_name.'</option>';
				
			}			
		}
		return $data;
    }


public function checkComplian($clientid) {
        
		
        $this->db->where('ref_client_id', $clientid);
        $query = $this->db->get('base_service_custom');
	
	   
         if($query->num_rows()==0){			
	       return true;
	   }else{
	       return false;
				
	   }			
	
		
    }

   public function getzones($zone=false) {
        
	$data ='';		
        $query = $this->db->get('base_areas');
	    foreach($query->result() as $row){
		if($zone!='' && $zone==$row->a_id){			
			$data .= '<option selected value="'.$row->a_id.'">'.$row->area_name.'</option>';
		}else{
			$data .= '<option value="'.$row->a_id.'">'.$row->area_name.'</option>';
				
		}			
	}
	return $data;
    }


    public function joinData($table_name1,$table_name2,$column_name1,$column_name2,$join) {
        $this->db->select('*');
        $this->db->from($table_name1);
        $this->db->join($table_name2, $column_name1 =$column_name2,$join);
        $query = $this->db->get();
        return $query->result();
    }
	
	
	public function autoExpireNSP() {
		
		
		
		$today = strtotime(date('Y-m-d'));
		$befor = date('Y-m-d', strtotime('-135 day', $today));		
		$after = date('Y-m-d', strtotime('-4 month', $today));		
		$sl=1; $data ='';		
		
		
		$this->db->where('service_date <', $after);
		$this->db->where('service_date >', $befor);	
		$query = $this->db->get('base_service_master');		
		
		foreach($query->result() as $row){
			
			
			$spOrNsp=1;			
			$service_total = $row->service_total;
			$service_total = $service_total+1;
			
			if($service_total>3){ $spOrNsp=2; }			
			$data2 = array(
				
				'service_date' => date('Y-m-d'),
				'service_total' => $service_total,
				'is_in_service' => $spOrNsp				
			);			
			$this->db->where('m_id', $row->m_id);
			$this->db->update('base_service_master', $data2);

			$data4 = array(
				
				'ref_master_id' => $row->m_id,
				'ref_client_id' => $row->ref_client_id,
				'ref_emp_id' => 0,
				'service_date' => date('Y-m-d'),
				'service_description' =>'Auto Expire',
				'service_type'=>$spOrNsp,
				'service_status' => 0,
				'is_active' => 0,
				'service_priority' =>0,
				'note_text' => 'Auto Expire',
				'general_or_request' => 1							
			);		
			$insert_result = $this->db->insert('base_service_details',$data4);	
			
		}
		
		
		
		$filterAfter = date('Y-m-d', strtotime('-1 year', $today));
		$filterBefor = date('Y-m-d', strtotime('-380 day', $today));
		
		$this->db->where('filter_date <', $filterAfter);
		$this->db->where('filter_date >', $filterBefor);	
		$query = $this->db->get('base_service_master');		
		
		foreach($query->result() as $row){
			
			
			$spOrNsp=1;			
			$service_total = $row->service_total;
			$service_total = $service_total+1;
			
			if($service_total>3){ $spOrNsp=2; }			
			$data2 = array(
				
				'filter_date' => date('Y-m-d'),
				'service_total' => $service_total,
				'is_in_service' => $spOrNsp				
			);			
			$this->db->where('m_id', $row->m_id);
			$this->db->update('base_service_master', $data2);	

			$data3 = array(
					
				'ref_client_id' => $row->ref_client_id,							
				'change_date' => date('Y-m-d'),
				'change_note' => 'Auto Expire'
			);			
			$insert_result = $this->db->insert('base_filter_changes',$data3);
			
		}
		
		//$this->db->where('service_date <', $after);
		//$this->db->where('service_date >', $befor);	
		//$query = $this->db->get('base_service_master');			
		//foreach($query->result() as $row){			
			//$data .= $sl.' /'.$row->m_id.'/ '.$row->service_date.'<br>'; 
			//$sl++;
		//}
		//return $data;		
		
	}
	
	public function getNsp() {
		
		$today = strtotime(date('Y-m-d'));
		$befor = date('Y-m-d', strtotime('-4 month', $today));		
		$sl=1; $data ='';		
		
		$this->db->select('*');
		$this->db->from('base_service_master');
		//$this->db->join('base_service_custom', 'base_service_custom.ref_client_id = base_service_master.ref_client_id', 'left');
		$this->db->join('base_clients', 'base_clients.ci_id = base_service_master.ref_client_id');
		$this->db->join('base_areas', 'base_areas.a_id = base_service_master.ref_area_id');		
		
		//$this->db->where('base_service_master.ref_client_id', 'base_service_custom.ref_client_id');
		$this->db->where('base_service_master.is_in_service', 2);
		$this->db->where('base_service_master.service_date <=', $befor);
		
		$query = $this->db->get();
		foreach($query->result() as $row){
			
			$this->db->where('ref_client_id', $row->ref_client_id);
			$numrow = $this->db->get('base_service_custom')->num_rows();
			if($row->default==1){ $default='<span style="color:red">Yes</span>'; }else { $default='No'; }
			if($row->is_in_service == 2){ $status = 'NSP';}else{ $status = 'NSP';}
			if($numrow==0){	
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->install_date .'</td>
					<td>'. $row->client_name .'</td>
					<td>'. $row->client_phone .'</td>
					<td>'. $row->client_address .'</td>
					<td>'. $default .'</td>
					<td>'. $status .'</td>
					<td>'. $row->area_name .'</td>
					<td><button class="btn btn-primary btn-xs" onclick="addModal('.$row->ref_client_id.')">
					Add</button></td>
				</tr>'; $sl++;
			}
		}
		
		return $data;
		
	}
	
	public function getNspDateWise($fm, $to){
		
		
		$sl=1; $data ='';
		$this->db->select('*');
		$this->db->from('base_service_master');
		$this->db->join('unique_service_details', 'unique_service_details.ref_master_id = base_service_master.m_id');
		$this->db->join('base_clients', 'base_clients.ci_id = base_service_master.ref_client_id');
		$this->db->join('base_areas', 'base_areas.a_id = base_service_master.ref_area_id');		
		$this->db->where('base_service_master.is_in_service', 2);
		
		$this->db->where('base_service_details.service_date >=', $fm);
		$this->db->where('base_service_details.service_date <=', $to);
		
		$query = $this->db->get();
		foreach($query->result() as $row){
			
			$this->db->where('ref_client_id', $row->ref_client_id);
			$numrow = $this->db->get('base_service_custom')->num_rows();
			if($row->default==1){ $default='<span style="color:red">Yes</span>'; }else { $default='No'; }
			if($numrow==0){
				$data .= '<tr>
					<td>'.$sl.'</td>
					<td>'.$row->client_code.'</td>
					<td>'.$row->install_date.'</td>
					<td>'.$row->client_name.'</td>
					<td>'.$row->client_phone.'</td>
					<td>'.$row->client_address.'</td>
					<td>'. $default .'</td>
					<td>NSP</td>
					<td>'.$row->area_name.'</td>
					<td>
						<button class="btn btn-primary btn-xs" onclick="addModal('.$row->ref_client_id.')">Add</button>
					</td>
				</tr>'; $sl++;
			}
		}		
		return $data;
		
	}
	
	
	public function getSp() {
		
		$today = strtotime(date('Y-m-d'));
		$befor = date('Y-m-d', strtotime('-4 month', $today));
		$sl=1; $data ='';
		$this->db->select('*');
		$this->db->from('base_service_master');
		//$this->db->join('unique_service_details', 'unique_service_details.ref_master_id = base_service_master.m_id');
		$this->db->join('base_clients', 'base_clients.ci_id = base_service_master.ref_client_id');
		$this->db->join('base_areas', 'base_areas.a_id = base_service_master.ref_area_id');		
		$this->db->where('base_service_master.is_in_service', 1);
		$this->db->where('base_service_master.service_date <=', $befor);
		$query = $this->db->get();
		foreach($query->result() as $row){
			
			$this->db->where('ref_client_id', $row->ref_client_id);
			$numrow = $this->db->get('base_service_custom')->num_rows();
			if($row->default==1){ $default='<span style="color:red">Yes</span>'; }else { $default='No'; }
			$status = 'SP';
			 if($numrow==0){	
				$data .= '<tr>
					<td>'.$sl.'</td>
					<td>'.$row->client_code .'</td>
					<td>'.$row->install_date .'</td>
					<td>'.$row->client_name .'</td>
					<td>'.$row->client_phone .'</td>
					<td>'.$row->client_address .'</td>
					<td>'. $default .'</td>
					<td>'.$status .'</td>
					<td>'.$row->area_name .'</td>
					<td>
						<button class="btn btn-primary btn-xs" onclick="addModal('.$row->ref_client_id.')">Add</button>
					</td>
				</tr>'; $sl++;
			}
		}
		
		return $data;
		
	}
	
	public function getSpDateWise($fm, $to){		
		
		$sl=1; $data ='';
		$this->db->select('*');
		$this->db->from('base_service_master');
		$this->db->join('unique_service_details', 'unique_service_details.ref_master_id = base_service_master.m_id');
		$this->db->join('base_clients', 'base_clients.ci_id = base_service_master.ref_client_id');
		$this->db->join('base_areas', 'base_areas.a_id = base_service_master.ref_area_id');		
		$this->db->where('base_service_master.is_in_service', 1);
		
		$this->db->where('base_service_details.service_date >=', $fm);
		$this->db->where('base_service_details.service_date <=', $to);
		
		$query = $this->db->get();
		foreach($query->result() as $row){
			
			$this->db->where('ref_client_id', $row->ref_client_id);
			$numrow = $this->db->get('base_service_custom')->num_rows();
			if($row->default==1){ $default='<span style="color:red">Yes</span>'; }else { $default='No'; }
			if($numrow==0){	
				$data .= '<tr>
					<td>'.$sl.'</td>
					<td>'.$row->client_code.'</td>
					<td>'.$row->install_date.'</td>
					<td>'.$row->client_name.'</td>
					<td>'.$row->client_phone.'</td>
					<td>'.$row->client_address.'</td>
					<td>'. $default .'</td>
					<td>SP</td>
					<td>'.$row->area_name.'</td>
					<td><button class="btn btn-primary btn-xs" onclick="addModal('.$row->ref_client_id.')">Add</button></td>
				</tr>'; $sl++;
			}	
		}		
		return $data;
		
	}
	
	public function getFilter() {
		
		$today = strtotime(date('Y-m-d'));
		$befor = date('Y-m-d', strtotime('-1 year', $today));
		$sl=1; $data ='';
		
		$this->db->select('*');
		//$this->db->from('unique_service_details');		
		//$this->db->join('base_clients', 'base_clients.ci_id = unique_service_details.ref_client_id');			
		//$this->db->where('unique_service_details.is_active', '1');				
		//$this->db->where('unique_service_details.service_date <=', $befor);	

		$this->db->from('base_service_master');
		//$this->db->join('unique_service_details', 'unique_service_details.ref_master_id = base_service_master.m_id');
		$this->db->join('base_clients', 'base_clients.ci_id = base_service_master.ref_client_id');
		//$this->db->join('base_areas', 'base_areas.a_id = base_service_master.ref_area_id');		
		//$this->db->where('base_service_master.is_in_service', 1);
		$this->db->where('base_service_master.filter_date <=', $befor);
		
		$query = $this->db->get('');
		foreach($query->result() as $row){
			
			$this->db->where('ref_client_id', $row->ci_id);
			$numrow = $this->db->get('base_service_custom')->num_rows();
			if($row->default==1){ $default='<span style="color:red">Yes</span>'; }else { $default='No'; }
			if($numrow==0){	 	
				$data .= '<tr>			
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td>
					<td>'. $row->client_phone .'</td>
					<td>'. $row->client_address .'</td>
					<td>'. $default .'</td>				
					<td><button class="btn btn-primary btn-xs" onclick="addModal('. $row->ci_id .')">Add</button></td>
				</tr>'; $sl++;
			}	
			
		}
		
		return $data;
		
	}
	
	
	public function getFilterDateWise($fm, $to){		
		
		$sl=1; $data ='';
		$this->db->select('*');
		$this->db->from('base_service_master');
		$this->db->join('unique_service_details', 'unique_service_details.ref_master_id = base_service_master.m_id');
		$this->db->join('base_clients', 'base_clients.ci_id = base_service_master.ref_client_id');
		$this->db->join('base_areas', 'base_areas.a_id = base_service_master.ref_area_id');		
		$this->db->where('unique_service_details.is_active', 1);
		
		$this->db->where('base_service_master.filter_date >=', $fm);
		$this->db->where('base_service_master.filter_date <=', $to);
		
		$query = $this->db->get();
		foreach($query->result() as $row){
			
			$this->db->where('ref_client_id', $row->ref_client_id);
			$numrow = $this->db->get('base_service_custom')->num_rows();	
			if($row->default==1){ $default='<span style="color:red">Yes</span>'; }else { $default='No'; }
			if($numrow==0){		
				$data .= '<tr>
					<td>'.$sl.'</td>
					<td>'.$row->client_code.'</td>
					<td>'.$row->client_name.'</td>
					<td>'.$row->client_phone.'</td>
					<td>'.$row->client_address.'</td>
					<td>'. $default .'</td>
					<td><button class="btn btn-primary btn-xs" onclick="addModal('.$row->ref_client_id.')">Add</button></td>
				</tr>'; $sl++;
			}
		}		
		return $data;
		
	}
	
	
	public function getTechDateWise($fm, $to, $type, $tech){		
		
		$sl=1; $data ='';$today = date('Y-m-d');
		if($type!=1 || $type==''){
			
			$this->db->select('*, base_service_custom.added_time');
			$this->db->from('base_service_custom');
			
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');		
			$this->db->join('base_employees', 'base_employees.em_id = base_service_custom.technitian');		
			$this->db->where('base_service_custom.technitian !=', '0');
			
			if($fm != '' && $to != ''){	
			
				$this->db->where('base_service_custom.request_date >=', $fm);
				$this->db->where('base_service_custom.request_date <=', $to);	
			}
			
			if($type !=''){ $this->db->where('base_service_custom.service_status', $type); }
			$this->db->where('base_service_custom.technitian', $tech); 
			
			$query = $this->db->get();
			foreach($query->result() as $row){ $status=''; $priority='';			
			
				if($row->is_in_service == 2){ $status = 'NSP'; }else{ $status = 'SP'; }
				$service_priority = $row->service_priority;
				if($service_priority==1) { $priority='Managment';
				}else if($service_priority==2) { $priority='Dealer';
				}else if($service_priority==3) { $priority='Customer Care';
				}else if($service_priority==4) { $priority='Otehrs';
				}else if($service_priority==5) { $priority='Genaral Service';
				}else {	$priority=''; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>'; }
				else if($service_statu==2){ $serstatus='<span style="color:maroon;">Pending</span>'; }
				else if($service_statu==3){ $serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }
				
				$assign_date=date('Y-m-d', strtotime($row->added_time));
				if(strtotime($row->request_date) < strtotime($today)){ 
				$dates = '<span style="color:red;">'.$row->request_date.'</span>'; 
				}else{
					$dates = $row->request_date; 
				}
				
				
				$data .= '<tr>
					<td>'.$sl.'</td>
					<td>'.$row->client_code.'</td>
					<td>'.$row->client_name.'</td>
					<td>'.$row->client_address.'</td>
					<td>'.$row->client_phone.'</td>
					<td>'. $status .'</td>
					<td>'. $serstatus .'</td>
					<td>'. $assign_date.'</td>
					<td>'. $dates.'</td>
					<td>'.$row->employee_name.'</td> 
					<td>'. $priority .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
      <button class="btn btn-primary btn-xs">Details</button></a></td>				
				</tr>'; $sl++;	
			}				
			
				
			
			
		}else{
			
			$this->db->from('base_service_details');
			
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_details.ref_client_id');		
			$this->db->join('base_employees', 'base_employees.em_id = base_service_details.ref_emp_id');		
			
			//$this->db->group_by('base_service_details.ref_client_id');
			
			if($fm != '' && $to != ''){	 
			
				$this->db->where('base_service_details.service_date >=', $fm);
				$this->db->where('base_service_details.service_date <=', $to);				
			}
			$this->db->where('base_service_details.ref_emp_id', $tech); 
						
		 
			$query = $this->db->get();
			foreach($query->result() as $row){ $status=''; $priority='';	

				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>'; }
				else if($service_statu==2){ $serstatus='<span style="color:maroon;">Pending</span>'; }
				else if($service_statu==3){ $serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }
				
				if($row->is_in_service == 2){ $status = 'NSP'; }else{ $status = 'SP'; }				
				
				$data .= '<tr>
					<td>'.$sl.'</td>
					<td>'.$row->client_code.'</td>
					<td>'.$row->client_name.'</td>
					<td>'.$row->client_address.'</td>
					<td>'.$row->client_phone.'</td>
					<td>'. $status .'</td>
					<td>'. $serstatus .'</td>
					<td>'. $row->service_date.'</td>
					<td>'.$row->employee_name.'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
      <button class="btn btn-primary btn-xs">Details</button></a></td>				
				</tr>'; $sl++;			
				
			}	
		}	
		
		return $data;
		
		
	}
	public function getProccessData($type, $fm, $to){
		
		$sl=1; $data =''; $today = date('Y-m-d');
		
		if($type!=1){
			$this->db->select('*');
			$this->db->from('base_service_custom');
			
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');		
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_clients.ci_id');		
			
			$this->db->where('base_service_custom.service_status', $type);
			
			if($fm != '' && $to != ''){	
				
				$this->db->where('base_service_custom.request_date >=', $fm);
				$this->db->where('base_service_custom.request_date <=', $to);	
			}
			
			$query = $this->db->get(); 			
			foreach ($query->result() as $row){	
			
				if($row->is_in_service!=1){ $spNsp = 'NSP'; }else{ $spNsp = 'SP'; }
				
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>'; }
				else if($service_statu==2){ $serstatus='<span style="color:maroon;">Pending</span>'; }
				else if($service_statu==3){ $serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }
				
				if($row->service_priority==1) {	$priority='Managment';} else if($row->service_priority==2) {
				$priority='Dealer';	} else if($row->service_priority==3) {$priority='Customer Care'; }
				else if($row->service_priority==4) {$priority='Otehrs';} else if($row->service_priority==5) {
				$priority='Genaral Service'; } else { $priority=''; }			
				
				if(strtotime($row->request_date) < strtotime($today)){ 
				$dates = '<span style="color:red;">'.$row->request_date.'</span>'; 
				}else{
					$dates = $row->request_date; 
				}
				
				$data .='<tr class="gradeX">
					<td class="hidden-phone">'. $sl .'</td>
					<td class="hidden-phone">'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td>
					<td class="hidden-phone">'. $row->client_phone .'</td>
					<td class="hidden-phone">'. $spNsp .'</td>
					<td class="hidden-phone">'. $serstatus .'</td>
					<td class="hidden-phone">'. $row->install_date .'</td>
					<td class="hidden-phone">'. $dates .'</td>
					<td class="hidden-phone">'. $priority .'</td>			    
					<td class="hidden-phone"><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
      <button class="btn btn-primary btn-xs">Details</button></td>			    
				</tr>'; $sl++;	
				
			} 
		}else{
			$total='';
			if($fm == '' && $to == ''){ $limit=1000; $limitfrm=1;
				$total = $this->db->get('base_service_details')->num_rows(); 
				$step = (int)($total/$limit); $laststep = $total%1000; $ix=1;
				//for($i=1; $i<=$step; $i++){ $limitto=$limit*$i;  
					
					//$this->db->select('base_clients.client_code, base_clients.client_name, 
					//base_clients.client_phone, base_service_details.service_date, base_service_master.is_in_service,
					//base_service_master.install_date');
					
					$this->db->from('base_service_details');
					//$this->db->join('base_clients', 'base_clients.ci_id = base_service_details.ref_client_id');		
					//$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_details.ref_client_id');		
					//$this->db->limit($limitfrm, $limitto);
					$query = $this->db->get(); 
					foreach ($query->result() as $row){
				
						if($this->MasterIsinSer($row->ref_client_id) !=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }					
						$serstatus='Completed'; 						
						$data .='<tr class="gradeX">
						
							<td class="hidden-phone">'. $sl .'</td>
							<td class="hidden-phone">'; $data .= $this->ClientCode($row->ref_client_id); $data .='</td>
							<td>'; $data .= $this->ClientName($row->ref_client_id); $data .='</td>
							<td class="hidden-phone">'; $data .= $this->ClientPhone($row->ref_client_id); $data .='</td>
							<td class="hidden-phone">'. $spNsp .'</td>
							<td class="hidden-phone">'. $serstatus .'</td> 
							<td class="hidden-phone">'; $data .= $this->MasterInstall($row->ref_client_id); $data .='</td>
							<td class="hidden-phone">'. $row->service_date .'</td>
									
						</tr>'; $sl++;	
						
					}				
					//$limitfrm=$limitto+1;
					
				//}
			
			}else{
			
				//$this->db->select('base_clients.client_code, base_clients.client_name, base_clients.client_phone, base_service_details.service_date,
				//base_service_details.ref_client_id, base_service_master.is_in_service, base_service_master.install_date');
				
				$this->db->from('base_service_details');			
				
				$this->db->join('base_clients', 'base_clients.ci_id = base_service_details.ref_client_id');		
				$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_details.ref_client_id');		
									
				$this->db->where('base_service_details.service_date >=', $fm);
				$this->db->where('base_service_details.service_date <=', $to);
				$this->db->group_by('base_service_details.service_date');
				$this->db->group_by('base_service_details.ref_client_id');
				
				$query = $this->db->get(); 		
				foreach ($query->result() as $row){
				
					if($row->ref_client_id !=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }					
					$serstatus='Completed'; 						
					$data .='<tr class="gradeX">
					
						<td class="hidden-phone">'. $sl .'</td>
						<td class="hidden-phone">'. $row->client_code .'</td>
						<td>'. $row->client_name .'</td>
						<td class="hidden-phone">'. $row->client_phone .'</td>
						<td class="hidden-phone">'. $spNsp .'</td>
						<td class="hidden-phone">'. $serstatus .'</td> 
						<td class="hidden-phone">'. $row->install_date .'</td>
						<td class="hidden-phone">'. $row->service_date .'</td>	
						<td class="hidden-phone"><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
      <button class="btn btn-primary btn-xs">Details</button></td>	
					</tr>'; $sl++;	
					
				} 
			}
		}
		return $data;	
	}
	
	
	
	
	
	
	public function getAuditData($type, $fm, $to){
		
		$sl=1; $data =''; $today = date('Y-m-d');
		
			$total='';
			if($fm == '' && $to == '' && $type==''){ 
			
			
				$this->db->select('*');
				   		
					 $this->db->from('user_record');
				
					$query = $this->db->get(); 
					foreach ($query->result() as $row){
				
											
							$data .='<tr class="gradeX">
					<td class="hidden-phone">'. $sl .'</td>
					<td class="hidden-phone">'. $this->UserName($row->uid) .'</td>
					<td>'. $row->action_name .'</td>
					<td class="hidden-phone">'. $row->datetime .'</td>
							    
				</tr>'; $sl++;	
						
					}				
				
			
			}
			
			
			else if($fm == '' && $to == '')
			{
			
				$this->db->select('*');
				   		
					 $this->db->from('user_record');
				    $this->db->where('uid =', $type);
					$query = $this->db->get(); 
					foreach ($query->result() as $row){
				
											
							$data .='<tr class="gradeX">
					<td class="hidden-phone">'. $sl .'</td>
					<td class="hidden-phone">'. $this->UserName($row->uid) .'</td>
					<td>'. $row->action_name .'</td>
					<td class="hidden-phone">'. $row->datetime .'</td>
							    
				</tr>'; $sl++;	
			}
			}
			else{
			
			
				
				$this->db->from('user_record');	
                $this->db->where('uid =', $type);				
				$this->db->where('datetime >=', $fm);
				$this->db->where('datetime <=', $to);
				
				
				$query = $this->db->get(); 		
				foreach ($query->result() as $row){
				
										
					$data .='<tr class="gradeX">
						
					<td class="hidden-phone">'. $sl .'</td>
					<td class="hidden-phone">'. $this->UserName($row->uid).'</td>
					<td>'. $row->action_name .'</td>
					<td class="hidden-phone">'. $row->datetime .'</td>
									
						</tr>'; $sl++;	
					
				} 
			}
		
		return $data;	
	}
	
	

public function updateInstall() {
		
		$this->db->select('base_clients.ci_id, base_clients.client_code, base_service_master.install_date, base_clients.client_name, base_clients.client_phone, sale.employee_name AS saler, 
		install.employee_name AS installer, base_areas.area_name');
		
		$this->db->from('base_clients');
		
		$this->db->join('base_service_master', 'base_clients.ci_id = base_service_master.ref_client_id');
		$this->db->join('base_employees sale', 'sale.em_id  = base_service_master.ref_sale_by');
		$this->db->join('base_employees install', 'install.em_id  = base_service_master.ref_install_by');
		$this->db->join('base_areas', 'base_areas.a_id  = base_service_master.ref_area_id');
		
		$this->db->where('base_clients.is_active', 0);
		
		$query = $this->db->get();
        
		return $query->result();
    }
	
	
	
	
	
	
	
		
	public function ClientName($ci_id){
		
		$this->db->where('ci_id', $ci_id);
		$query = $this->db->get('base_clients');
		$result = $query->row();
		$client = $result->client_name;
		return $client;
	}
	public function ClientCode($ci_id){
		
		$this->db->where('ci_id', $ci_id);
		$query = $this->db->get('base_clients');
		$result = $query->row();
		$client = $result->client_code;
		return $client;
	}
	public function ClientPhone($ci_id){
		
		$this->db->where('ci_id', $ci_id);
		$query = $this->db->get('base_clients');
		$result = $query->row();
		$client = $result->client_phone;
		return $client;
	}
	
	public function MasterInstall($ref_ci_id){
		
		$this->db->where('ref_client_id', $ref_ci_id);
		$query = $this->db->get('base_service_master');
		$result = $query->row();
		$master = $result->install_date;
		return $master;
	}
	
	public function MasterIsinSer($ref_ci_id){
		
		$this->db->where('ref_client_id', $ref_ci_id);
		$query = $this->db->get('base_service_master');
		$result = $query->row();
		$master = $result->is_in_service;
		return $master;
	}
	
	public function technitianName($em_id){
		
		$this->db->where('em_id', $em_id);
		$query = $this->db->get('base_employees');
		$result = $query->row();
		$master = $result->employee_name;
		return $master;
	}
	
	
	public function UserName($em_id){
		
		$this->db->where('user_id', $em_id);
		$query = $this->db->get('user');
		$result = $query->row();
		$master = $result->name;
		return $master;
	}
	
	
	public function servicedetails($service,$uid) {
        
		$data =''; $sl=1;
		
		if($service=='complains'){
			
			$this->db->from('base_service_custom');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_custom.ref_client_id');		
			//$this->db->join('base_employees', 'base_employees.em_id = base_service_custom.technitian');	
			$this->db->where('base_service_custom.added_by', $uid);
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
			if($row->technitian==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->technitian); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $serstatus .'</td>					
					 
					<td>'. $row->request_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					 
				
			}
		}
		
		elseif($service=='complains_all'){
			
			$this->db->from('base_service_custom');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_custom.ref_client_id');		
			//$this->db->join('base_employees', 'base_employees.em_id = base_service_custom.technitian');	
			//$this->db->where('base_service_custom.added_by', $uid);
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
			if($row->technitian==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->technitian); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $serstatus .'</td>					
					 
					<td>'. $row->request_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					 
				
			}
		}
		
		elseif($service=='complains_today'){
			
			$today = date('Y-m-d');
			$this->db->from('base_service_custom');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_custom.ref_client_id');		
			//$this->db->join('base_employees', 'base_employees.em_id = base_service_custom.technitian');	
			$this->db->where('base_service_custom.added_by', $uid);			 
			$this->db->like('base_service_custom.added_time', $today);
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
			if($row->technitian==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->technitian); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $serstatus .'</td>							
					 
					<td>'. $row->request_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					 
				
			}
		}
		
		elseif($service=='complains_today_all'){
			
			$today = date('Y-m-d');
			$this->db->from('base_service_custom');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_custom.ref_client_id');		
			//$this->db->join('base_employees', 'base_employees.em_id = base_service_custom.technitian');	
			//$this->db->where('base_service_custom.added_by', $uid);			 
			$this->db->like('base_service_custom.added_time', $today);
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
			if($row->technitian==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->technitian); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $serstatus .'</td>							
					 
					<td>'. $row->request_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					 
				
			}
		}
		
		
		
		
		
		elseif($service=='technitians'){
			
			$today = date('Y-m-d');
			$this->db->from('base_service_custom');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_custom.ref_client_id');		
			
			$this->db->where('base_service_custom.added_by', $uid);			 
			$this->db->where('base_service_custom.service_status', 2);
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
				if($row->technitian==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->technitian); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $serstatus .'</td>							
					 
					<td>'. $row->request_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					 
				
			}
		}
		
		
		
		elseif($service=='technitians_all'){
			
			$today = date('Y-m-d');
			$this->db->from('base_service_custom');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_custom.ref_client_id');		
			
			//$this->db->where('base_service_custom.added_by', $uid);			 
			$this->db->where('base_service_custom.service_status', 2);
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
				if($row->technitian==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->technitian); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $serstatus .'</td>							
					 
					<td>'. $row->request_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					 
				
			}
		}
		
		
		
		
		
		elseif($service=='technitians_today'){
			
			$today = date('Y-m-d');
			$this->db->from('base_service_custom');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_custom.ref_client_id');		
			
			$this->db->where('base_service_custom.added_by', $uid);			 
			$this->db->where('base_service_custom.service_status', 2);			 
			$this->db->like('base_service_custom.added_time', $today);
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
				if($row->technitian==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->technitian); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $serstatus .'</td>							
					 
					<td>'. $row->request_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					 
				
			}
		}
		
		
		
		
		
		elseif($service=='technitians_today_all'){
			
			$today = date('Y-m-d');
			$this->db->from('base_service_custom');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_custom.ref_client_id');		
			
			$this->db->where('base_service_custom.added_by', $uid);			 
			$this->db->where('base_service_custom.service_status', 2);			 
			$this->db->like('base_service_custom.added_time', $today);
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
				if($row->technitian==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->technitian); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $serstatus .'</td>							
					 
					<td>'. $row->request_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					 
				
			}
		}
		
		
		
		
		
		
		elseif($service=='pendings'){
			
			$today = date('Y-m-d');
			$this->db->from('base_service_custom');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_custom.ref_client_id');		
			
			$this->db->where('base_service_custom.added_by', $uid);			 
			$this->db->where('base_service_custom.service_status', 2); 
			$this->db->or_where('base_service_custom.service_status', 3); 
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
				if($row->technitian==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->technitian); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $serstatus .'</td>							
					 
					<td>'. $row->request_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					 
				
			}
		}
		
		
		
		
		
		elseif($service=='pendings_all'){
			
			$today = date('Y-m-d');
			$this->db->from('base_service_custom');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_custom.ref_client_id');		
			
			//$this->db->where('base_service_custom.added_by', $uid);			 
			$this->db->where('base_service_custom.service_status', 2); 
			$this->db->or_where('base_service_custom.service_status', 3); 
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
				if($row->technitian==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->technitian); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $serstatus .'</td>							
					 
					<td>'. $row->request_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					 
				
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		elseif($service=='pendings_today'){
			
			$today = date('Y-m-d');
			$this->db->from('base_service_custom');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_custom.ref_client_id');		
			
			$this->db->where('base_service_custom.added_by', $uid);			 
			$this->db->where('base_service_custom.service_status', 2); 
			$this->db->or_where('base_service_custom.service_status', 3);			 
			$this->db->like('base_service_custom.added_time', $today);
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
				if($row->technitian==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->technitian); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $serstatus .'</td>							
					 
					<td>'. $row->request_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					 
				
			}
		}
		
		
		
		elseif($service=='pendings_today_all'){
			
			$today = date('Y-m-d');
			$this->db->from('base_service_custom');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_custom.ref_client_id');		
			
			//$this->db->where('base_service_custom.added_by', $uid);			 
			$this->db->where('base_service_custom.service_status', 2); 
			//$this->db->or_where('base_service_custom.service_status', 3);			 
			$this->db->like('base_service_custom.added_time', $today);
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
				if($row->technitian==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->technitian); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $serstatus .'</td>							
					 
					<td>'. $row->request_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					 
				
			}
		}elseif($service=='reschedules'){
			
			$today = date('Y-m-d');
			$this->db->from('base_service_custom');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_custom.ref_client_id');		
			
			$this->db->where('base_service_custom.added_by', $uid);	
			$this->db->where('base_service_custom.service_status', 3); 
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
				if($row->technitian==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->technitian); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $serstatus .'</td>							
					 
					<td>'. $row->request_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					
			}
		}
		
		
		
		
		
		elseif($service=='reschedules_all'){
			
			$today = date('Y-m-d');
			$this->db->from('base_service_custom');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_custom.ref_client_id');		
			
			//$this->db->where('base_service_custom.added_by', $uid);	
			$this->db->where('base_service_custom.service_status', 3); 
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
				if($row->technitian==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->technitian); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $serstatus .'</td>							
					 
					<td>'. $row->request_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					
			}
		}
		
		
		
		
		
		
		elseif($service=='reschedules_today'){
			
			$today = date('Y-m-d');
			$this->db->from('base_service_custom');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_custom.ref_client_id');		
			
			$this->db->where('base_service_custom.added_by', $uid);	 
			$this->db->where('base_service_custom.service_status', 3);			 
			$this->db->like('base_service_custom.added_time', $today);
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
				if($row->technitian==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->technitian); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $serstatus .'</td>							
					 
					<td>'. $row->request_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					 
				
			}
		}
		
		
		
		
		
		elseif($service=='reschedules_today_all'){
			
			$today = date('Y-m-d');
			$this->db->from('base_service_custom');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_custom.ref_client_id');		
			
			//$this->db->where('base_service_custom.added_by', $uid);	 
			$this->db->where('base_service_custom.service_status', 3);			 
			$this->db->like('base_service_custom.added_time', $today);
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
				if($row->technitian==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->technitian); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $serstatus .'</td>							
					 
					<td>'. $row->request_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					 
				
			}
		}
		
		
		
		
		
		elseif($service=='complete'){
			
			$today = date('Y-m-d');
			$this->db->group_by('base_service_details.service_date');
			$this->db->from('base_service_details');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_details.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_details.ref_client_id');		
			
			$this->db->where('base_service_details.is_active', $uid); 
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
				if($row->ref_emp_id==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->ref_emp_id); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $row->service_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					 
				
			}
		}elseif($service=='complete_today'){
			
			$today = date('Y-m-d');
			$this->db->group_by('base_service_details.service_date');				
			$this->db->from('base_service_details');				
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_details.ref_client_id');
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_details.ref_client_id');		
			
			$this->db->where('base_service_details.is_active', $uid);		 
			$this->db->like('base_service_details.service_date', $today);
			
			$query = $this->db->get();
			foreach($query->result() as $row){
				
				if($row->is_in_service!=1){$spNsp = 'NSP';}else{ $spNsp = 'SP'; }
				$service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>';
				}else if($service_statu==2) {$serstatus='<span style="color:maroon;">Pending</span>';
				}else if($service_statu==3) {$serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }	
				if($row->ref_emp_id==0){$employee_name='Not Assign'; }else{$employee_name=$this->technitianName($row->ref_emp_id); }
				
				$data .= '<tr>
					<td>'. $sl .'</td>
					<td>'. $row->client_code .'</td>
					<td>'. $row->client_name .'</td> 
					<td>'. $row->client_phone .'</td>
					<td>'. $spNsp .'</td>
					<td>'. $row->service_date .'</td>
					<td>'. $employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button>
					</a></td>				
				</tr>'; 
				$sl++;					 
				
			}
		}
		return $data;
    }
public function getZoneWisesms($tech){	
	
		$data='';	$sl=1;
		
    $this->db->where('ref_area_id', $tech);			
    $query = $this->db->get('base_clients');	

    foreach($query->result() as $row){  			
				
				
	$data .= $row->ci_id.'. '.$row->client_phone.'<br>'; $sl++;
    }	
  return $data;
}
	
	public function getZoneDateWise($fm, $to, $type, $tech){		
		
		$sl=1; $data =''; $today = date('Y-m-d');
		
		if($type!=1){
			
			$this->db->select('*');
			$this->db->from('base_service_custom');
			
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');		
			$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_custom.ref_client_id');
			$this->db->join('base_areas', 'base_areas.a_id = base_clients.ref_area_id');
			$this->db->join('base_employees', 'base_employees.em_id = base_service_custom.technitian');
			
			if($fm != '' && $to != ''){	
			
				$this->db->where('base_service_custom.request_date >=', $fm);
				$this->db->where('base_service_custom.request_date <=', $to);	
			}			
			if($type != ''){ $this->db->where('base_service_custom.service_status', $type); }
			
			$this->db->where('base_areas.a_id', $tech); 
			
			$query = $this->db->get();	
			foreach($query->result() as $row){ $status=''; $priority='';			
			
				if($row->is_in_service == 2){ $status = 'NSP'; }else{ $status = 'SP'; }
				$service_priority = $row->service_priority;
				if($service_priority==1) { $priority='Managment';
				}else if($service_priority==2) { $priority='Dealer';
				}else if($service_priority==3) { $priority='Customer Care';
				}else if($service_priority==4) { $priority='Otehrs';
				}else if($service_priority==5) { $priority='Genaral Service';
				}else {	$priority=''; }
				
             $service_statu=$row->service_status;										
				if($service_statu==0) {	$serstatus='<span style="color:red;">Not Assign<br>Technitian</span>'; }
				else if($service_statu==2){ $serstatus='<span style="color:maroon;">Pending</span>'; }
				else if($service_statu==3){ $serstatus='<span style="color:orange;">Reschedule</span>'; }
				else{ $serstatus='Completed'; }
				
				$assign_date=date('Y-m-d', strtotime($row->added_time));
				if(strtotime($row->request_date) < strtotime($today)){ 
				$dates = '<span style="color:red;">'.$row->request_date.'</span>'; 
				}else{
					$dates = $row->request_date; 
				}
				
				
				$data .= '<tr>
					<td>'.$sl.'</td>
					<td>'.$row->client_code.'</td>
					<td>'.$row->client_name.'</td>
					<td>'.$row->client_address.'</td>
					<td>'.$row->area_name.'</td>
					<td>'.$row->client_phone.'</td>
					<td>'. $status .'</td>
					<td>'. $serstatus .'</td>
					<td>'. $assign_date.'</td>
					<td>'. $dates.'</td>
					<td>'.$row->employee_name.'</td> 
					<td>'. $priority .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
      <button class="btn btn-primary btn-xs">Details</button></a></td>				
				</tr>'; $sl++;	
			}				
			
				
			
			
		}else{
			
			$this->db->from('base_service_details');
			
			$this->db->join('base_clients', 'base_clients.ci_id = base_service_details.ref_client_id');		
			//$this->db->join('base_service_master', 'base_service_master.ref_client_id = base_service_details.ref_master_id');
			$this->db->join('base_areas', 'base_areas.a_id = base_clients.ref_area_id');
			$this->db->join('base_employees', 'base_employees.em_id = base_service_details.ref_emp_id');			
						
			if($fm != '' && $to != ''){	 
			
				$this->db->where('base_service_details.service_date >=', $fm);
				$this->db->where('base_service_details.service_date <=', $to);				
			}
			
			$this->db->where('base_areas.a_id', $tech); 		 
			$query = $this->db->get();
			
			foreach($query->result() as $row){ $status=''; $priority='';				
				
				if( $row->is_in_service == 2 ){ $status = 'NSP'; }else{ $status = 'SP'; }						
				
				$data .= '<tr>
					<td>'.$sl.'</td>
					<td>'.$row->client_code.'</td>
					<td>'.$row->client_name.'</td>
					<td>'.$row->client_address.'</td>
					<td>'.$row->area_name.'</td>
					<td>'.$row->client_phone.'</td>
					<td>'. $status .'</td>
					<td>Completed</td>
					<td>'. $row->service_date.'</td>
					<td>'. $row->employee_name .'</td> 
					<td>'. $row->note_text .'</td>				
					<td><a  href="'. base_url().'view_customer/getCustomerServiceDetail/'. $row->ci_id .'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button></a></td>				
				</tr>'; $sl++;			
				
			}	
		}	
		
		return $data;
		
		
	}
	
	
	
	
}
?>
