<?php

date_default_timezone_set("Asia/Dhaka");
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_customer extends CI_Controller {
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
            $data['active_menu'] = 'View All Activity';
            $data['active_sub_menu'] = 'View Customer';

            $table_name='base_areas';
            $data['get_base_areas_data'] = $this->common_model->getData($table_name);

            $table_name='base_employees';
            $data['get_base_employees_data'] = $this->common_model->getData($table_name);

            $table_name='base_models';
            $data['get_base_models_data'] = $this->common_model->getData($table_name);

            $this->load->view('common/header_ssp',$data);
            $this->load->view('view_customer_ssp/view_customer',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js_ssp',$data);
            $this->load->view('view_customer_ssp/js_view_customer',$data);

            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }
    
    
    public function getCustomerServiceDetail($customer_id) {
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
            $data['active_menu'] = 'View All Activity';
            $data['active_sub_menu'] = 'View Customer';

            $table_name='base_clients';
            $data['base_clients_data'] = $this->common_model->getDataWhere('base_clients','ci_id',$customer_id);

 $table_name='base_service_master';
            $data['base_service_master_data'] = $this->common_model->getDataWhere($table_name,'ref_client_id',$customer_id);

            $table_name='base_service_details';
            $data['base_service_details_data'] = $this->common_model->getDataWhere($table_name,'ref_client_id',$customer_id);

            $this->load->view('common/header',$data);
            $this->load->view('view_customer_service_detail/view_customer_service_detail',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
            $this->load->view('view_customer_service_detail/js_view_customer_service_detail',$data);
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
            
            $salesby = mysql_real_escape_string($this->input->post('salesby'));
            $installby = mysql_real_escape_string($this->input->post('installby'));
            

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

            $data2 = array(
                    'ref_sale_by' => $salesby,                  
                    'ref_install_by' => $installby,
                                      
            );

            $table_name='base_service_master';
            $insert_result = $this->common_model->updateData($table_name,$data2,"ref_client_id",$edit_id);

	$user_id = $this->session->userdata('user_id');
				
				 $data49 = array(
                    'uid' => $user_id,
					'action_name' => "Update Customer",
                    'datetime' => date('Y-m-d H:i:s')
                    
                );
                $table_name = 'user_record';
                $insert_result = $this->common_model->insertData($table_name, $data49);

            if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
            redirect('view_customer');
        else:

            redirect('home');
        endif;
    }


    public function getTableData() {
        $role = $this->session->userdata('role_id'); 
        $table = 'base_clients';
        $primaryKey = 'ci_id';
		
		if($role==1 || $role==2  || $role==9)
		{
        $columns = array(
                array('db' => '`c`.`client_code`', 'dt' => 0,'field' =>'client_code' ),
                array('db' => '`m`.`install_date`', 'dt' => 1,'field' =>'install_date'),
                array('db' => '`c`.`client_name`', 'dt' => 2,'field' =>'client_name'),
                array('db' => '`c`.`client_phone`', 'dt' => 3,'field' =>'client_phone'),
                array('db' => '`em`.`employee_code`', 'dt' => 4,'field' =>'employee_code'),
                array('db' => '`ns`.`name`', 'dt' => 5,'field' =>'name'),
                array('db' => '`a`.`area_name`', 'dt' => 6,'field' =>'area_name'),
                array('db' => '`c`.`ci_id`', 'dt' => 7,'field' =>'ci_id','formatter' => function ($rowvalue, $row) {
                            return '<button class="btn btn-info btn-xs" onclick="editModal('.$rowvalue.')">Edit</button>&nbsp<a  href="'. site_url('view_customer/getCustomerServiceDetail/'.$rowvalue).'" target="_blank">
      <button class="btn btn-primary btn-xs">Details</button></a>';
                        })



        );
       }
	   
	   else
	   {
	   $columns = array(
                array('db' => '`c`.`client_code`', 'dt' => 0,'field' =>'client_code' ),
                array('db' => '`m`.`install_date`', 'dt' => 1,'field' =>'install_date'),
                array('db' => '`c`.`client_name`', 'dt' => 2,'field' =>'client_name'),
                array('db' => '`c`.`client_phone`', 'dt' => 3,'field' =>'client_phone'),
                array('db' => '`em`.`employee_code`', 'dt' => 4,'field' =>'employee_code'),
                array('db' => '`ns`.`name`', 'dt' => 5,'field' =>'name'),
                array('db' => '`a`.`area_name`', 'dt' => 6,'field' =>'area_name'),
                array('db' => '`c`.`ci_id`', 'dt' => 7,'field' =>'ci_id','formatter' => function ($rowvalue, $row) {
                        return '<a  href="'. site_url('view_customer/getCustomerServiceDetail/'.$rowvalue).'" target="_blank">
						<button class="btn btn-primary btn-xs">Details</button></a>';
                    })

        );
	   
	   }

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


    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $ci_id = mysql_real_escape_string($this->input->post('id'));

        $query=$this->db->query("SELECT * FROM `base_clients` as `bc` join `base_service_master` as `bm` on `bc`.`ci_id`=`bm`.`ref_client_id` where `bc`.`ci_id`=$ci_id");
        $result=$query->result();
         echo json_encode($result);

       // $table_name='base_clients';
       // $result = $this->common_model->getDataWhere($table_name,"ci_id",$ci_id);
       // echo json_encode($result);


    }
}
?>
