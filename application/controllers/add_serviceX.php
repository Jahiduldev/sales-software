<?php
date_default_timezone_set("Asia/Dhaka");
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Add_service extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
       // $this->load->model('home_model');
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
            $data['active_menu'] = 'Complain Area';
            $data['active_sub_menu'] = 'Create Complains';
            
            //$this->home_model->nspCheck();

            $data['base_clients_data'] = array();
            $this->load->view('common/header',$data);
            $this->load->view('add_service/add_service',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
            $this->load->view('add_service/js_add_service',$data);
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
            $data['active_menu'] = 'Manipulation';
            $data['active_sub_menu'] = 'Add Service';
            $customer_code= mysql_real_escape_string($this->input->post('customer_code'));
         
			$res_clients= $this->db->query("select * from base_clients where client_code Like '%$customer_code%' or client_phone Like '%$customer_code%' or client_name Like '%$customer_code%'");
			$data['base_clients_data']=$res_clients->result();
			$this->load->view('common/header',$data);
            $this->load->view('add_service/add_service',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
            $this->load->view('add_service/js_add_service',$data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }

    public function addReqService() {
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

            $client_id= mysql_real_escape_string($this->input->post('client_id'));
            $add_customer_code= mysql_real_escape_string($this->input->post('add_customer_code'));
            $add_mobile_number = mysql_real_escape_string($this->input->post('add_mobile_number'));
            $add_service_priority = mysql_real_escape_string($this->input->post('add_service_priority'));
            $add_request_date = mysql_real_escape_string($this->input->post('add_request_date'));
            $add_service_description = mysql_real_escape_string($this->input->post('add_service_description'));
			$user_id = $this->session->userdata('user_id');

            $data = array(
                    'ref_client_id' => $client_id,
                    'request_date' => $add_request_date,
                    'service_description' => $add_service_description,
                    'service_status' => 0,
                    'is_active' => 1,
                    'service_priority' => $add_service_priority,
                    'added_by' => $user_id,
                    'added_time' => date('Y-m-d H:i:s')

            );

            $table_name='base_service_custom';
            $insert_result = $this->common_model->insertData($table_name,$data);
			
			
			$user_id = $this->session->userdata('user_id');
				
				 $data4 = array(
                    'uid' => $user_id,
					'action_name' => "Add Complain",
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
            redirect('add_service');
        else:

            redirect('home');
        endif;
    }



    public function getData1(){
       
        $user_id = mysql_real_escape_string($this->input->post('user_id'));
        $this->db->select('base_service_custom.ref_client_id');
		$this->db->from('base_service_custom');
		$this->db->join('base_clients', 'base_clients.ci_id = base_service_custom.ref_client_id');
		$this->db->where('base_clients.client_code', $user_id);
		$result = $this->db->get();
		if($result->num_rows() !=0){			
			
			echo 'This Complain is on process!';		
		}else{
		
			$this->db->select('base_clients.ci_id, base_clients.client_code,base_clients.client_name, base_clients.client_address, base_clients.client_phone, base_service_master.is_in_service, base_service_master.is_filter_change, base_service_master.default, sale.employee_name AS saler, install.employee_name AS installer, base_areas.area_name, 
			base_dealers.model_name');
			
			$this->db->from('base_clients');
			
			$this->db->join('base_service_master', 'base_clients.ci_id = base_service_master.ref_client_id');
			$this->db->join('base_employees sale', 'sale.em_id  = base_service_master.ref_sale_by');
			$this->db->join('base_employees install', 'install.em_id  = base_service_master.ref_install_by');
			$this->db->join('base_areas', 'base_areas.a_id  = base_service_master.ref_area_id');
			$this->db->join('base_dealers', 'base_dealers.id  = base_service_master.dealer_id');
			
			$this->db->where('base_clients.client_code', $user_id);
			
			$result = $this->db->get();
			if($result->num_rows() !=0){ 
				echo json_encode($result->result()); 
			}else{ 
				echo 'This Client Not Found !'; 
			}
		
		}
    }
    
    public function getCustomerServiceDetail($customer_id){
        
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
    
    
    
    
    
    
}
?>
