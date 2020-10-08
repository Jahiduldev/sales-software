<?php
date_default_timezone_set("Asia/Dhaka");
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Create_models extends CI_Controller {
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
            $data['active_sub_menu'] = 'Create Models';
            $table_name='user_role';
            $data['get_role_data'] = $this->common_model->getData($table_name);
            $table_name='base_models';
            $data['get_base_models_data'] = $this->common_model->getData($table_name);

            $this->load->view('common/header',$data);
            $this->load->view('create_models/create_models',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
            $this->load->view('create_models/js_create_models',$data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addModel() {
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


            $add_model_code= mysql_real_escape_string($this->input->post('add_model_code'));
            $add_model_name = mysql_real_escape_string($this->input->post('add_model_name'));
            $add_description = mysql_real_escape_string($this->input->post('add_description'));
            $add_status = mysql_real_escape_string($this->input->post('add_status'));

            $data = array(
                    'model_code' => $add_model_code,
                    'model_name' => $add_model_name,
                    'model_description' => $add_description,
                    'is_active' => $add_status

            );

            $table_name='base_models';

            $result_num=$this->common_model->getDataWhere($table_name,'model_code',$add_model_code);
            if(count($result_num)>0):
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Already exist model code' );
                redirect('create_models');
            endif;

            $insert_result = $this->common_model->insertData($table_name,$data);
			
			
			
			$user_id = $this->session->userdata('user_id');
				
				 $data4 = array(
                    'uid' => $user_id,
					'action_name' => "Create Models",
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
            redirect('create_models');
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
          
            $edit_model_code= mysql_real_escape_string($this->input->post('edit_model_code'));
            $edit_model_name = mysql_real_escape_string($this->input->post('edit_model_name'));
            $edit_description = mysql_real_escape_string($this->input->post('edit_description'));
            $edit_status = mysql_real_escape_string($this->input->post('edit_status'));

            $data = array(
                    'model_code' => $edit_model_code,
                    'model_name' => $edit_model_name,
                    'model_description' => $edit_description,
                    'is_active' => $edit_status

            );

            $table_name='base_models';
            $insert_result = $this->common_model->updateData($table_name,$data,"mo_id",$edit_id);


            if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
            redirect('create_models');
        else:

            redirect('home');
        endif;
    }
    public function deleteModel() {
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


            $table_name='base_models';
            $column_name='mo_id';
            $column_value=$delete_id;
            $insert_result = $this->common_model->deleteData($table_name,$column_name,$column_value);


            if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull' );
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
            redirect('create_models');
        else:
            redirect('home');
        endif;
    }
    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = mysql_real_escape_string($this->input->post('id'));

        $table_name='base_models';
        $result = $this->common_model->getDataWhere($table_name,"mo_id",$id);
        echo json_encode($result);

    }


    public function getDataModel() {

        $data['base_url'] = $this->config->item('base_url');
        $model_code = mysql_real_escape_string($this->input->post('model_code'));

        $table_name='base_models';
        $result = $this->common_model->getDataWhere($table_name,"model_code",$model_code);
        if(count($result)>0) {
            echo "exist";
        }else {
            echo "not exist";
        }

    }
}
?>
