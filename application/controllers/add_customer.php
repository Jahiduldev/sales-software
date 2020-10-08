<?php
date_default_timezone_set("Asia/Dhaka");
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Add_customer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        $per_role_arr = array();
        $url = $this->uri->segment(1);
        $table_name = 'subs_menu';
        $column_name = 'url';
        $column_value = $url;
        $get_url_data = $this->common_model->getDataWhere($table_name, $column_name, $column_value);
        foreach ($get_url_data as $row):
            $sub_menu_id = $row->sub_menu_id;
            $get_role_data = $this->common_model->getDataWhere('permission', 'sub_menu_id', $sub_menu_id);
            foreach ($get_role_data as $row2):
                $role_id = $row2->role_id;
                array_push($per_role_arr, $role_id);
            endforeach;
        endforeach;



        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Manipulation';
            $data['active_sub_menu'] = 'Add Customer';

            $table_name = 'base_areas';
            $data['get_base_areas_data'] = $this->common_model->getData($table_name);

            $query1 = $this->db->query("select * from base_employees  order by employee_code");
            $data['get_base_employees_data1'] = $query1->result();
			
			$query12 = $this->db->query("select * from base_dealers");
            $data['get_base_employees_data12'] = $query12->result();

            $query2 = $this->db->query("select * from base_employees where ref_type_id=2 order by employee_code");
            $data['get_base_employees_data2'] = $query2->result();



            $table_name = 'base_employees';
            $data['get_base_employees_data'] = $this->common_model->getData($table_name);

            $table_name='base_models';
            $data['get_base_models_data'] = $this->common_model->getData_model($table_name);

            $table_name = 'base_clients';
            $data['get_base_clients_data'] = $this->common_model->getData($table_name);

            $result = $this->db->query("select * from base_clients order by ci_id desc limit 1");
            foreach ($result->result() as $row) :
                $id = $row->ci_id;
                $data['last_row'] = $id + 1;
            endforeach;
			
            $this->load->view('common/header', $data);
            $this->load->view('add_customer/add_customer', $data);
            $this->load->view('common/footer', $data);
            $this->load->view('common/js', $data);
            $this->load->view('add_customer/js_add_customer', $data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addCustomer() {
        $per_role_arr = array();
        $url = $this->uri->segment(1);
        $table_name = 'subs_menu';
        $column_name = 'url';
        $column_value = $url;
        $get_url_data = $this->common_model->getDataWhere($table_name, $column_name, $column_value);
        foreach ($get_url_data as $row):
            $sub_menu_id = $row->sub_menu_id;
            $get_role_data = $this->common_model->getDataWhere('permission', 'sub_menu_id', $sub_menu_id);
            foreach ($get_role_data as $row2):
                $role_id = $row2->role_id;
                array_push($per_role_arr, $role_id);
            endforeach;
        endforeach;



        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');


            $install_date = mysql_real_escape_string($this->input->post('install_date'));
            $customer_code = mysql_real_escape_string($this->input->post('customer_code'));
            $salesby = mysql_real_escape_string($this->input->post('salesby'));
            $installby = mysql_real_escape_string($this->input->post('installby'));
            $dealeby = mysql_real_escape_string($this->input->post('dealeby'));
			
			
			if ($dealeby == "")
			{
			$dealeby = '346';
			}
			else
			{
			$dealeby = $dealeby;
			}
			
			
            $techzone = mysql_real_escape_string($this->input->post('techzone'));
            $model = mysql_real_escape_string($this->input->post('model'));
            $customer_name = mysql_real_escape_string($this->input->post('customer_name'));
            $address = mysql_real_escape_string($this->input->post('address'));
            $phone = mysql_real_escape_string($this->input->post('phone'));
            $date_birth = mysql_real_escape_string($this->input->post('date_birth'));
            $email = mysql_real_escape_string($this->input->post('email'));

            if ($date_birth == ""):
                $date_birth = 0;
            endif;


            $data1 = array(
                'ref_area_id' => $techzone,
                'client_code' => $customer_code,
                'client_name' => $customer_name,
                'client_address' => $address,
                'client_phone' => $phone,
                'is_in_service' => 1,
                'is_active' => 0,
                'date_of_birth' => $date_birth,
                'email_address' => $email,
                'added_by' => '',
                'added_time' => date('Y-m-d H:i:s')
            );


            $table_name = 'base_clients';

            $result_num = $this->common_model->getDataWhere($table_name, 'client_code', $customer_code);
            if (count($result_num) > 0):
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Already exist customer code');
                redirect('add_customer');
            endif;

            $insert_result_id = $this->common_model->insertDataGetId($table_name, $data1);

            if ($insert_result_id > 0):
			
                $result_num = $this->common_model->getDataWhere('base_service_master', 'ref_client_id', $insert_result_id);
                if (count($result_num) > 0):
                    $this->session->set_userdata('msg_title', 'Error');
                    $this->session->set_userdata('msg_body', 'Already exist customer id');
                    redirect('add_customer');
                endif;

                $data2 = array(
                    'ref_client_id' => $insert_result_id,
                    'ref_sale_by' => $salesby,
                    'ref_install_by' => $installby,
                    'ref_area_id' => $techzone,
                    'ref_model_id' => $model,
                    'dealer_id' => $dealeby,
                    'install_date' => $install_date,
                    'service_date' => $install_date,
                    'filter_date' => $install_date,
                    'service_total' => 0,
                    'is_in_service' => 1,
                    'is_active' => 1,
                    'is_filter_change' => 0
                );
                $table_name = 'base_service_master';
                $insert_result_id2 = $this->common_model->insertDataGetId($table_name, $data2);

                $data3 = array(
                    'ref_client_id' => $insert_result_id,
                    'change_date' => date('Y-m-d H:i:s'),
                    'change_note' => "Changed before 1 years"
                );
                $table_name = 'base_filter_changes';
                $insert_result = $this->common_model->insertData($table_name, $data3);
				
				$user_id = $this->session->userdata('user_id');
				
				 $data4 = array(
                    'uid' => $user_id,
					'action_name' => "Create New Customers",
                    'datetime' => date('Y-m-d H:i:s')
                    
                );
                $table_name = 'user_record';
                $insert_result = $this->common_model->insertData($table_name, $data4);
				
				
				
				
				
				 $queryPermission = $this->db->query("SELECT * FROM sms ");
            foreach ($queryPermission->result() as $rowMenu) {
               $complain=$rowMenu->sms2;
                            
            }
			
             $complaintext = urlencode($complain);
             $sms_slice = explode('/',$phone);

             $msist = $sms_slice[0];




			 $msis = strlen($msist);
			
			
            if($msis==11)
            {
			$msisfinal = '88'.$msist;
			
			$url2='http://api.rankstelecom.com/api/v3/sendsms/plain?user=SKRPGROUP&password=KDoeQWZ6&SMSText='.$complaintext.'&GSM='.$msisfinal.'&TYPE=longSMS&unicode=8';
			
			
	         $send = file_get_contents($url2);
			}
            else if($msis==10)
            {
			$msisfinal = '880'.$msist;
			
			$url2='http://api.rankstelecom.com/api/v3/sendsms/plain?user=SKRPGROUP&password=KDoeQWZ6&SMSText='.$complaintext.'&GSM='.$msisfinal.'&TYPE=longSMS&unicode=8';
			
			
	         $send = file_get_contents($url2);
			}		
				
				
				
				
				
				
				
				
				
				
				
				
				

                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;

            redirect('view_customer');

        else:
            redirect('home');
        endif;
    }

    public function editModel() {
        $per_role_arr = array();
        $url = $this->uri->segment(1);
        $table_name = 'subs_menu';
        $column_name = 'url';
        $column_value = $url;
        $get_url_data = $this->common_model->getDataWhere($table_name, $column_name, $column_value);
        foreach ($get_url_data as $row):
            $sub_menu_id = $row->sub_menu_id;
            $get_role_data = $this->common_model->getDataWhere('permission', 'sub_menu_id', $sub_menu_id);
            foreach ($get_role_data as $row2):
                $role_id = $row2->role_id;
                array_push($per_role_arr, $role_id);
            endforeach;
        endforeach;

        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');

            $edit_id = mysql_real_escape_string($this->input->post('edit_id'));
            $edit_model_code = mysql_real_escape_string($this->input->post('edit_model_code'));
            $edit_model_name = mysql_real_escape_string($this->input->post('edit_model_name'));
            $edit_description = mysql_real_escape_string($this->input->post('edit_description'));
            $edit_status = mysql_real_escape_string($this->input->post('edit_status'));

            $data = array(
                'model_code' => $edit_model_code,
                'model_name' => $edit_model_name,
                'model_description' => $edit_description,
                'is_active' => $edit_status
            );

            $table_name = 'base_models';
            $insert_result = $this->common_model->updateData($table_name, $data, "id", $edit_id);


            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('create_models');
        else:

            redirect('home');
        endif;
    }

    public function deleteModel() {
        $per_role_arr = array();
        $url = $this->uri->segment(1);
        $table_name = 'subs_menu';
        $column_name = 'url';
        $column_value = $url;
        $get_url_data = $this->common_model->getDataWhere($table_name, $column_name, $column_value);
        foreach ($get_url_data as $row):
            $sub_menu_id = $row->sub_menu_id;
            $get_role_data = $this->common_model->getDataWhere('permission', 'sub_menu_id', $sub_menu_id);
            foreach ($get_role_data as $row2):
                $role_id = $row2->role_id;
                array_push($per_role_arr, $role_id);
            endforeach;
        endforeach;
        if (in_array($this->session->userdata('role_id'), $per_role_arr)):
            $data['base_url'] = $this->config->item('base_url');
            $delete_id = mysql_real_escape_string($this->input->post('delete_id'));


            $table_name = 'base_models';
            $column_name = 'id';
            $column_value = $delete_id;
            $insert_result = $this->common_model->deleteData($table_name, $column_name, $column_value);


            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('create_models');
        else:
            redirect('home');
        endif;
    }

    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = mysql_real_escape_string($this->input->post('id'));

        $table_name = 'base_models';
        $result = $this->common_model->getDataWhere($table_name, "id", $id);
        echo json_encode($result);
    }

}

?>
