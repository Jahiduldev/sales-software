<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auto_request extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {



        if (in_array($this->session->userdata('role_id'), array(1,2,3))):
            $data['base_url'] = $this->config->item('base_url');
            $data['active_menu'] = 'Newsletter Campaign';
            $data['active_sub_menu'] = 'General/Sms';

            $data['base_clients_data'] = array();
            $result_arr= array();
            $index=0;
            $res_clients= $this->common_model->getData("base_service_master");
            $today=date('Y-m-d H:i:s');
            foreach ($res_clients as $row) :
                $m_id=$row->m_id;
                $ref_client_id=$row->ref_client_id;
                $is_in_service=$row->is_in_service;
                $install_date=$row->install_date;
                $date1=date_create($install_date);
                $date2=date_create($today);
                $diff=date_diff($date1,$date2);
                $d=$diff->format("%a");

                if($is_in_service ==1):
                    if($d>365):
                        $data2 = array(
                                'is_in_service' => 2
                        );
                        $res= $this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
                    endif;
                endif;

                $result1= $this->db->query("select * from base_service_details where ref_master_id='$m_id' order by de_id DESC limit 1");
                if($result1->num_rows()>0):
                    foreach ($result1->result() as $row2) :
                        $service_date=$row2->service_date;
                        $date1=date_create($service_date);
                        $date2=date_create($today);
                        $diff=date_diff($date1,$date2);
                        $d=$diff->format("%a");
                        if($d>=120):
                            $result_arr[$index]=$this->common_model->getDataWhere('base_service_master','m_id',$m_id);
                            $index++;
                        endif;
                    endforeach;

                else:
                    $date1=date_create($install_date);
                    $date2=date_create($today);
                    $diff=date_diff($date1,$date2);
                    $d=$diff->format("%a");
                    if($d>=120):
                        $result_arr[$index]=$this->common_model->getDataWhere('base_service_master','m_id',$m_id);
                        $index++;
                    endif;

                endif;

                $data['base_clients_data']=$result_arr;

            endforeach;


            // print_r($result_arr);
            // print_r( $data['base_clients_data']);

            $this->load->view('common/header',$data);
            $this->load->view('auto_request/auto_request',$data);
            $this->load->view('common/footer',$data);
            $this->load->view('common/js',$data);
            $this->load->view('auto_request/js_auto_request',$data);
            $this->session->unset_userdata('msg_title');
            $this->session->unset_userdata('msg_body');
        else:
            redirect('home');
        endif;
    }



    public function addReqService() {

        if (in_array($this->session->userdata('role_id'), array(1,2,3))):
            $data['base_url'] = $this->config->item('base_url');

            $client_id= mysql_real_escape_string($this->input->post('client_id'));
            $master_id= mysql_real_escape_string($this->input->post('master_id'));
            $add_mobile_number = mysql_real_escape_string($this->input->post('add_mobile_number'));
            $add_service_priority = mysql_real_escape_string($this->input->post('add_service_priority'));
            $add_request_date = mysql_real_escape_string($this->input->post('add_request_date'));
            $add_service_description = mysql_real_escape_string($this->input->post('add_service_description'));



            $get_result = $this->common_model->getDataWhere('base_service_master','ref_client_id',$client_id);

            foreach ($get_result as $row) :
                $m_id=$row->m_id;
                $service_total=$row->service_total;
                $service_total=$service_total+1;
                if($service_total>3):
                    $data2 = array(
                            'service_total' => $service_total,
                            'is_in_service' => 2


                    );
                    $service_type=2;
                    $this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
                else:
                    $data2 = array(
                            'service_total' => $service_total


                    );
                    $service_type=1;
                    $this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
                endif;
            endforeach;




            $data3 = array(
                    'ref_master_id' => $master_id,
                    'ref_client_id' => $client_id,
                    'service_date' => $add_request_date,
                    'service_description' =>$add_service_description,
                    'service_type'=>$service_type,
                    'service_status' => 1,
                    'is_active' => 1,
                    'service_priority' =>$add_service_priority,
                    'general_or_request' => 0
            );
            $table_name='base_service_details';
            $insert_result = $this->common_model->insertData($table_name,$data3);


            if($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body','Successfull');
            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body','Failed' );
            endif;
            redirect('auto_request');
        else:

            redirect('home');
        endif;
    }


   



    public function sendSms() {

        if (in_array($this->session->userdata('role_id'), array(1,2,3))):
            $data['base_url'] = $this->config->item('base_url');



            $data['base_clients_data'] = array();
            $result_arr= array();
            $index=0;
            $res_clients= $this->common_model->getData("base_service_master");
            $today=date('Y-m-d H:i:s');
            foreach ($res_clients as $row) :
                $m_id=$row->m_id;
                $ref_client_id=$row->ref_client_id;
                $is_in_service=$row->is_in_service;
                $install_date=$row->install_date;
                $date1=date_create($install_date);
                $date2=date_create($today);
                $diff=date_diff($date1,$date2);
                $d=$diff->format("%a");

                if($is_in_service ==1):

                    if($d>365):
                        $data2 = array(
                                'is_in_service' => 2
                        );
                        $res= $this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
                    endif;
                endif;

                $result1= $this->db->query("select * from base_service_details where ref_master_id='$m_id' order by de_id DESC limit 1");
                if($result1->num_rows()>0):
                    foreach ($result1->result() as $row2) :
                        $service_date=$row2->service_date;
                        $date1=date_create($service_date);
                        $date2=date_create($today);
                        $diff=date_diff($date1,$date2);
                        $d=$diff->format("%a");
                        if($d>=120):
                            $result_arr[$index]=$this->common_model->getDataWhere('base_service_master','m_id',$m_id);
                            $index++;
                        endif;
                    endforeach;

                else:
                    $date1=date_create($install_date);
                    $date2=date_create($today);
                    $diff=date_diff($date1,$date2);
                    $d=$diff->format("%a");
                    if($d>=120):
                        $result_arr[$index]=$this->common_model->getDataWhere('base_service_master','m_id',$m_id);
                        $index++;
                    endif;

                endif;

                $data['base_clients_data']=$result_arr;

            endforeach;




            foreach ($result_arr as  $key => $value) :

                foreach ($value as  $row) :
                    $m_id=$row->m_id;
                    $ref_client_id=$row->ref_client_id;
                    $ref_install_by=$row->ref_install_by;
                    $ref_area_id=$row->ref_area_id;
                    $install_date=$row->install_date;
                    $is_in_service=$row->is_in_service;
                    if($is_in_service==2):
                        $status="NSP";
                    else:
                        $status="SP";
                    endif;
                    $res_client= $this->db->query("select * from base_clients where ci_id='$ref_client_id'");
                    foreach ($res_client->result() as $row2) :
                        $client_code=$row2->client_code;
                        $client_name=$row2->client_name;
                        $client_phone=$row2->client_phone;


                        $format_phone=  trim(str_replace("-","",$client_phone));

                        //--------------- add completed service-----------------//
                        $get_result = $this->common_model->getDataWhere('base_service_master','ref_client_id',$ref_client_id);

                        foreach ($get_result as $row) :
                            $m_id=$row->m_id;
                            $service_total=$row->service_total;
                            $service_total=$service_total+1;
                            if($service_total>3):
                                $data2 = array(
                                        'service_total' => $service_total,
                                        'is_in_service' => 2


                                );
                                $service_type=2;
                                $this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
                            else:
                                $data2 = array(
                                        'service_total' => $service_total


                                );
                                $service_type=1;
                                $this->common_model->updateData('base_service_master',$data2,'m_id',$m_id);
                            endif;
                        endforeach;


                        $data3 = array(
                                'ref_master_id' => $m_id,
                                'ref_client_id' => $ref_client_id,
                                'service_date' =>date('Y-m-d H:i:s'),
                                'service_description' =>'sms',
                                'service_type'=>$service_type,
                                'service_status' => 1,
                                'is_active' => 1,
                                'general_or_request' => 0,
                                'sms' => 1
                        );
                        $table_name='base_service_details';
                        $insert_result = $this->common_model->insertData($table_name,$data3);

                        //--------------- add completed service-----------------//


                        $sms= mysql_real_escape_string($this->input->post('sms'));
                        $data4 = array(
                                'ref_client_id' => $ref_client_id,
                                'sms' =>$sms,
                                'date_time' =>date('Y-m-d H:i:s')
                        );
                        $table_name='sms_history';
                        $sms_result = $this->common_model->insertData($table_name,$data4);






                        $client_address=$row2->client_address;
                        $ref_area_id=$row2->ref_area_id;
                        $res_area= $this->db->query("select * from base_areas where a_id='$ref_area_id'");
                        foreach ($res_area->result() as $row3) :
                            $area_name=$row3->area_name;
                        endforeach;
                    endforeach;
                endforeach;
            endforeach;


            redirect('auto_request');
        else:
            redirect('home');
        endif;

    }





    public function getData1() {

        $data['base_url'] = $this->config->item('base_url');
        $user_id = mysql_real_escape_string($this->input->post('user_id'));

        $table_name='base_clients';
        $result = $this->common_model->getDataWhere($table_name,"ci_id",$user_id);
        echo json_encode($result);


    }
}
?>
