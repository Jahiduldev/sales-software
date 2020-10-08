<?php
date_default_timezone_set("Asia/Dhaka");
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Create_sms extends CI_Controller {
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
            $data['active_sub_menu'] = 'Create Sms';
            $table_name='user_role';
            $data['get_role_data'] = $this->common_model->getData($table_name);
            $table_name='sms';
            $data['get_sms_data'] = $this->common_model->getData($table_name);

            $this->load->view('common/header',$data);
            $this->load->view('create_sms/create_sms',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
            $this->load->view('create_sms/js_create_sms',$data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }
     public function addZone() {
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


            $add_zone_name= mysql_real_escape_string($this->input->post('add_zone_name'));
            $add_description = mysql_real_escape_string($this->input->post('add_description'));
            $add_status = mysql_real_escape_string($this->input->post('add_status'));

            $data = array(
                    'area_name' => $add_zone_name,
                    'area_description' => $add_description,
                    'is_active' => $add_status

            );

            $table_name='sms';
            $insert_result = $this->common_model->insertData($table_name,$data);


            if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
            redirect('create_zones');
        else:

            redirect('home');
        endif;
    }


    public function editSms() {
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
            $sms1= mysql_real_escape_string($this->input->post('sms1'));
			$sms2= mysql_real_escape_string($this->input->post('sms2'));
			$sms3= mysql_real_escape_string($this->input->post('sms3'));
			$sms4= mysql_real_escape_string($this->input->post('sms4'));
           

            $data = array(
                    
                    'sms1' => $sms1,
					'sms2' => $sms2,
					'sms3' => $sms3,
					'sms4' => $sms4
                    

            );

            $table_name='sms';
            $insert_result = $this->common_model->updateData($table_name,$data,"id",$edit_id);
			
			
			
			
			$user_id = $this->session->userdata('user_id');
				
				 $data4 = array(
                    'uid' => $user_id,
					'action_name' => "SMS Text Update",
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
            redirect('create_sms');
        else:

            redirect('home');
        endif;
    }
    public function deleteZone() {
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


            $table_name='sms';
            $column_name='id';
            $column_value=$delete_id;
            $insert_result = $this->common_model->deleteData($table_name,$column_name,$column_value);


            if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull' );
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
            redirect('create_zones');
        else:
            redirect('home');
        endif;
    }
    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = mysql_real_escape_string($this->input->post('id'));

        $table_name='sms';
        $result = $this->common_model->getDataWhere($table_name,"id",$id);
        echo json_encode($result);


    }
}
?>
