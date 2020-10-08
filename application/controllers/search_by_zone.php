<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search_by_zone extends CI_Controller {
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
            $data['active_menu'] = 'Reports';
            $data['active_sub_menu'] = 'Search By Zone';

            $table_name='base_areas';
            $data['get_base_areas_data'] = $this->common_model->getData($table_name);

            $table_name='base_employees';
            $data['get_base_employees_data'] = $this->common_model->getData($table_name);

            $table_name='base_models';
            $data['get_base_models_data'] = $this->common_model->getData($table_name);

            $this->load->view('common/header_ssp',$data);
            $this->load->view('search_by_zone/search_by_zone',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js_ssp',$data);
            $this->load->view('search_by_zone/js_search_by_zone',$data);

            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }









    public function editModel() {
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

            $edit_id = mysql_real_escape_string($this->input->post('edit_id'));
           

            $techzone= mysql_real_escape_string($this->input->post('techzone'));

            $customer_name = mysql_real_escape_string($this->input->post('customer_name'));
            $address = mysql_real_escape_string($this->input->post('address'));
            $phone = mysql_real_escape_string($this->input->post('phone'));
            $date_birth = mysql_real_escape_string($this->input->post('date_birth'));
            $email = mysql_real_escape_string($this->input->post('email'));

            if($date_birth==""):
                $date_birth=0;
            endif;


            $data = array(
                    'ref_area_id' => $techzone,
                  
                    'client_name' => $customer_name,
                    'client_address' => $address,
                    'client_phone' => $phone,                  
                    'date_of_birth' => $date_birth,
                    'email_address' => $email
                    


            );

            $table_name='base_clients';
            $insert_result = $this->common_model->updateData($table_name,$data,"ci_id",$edit_id);


            if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
            redirect('search_by_zone');
        else:

            redirect('home');
        endif;
    }


    public function getTableData() {

        $table = 'base_clients';
        $primaryKey = 'ci_id';
        $columns = array(
                array('db' => '`c`.`client_code`', 'dt' => 0,'field' =>'client_code' ),
                array('db' => '`m`.`install_date`', 'dt' => 1,'field' =>'install_date'),
                array('db' => '`c`.`client_name`', 'dt' => 2,'field' =>'client_name'),
                array('db' => '`c`.`client_phone`', 'dt' => 3,'field' =>'client_phone'),
                array('db' => '`em`.`employee_code`', 'dt' => 4,'field' =>'employee_code'),
                array('db' => '`ns`.`name`', 'dt' => 5,'field' =>'name'),
                array('db' => '`a`.`area_name`', 'dt' => 6,'field' =>'area_name'),
                array('db' => '`c`.`ci_id`', 'dt' => 7,'field' =>'ci_id','formatter' => function ($rowvalue, $row) {
                            return '<button class="btn btn-info btn-xs" onclick="editModal('.$rowvalue.')">Edit</button>&nbsp<a  href="'. site_url('view_service/getCustomerServiceDetail/'.$rowvalue).'" target="_blank">
      <button class="btn btn-primary btn-xs">Details</button></a>';
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
        $joinQuery = "FROM `{$table}` AS `c`  JOIN `base_service_master` AS `m` ON (`c`.`ci_id` = `m`.`ref_client_id`)
        JOIN `base_areas` AS `a` ON (`a`.`a_id` = `c`.`ref_area_id`)  
        JOIN `nsp_status` AS `ns` ON (`m`.`is_in_service` = `ns`.`id`) JOIN `base_employees` AS `em` ON (`m`.`ref_sale_by` = `em`.`em_id`)";
        //$extraCondition = "`id_client`=".$ID_CLIENT_VALUE;

        echo json_encode(
        SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns,$joinQuery)
        );


    }


    public function getTableDataZone() {

        $table = 'base_clients';
        $primaryKey = 'ci_id';
        $columns = array(
                array('db' => '`c`.`client_code`', 'dt' => 0,'field' =>'client_code' ),
                array('db' => '`m`.`install_date`', 'dt' => 1,'field' =>'install_date'),
                array('db' => '`c`.`client_name`', 'dt' => 2,'field' =>'client_name'),
                array('db' => '`c`.`client_phone`', 'dt' => 3,'field' =>'client_phone'),
                array('db' => '`em`.`employee_code`', 'dt' => 4,'field' =>'employee_code'),
                array('db' => '`ns`.`name`', 'dt' => 5,'field' =>'name'),
                array('db' => '`a`.`area_name`', 'dt' => 6,'field' =>'area_name'),
                array('db' => '`c`.`ci_id`', 'dt' => 7,'field' =>'ci_id','formatter' => function ($rowvalue, $row) {
                            return '<button class="btn btn-info btn-xs" onclick="editModal('.$rowvalue.')">Edit</button>&nbsp<a  href="'. site_url('view_service/getCustomerServiceDetail/'.$rowvalue).'" target="_blank">
      <button class="btn btn-primary btn-xs">Details</button></a>';
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
        $joinQuery = "FROM `{$table}` AS `c`  JOIN `base_service_master` AS `m` ON (`c`.`ci_id` = `m`.`ref_client_id`)
        JOIN `base_areas` AS `a` ON (`a`.`a_id` = `c`.`ref_area_id`)  
        JOIN `nsp_status` AS `ns` ON (`m`.`is_in_service` = `ns`.`id`) JOIN `base_employees` AS `em` ON (`m`.`ref_sale_by` = `em`.`em_id`)";
        $extraCondition = "`a`.`a_id`=".$_GET['techzone'];

        echo json_encode(
        SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns,$joinQuery,$extraCondition)
        );


    }
    
    
    
    
    
    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $ci_id = mysql_real_escape_string($this->input->post('id'));


        $table_name='base_clients';
        $result = $this->common_model->getDataWhere($table_name,"ci_id",$ci_id);
        echo json_encode($result);


    }
}
?>
