<?php
date_default_timezone_set("Asia/Dhaka");
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Add_employee extends CI_Controller {
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
            $data['active_menu'] = 'Application Setup';
            $data['active_sub_menu'] = 'Add Employee';
            $table_name='user_role';
            $data['get_role_data'] = $this->common_model->getData($table_name);
            $table_name='base_employees';
            $data['get_base_employees_data'] = $this->common_model->getData($table_name);

            $this->load->view('common/header',$data);
            $this->load->view('add_employee/add_employee',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
            $this->load->view('add_employee/js_add_employee',$data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }
    public function addEmployee() {
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


            $add_employee_code= mysql_real_escape_string($this->input->post('add_employee_code'));
            $add_employee_type = mysql_real_escape_string($this->input->post('add_employee_type'));
            $add_employee_name= mysql_real_escape_string($this->input->post('add_employee_name'));
            $add_phone = mysql_real_escape_string($this->input->post('add_phone'));
            $add_address = mysql_real_escape_string($this->input->post('add_address'));
			$add_status = mysql_real_escape_string($this->input->post('add_status'));

            $data = array(
                    'ref_type_id' => $add_employee_type,
                    'employee_code' => $add_employee_code,
                    'employee_name' => $add_employee_name,
                    'employee_address' => $add_address,
                    'employee_phone' => $add_phone,
                    'employee_join_date' => date('Y:m:d H:i:s'),
                    'is_active' =>$add_status,

            );

            $table_name='base_employees';

            $result_num=$this->common_model->getDataWhere($table_name,'employee_code',$add_employee_code);
            if(count($result_num)>0):
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Already exist employee code' );
                redirect('add_employee');
            endif;

            $insert_result = $this->common_model->insertData($table_name,$data);
			
			
			
			$user_id = $this->session->userdata('user_id');
				
				 $data4 = array(
                    'uid' => $user_id,
					'action_name' => "Add Employee",
                    'datetime' => date('Y-m-d H:i:s')
                    
                );
                $table_name = 'user_record';
                $insert_result = $this->common_model->insertData($table_name, $data4);


            if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
            redirect('add_employee');
        else:

            redirect('home');
        endif;
    }


    public function editEmployee() {
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
            $edit_employee_code= mysql_real_escape_string($this->input->post('edit_employee_code'));
            $edit_employee_type = mysql_real_escape_string($this->input->post('edit_employee_type'));
            $edit_employee_name = mysql_real_escape_string($this->input->post('edit_employee_name'));
            $edit_employee_phone = mysql_real_escape_string($this->input->post('edit_employee_phone'));
            $edit_employee_address = mysql_real_escape_string($this->input->post('edit_employee_address'));
            $edit_status = mysql_real_escape_string($this->input->post('edit_status'));

            $data = array(
                    'ref_type_id' => $edit_employee_type,
                    'employee_code' => $edit_employee_code,
                    'employee_name' => $edit_employee_name,
                    'employee_phone' => $edit_employee_phone,
                    'employee_address' => $edit_employee_address,
                    'is_active' => $edit_status

            );

            $table_name='base_employees';
            $insert_result = $this->common_model->updateData($table_name,$data,"em_id",$edit_id);



            if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
            redirect('add_employee');
        else:

            redirect('home');
        endif;
    }
    public function deleteEmployee() {
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
            $delete_id = mysql_real_escape_string($this->input->post('delete_id'));


            $table_name='base_employees';
            $column_name='em_id';
            $column_value=$delete_id;
            $insert_result = $this->common_model->deleteData($table_name,$column_name,$column_value);


            if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull' );
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
            redirect('add_employee');
        else:
            redirect('home');
        endif;
    }
    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = mysql_real_escape_string($this->input->post('id'));

        $table_name='base_employees';
        $result = $this->common_model->getDataWhere($table_name,"em_id",$id);
        echo json_encode($result);


    }

      public function getDataEmployee() {

        $data['base_url'] = $this->config->item('base_url');
        $employee_code = mysql_real_escape_string($this->input->post('employee_code'));

        $table_name='base_employees';
        $result = $this->common_model->getDataWhere($table_name,"employee_code",$employee_code);
         if(count($result)>0) {
            echo "exist";
        }else {
            echo "not exist";
        }


    }

}
?>
