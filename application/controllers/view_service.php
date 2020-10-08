<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_service extends CI_Controller {
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
            $data['active_sub_menu'] = 'View Service';


            $table_name='base_service_custom';
            $data['get_req_service_data'] =array();

            $this->load->view('common/header',$data);
            $this->load->view('view_service/view_service',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
            $this->load->view('view_service/js_view_service',$data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }



    public function getService() {
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
            $data['active_sub_menu'] = 'View Service';

            $table_name1='base_service_custom';
            $table_name2='base_clients';
            $column_name1='base_service_custom.ref_client_id';
            $column_name2='base_clients.id';
            $join='inner';

            $data['get_req_service_data'] = $this->common_model->joinData($table_name1,$table_name2,$column_name1,$column_name2,$join);


            $this->load->view('common/header',$data);
            $this->load->view('view_service/view_service',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
            $this->load->view('view_service/js_view_service',$data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }


    public function getServiceSearch() {
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
            $data['active_sub_menu'] = 'View Service';
            $customer_code= mysql_real_escape_string($this->input->post('customer_code'));
            $client_id=-1;
            $res_clients= $this->db->query("select * from base_clients where client_code='$customer_code'");
            if($res_clients->num_rows()>0):
                foreach ($res_clients->result() as $row1) :
                    $client_id=$row1->ci_id;
                endforeach;
            endif;

           
            $table_name='base_service_custom';
            $column_name='ref_client_id';
            $column_value=$client_id;

            $data['get_req_service_data'] = $this->common_model->getDataWhere2($table_name,$column_name,$column_value,'service_status',0);

            $this->load->view('common/header',$data);
            $this->load->view('view_service/view_service',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
            $this->load->view('view_service/js_view_service',$data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function getService2() {
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
            $data['active_sub_menu'] = 'View Service';

            $table_name='base_service_custom';
            $data['get_req_service_data'] = $this->common_model->getDataWhere($table_name,'service_status',0);




            $this->load->view('common/header',$data);
            $this->load->view('view_service/view_service',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
            $this->load->view('view_service/js_view_service',$data);
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
            $data['active_sub_menu'] = 'View Service';

            $table_name='base_clients';
            $data['base_clients_data'] = $this->common_model->getDataWhere('base_clients','ci_id',$customer_id);

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
            $insert_result = $this->common_model->insertData($table_name,$data);


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
            $insert_result = $this->common_model->updateData($table_name,$data,"id",$edit_id);


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
            redirect('create_models');
        else:
            redirect('home');
        endif;
    }
    public function getData() {

        $data['base_url'] = $this->config->item('base_url');
        $id = mysql_real_escape_string($this->input->post('id'));

        $table_name='base_models';
        $result = $this->common_model->getDataWhere($table_name,"id",$id);
        echo json_encode($result);


    }
}
?>
