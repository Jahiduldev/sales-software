<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sp_nsp_report extends CI_Controller {
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
            $data['active_sub_menu'] = 'SP & NSP Report';

            /*   $data['get_req_service_data'] =array();

            $this->load->view('common/header',$data);
            $this->load->view('view_complete_service/view_complete_service',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
            $this->load->view('view_complete_service/js_view_complete_service',$data);  */

            $this->load->view('common/header_ssp',$data);
            $this->load->view('sp_nsp_report_ssp/sp_nsp_report_ssp',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js_ssp',$data);
            $this->load->view('sp_nsp_report_ssp/js_sp_nsp_report_ssp',$data);

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
            $data['active_sub_menu'] = 'View Completed Service';
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

            $data['get_req_service_data'] = $this->common_model->getDataWhere2($table_name,$column_name,$column_value,'service_status',1);

            $this->load->view('common/header',$data);
            $this->load->view('view_complete_service/view_complete_service',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
            $this->load->view('view_complete_service/js_view_complete_service',$data);
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
            $data['active_sub_menu'] = 'View Completed Service';


            // $table_name='base_service_custom';
            //  $data['get_req_service_data'] = $this->common_model->getDataWhere($table_name,'service_status',1);




            $this->load->view('common/header_ssp',$data);
            $this->load->view('view_completed_service_ssp/view_completed_service_ssp',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js_ssp',$data);
            $this->load->view('view_completed_service_ssp/js_view_completed_service_ssp',$data);
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
        $joinQuery = "FROM `{$table}` AS `d`  JOIN `base_service_master` AS `m` ON (`d`.`ref_master_id` = `m`.`m_id`)
        JOIN `base_clients` AS `c` ON (`d`.`ref_client_id` = `c`.`ci_id`)  JOIN `base_areas` AS `a` ON (`a`.`a_id` = `m`.`ref_area_id`) 
        JOIN `base_models` AS `mo` ON (`mo`.`mo_id` = `m`.`ref_area_id`) JOIN `nsp_status` AS `ns` ON (`m`.`is_in_service` = `ns`.`id`)";
        //$extraCondition = "`d`.`service_status`=1";

        echo json_encode(
        SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns,$joinQuery)
        );


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
