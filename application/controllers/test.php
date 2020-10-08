<?php

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {


        $i = 0;
        $res_clients = $this->common_model->getData("base_service_master");
        $today = date('Y-m-d');
        foreach ($res_clients as $row) :
            $m_id = $row->m_id;
            $ref_client_id = $row->ref_client_id;
            $is_in_service = $row->is_in_service;
            $install_date = $row->install_date;
            $date1 = date_create($install_date);
            $date2 = date_create($today);
            $diff = date_diff($date1, $date2);
            $d = $diff->format("%a");
		  if($ref_client_id>7093):
		  echo "ref_client_id ".$ref_client_id."- day ".$d;
		   echo "<br>";
		  endif;
		 

            if ($is_in_service == 1):
                if ($d > 365):
                    $data2 = array(
                        'is_in_service' => 2
                    );
                    $res = $this->common_model->updateData('base_service_master', $data2, 'm_id', $m_id);
                    if ($res) {
                        $i++;
                        echo $install_date;
                       echo "<br>";
                    }

                endif;
            endif;

        endforeach;

        echo "Total : " . $i;
    }

}

?>
