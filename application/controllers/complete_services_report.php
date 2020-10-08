<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Complete_services_report extends CI_Controller {
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
        $get_url_data= $this->common_model->getDataWhere($table_name, $column_name, $column_value);
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
            $data['active_menu'] = 'Reports';
            $data['active_sub_menu'] = 'Complete Services Report';

        

            $this->load->view('common/header_ssp',$data);
            $this->load->view('complete_services_report_ssp/complete_services_report_ssp',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js_ssp',$data);
            $this->load->view('complete_services_report_ssp/js_complete_services_report_ssp',$data);

            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }



  

    public function getTableData() {

        $table = 'base_service_details';
        $primaryKey = 'de_id';
        $columns = array(
        array('db' => '`c`.`client_code`', 'dt' => 0,'field' =>'client_code' ),
        array('db' => '`c`.`client_name`', 'dt' => 1,'field' =>'client_name'),
        array('db' => '`c`.`client_address`', 'dt' => 2,'field' =>'client_address'),
        array('db' => '`c`.`client_phone`', 'dt' => 3,'field' =>'client_phone'),
        array('db' => '`ns`.`name`', 'dt' => 4,'field' =>'name'),
        array('db' => '`a`.`area_name`', 'dt' => 5,'field' =>'area_name'),
        array('db' => '`mo`.`model_name`', 'dt' => 6,'field' =>'model_name'),
        array('db' => '`m`.`install_date`', 'dt' => 7,'field' =>'install_date'),
        array('db' => '`d`.`service_date`', 'dt' => 8,'field' =>'service_date'),
        array('db' => '`d`.`service_priority`', 'dt' => 9,'field' =>'service_priority','formatter' => function ($rowvalue, $row) {
        if($row[9]==1) {
        $priority='Normal';
        }else if($row[9]==2) {
        $priority='Moderate';
        }else if($row[9]==3) {
        $priority='High';
        }else {
        $priority='';
        }

        return $priority;
        }),
        array('db' => '`d`.`general_or_request`', 'dt' => 10,'field' =>'general_or_request','formatter' => function ($rowvalue, $row) {
        if($row[10]==0) {
        $request='General';
        }else {
        $request='Request';
        }

        return $request;
        }),

        array('db' => '`d`.`de_id`', 'dt' => 11,'field' =>'de_id','formatter' => function ($rowvalue, $row) {
        return '<a  href="#">
      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>';
        })

        );

        $this->load->database();
        $sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
        );
        $this->load->library('SSP');
		
        $joinQuery = "FROM `{$table}` AS `d`  
		JOIN `base_service_master` AS `m` ON (`d`.`ref_master_id` = `m`.`m_id`)
        JOIN `base_clients` AS `c` ON (`d`.`ref_client_id` = `c`.`ci_id`)  
		JOIN `base_areas` AS `a` ON (`a`.`a_id` = `m`.`ref_area_id`) 
        JOIN `base_models` AS `mo` ON (`mo`.`mo_id` = `m`.`ref_area_id`) 
		JOIN `nsp_status` AS `ns` ON (`m`.`is_in_service` = `ns`.`id`)";
        
		//$extraCondition = "`d`.`service_status`=1";

        echo json_encode(
        SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns,$joinQuery)
        );


    }


 public function getTableDataDate() {

        $table = 'base_service_details';
        $primaryKey = 'de_id';
        $columns = array(
        array('db' => '`c`.`client_code`', 'dt' => 0,'field' =>'client_code' ),
        array('db' => '`c`.`client_name`', 'dt' => 1,'field' =>'client_name'),
        array('db' => '`c`.`client_address`', 'dt' => 2,'field' =>'client_address'),
        array('db' => '`c`.`client_phone`', 'dt' => 3,'field' =>'client_phone'),
        array('db' => '`ns`.`name`', 'dt' => 4,'field' =>'name'),
        array('db' => '`a`.`area_name`', 'dt' => 5,'field' =>'area_name'),
        array('db' => '`mo`.`model_name`', 'dt' => 6,'field' =>'model_name'),
        array('db' => '`m`.`install_date`', 'dt' => 7,'field' =>'install_date'),
        array('db' => '`d`.`service_date`', 'dt' => 8,'field' =>'service_date'),
        array('db' => '`d`.`service_priority`', 'dt' => 9,'field' =>'service_priority','formatter' => function ($rowvalue, $row) {
        
		if($row[9]==1) {
			$priority='Normal';
        }else if($row[9]==2) {
			$priority='Moderate';
        }else if($row[9]==3) {
			$priority='High';
        }else {
			$priority='';
        }

        return $priority;
        }),
        array('db' => '`d`.`general_or_request`', 'dt' => 10,'field' =>'general_or_request','formatter' => function ($rowvalue, $row) {
        if($row[10]==0) {
        $request='General';
        }else {
        $request='Request';
        }
 
        return $request;
        }),

        array('db' => '`d`.`de_id`', 'dt' => 11,'field' =>'de_id','formatter' => function ($rowvalue, $row) {
        return '<a  href="#">
		<button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>';
        })

        );

        $this->load->database();
        $sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
        );
        $this->load->library('SSP');
        $joinQuery = "FROM `{$table}` AS `d`  
		JOIN `base_service_master` AS `m` ON (`d`.`ref_master_id` = `m`.`m_id`)
        JOIN `base_clients` AS `c` ON (`d`.`ref_client_id` = `c`.`ci_id`)  
		JOIN `base_areas` AS `a` ON (`a`.`a_id` = `m`.`ref_area_id`) 
        JOIN `base_models` AS `mo` ON (`mo`.`mo_id` = `m`.`ref_area_id`) 
		JOIN `nsp_status` AS `ns` ON (`m`.`is_in_service` = `ns`.`id`)";
		
        $extraCondition = "(`service_date` between '". $_GET['date_from'] ."' and '". $_GET['date_to'] ."' )";

        echo json_encode(
        SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns,$joinQuery,$extraCondition)
        );


    }




}
?>
