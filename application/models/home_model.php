<?php
class Home_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function loginCheck($user_name, $password) {
        $this->db->select('*');
        $this->db->where('user_name', $user_name);
        $this->db->where('password', $password);
      //  $this->db->where('status', '1');
        $userinfo = $this->db->get('user');
        return $userinfo;
    }
	
	public function nspCheck() {
		$i=0; $l=0;	$data='';  
		
		$today = strtotime(date('Y-m-d'));
		
		$yearBefor = date('Y-m-d', strtotime('-1 year', $today));        
		$this->db->where('install_date <=', $yearBefor);
		$this->db->where('is_in_service', 1);
        $query = $this->db->get('base_service_master');		
		foreach($query->result() as $row){ 		
			
			$this->db->where('m_id', $row->m_id);
			$this->db->update('base_service_master', array('is_in_service' => 2));
				$i++;	
		}	
		
		$month6Befor = date('Y-m-d', strtotime('-6 month', $today));
		$this->db->where('install_date <=', $month6Befor);
		$this->db->where('is_filter_change', 0);
        $query = $this->db->get('base_service_master');		
		foreach($query->result() as $row){ 	
			
			$this->db->where('m_id', $row->m_id);
			$this->db->update('base_service_master', array('is_filter_change' => 1));
			$l++;
		
		}
		
        //return $i.'-'.$l;
		
    }
	
	
	
	

}
