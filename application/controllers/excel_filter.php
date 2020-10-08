<?php

class Excel_filter extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        //    $this->load->library('ExportXLS');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1,2,3,4,5,6,7,8,9,10,11,12,13))):
            $data['base_url'] = $this->config->item('base_url');
            include_once 'excelclass/export-xls.class.php';
            $filename = 'excel_filterchange_report.xls';
            $xls = new ExportXLS($filename);

            $header[] = "Client Id";
           
            $header[] = "Client Name";
            $header[] = "Client Phone";
            $header[] = "Client Address";
            

            $xls->addHeader($header);
            
            $today=date('Y-m-d');
            $sql_get_data = "SELECT `c`.`client_code`,`c`.`client_name`,`c`.`client_phone`,`c`.`client_address`   FROM `base_clients` AS `c`  JOIN `base_filter_changes` AS `fil` ON (`c`.`ci_id` = `fil`.`ref_client_id`)
        group by `fil`.`ref_client_id`  HAVING DATEDIFF('$today',max(`fil`.`change_date`))>365";

            $result = mysql_query($sql_get_data);
            while($sql_get_data_result = mysql_fetch_array($result))   // Date Filter
            {

                $k = 0;
                $user_data[$k++] = $sql_get_data_result['client_code'];
               
                $user_data[$k++] = $sql_get_data_result['client_name'];
                $user_data[$k++] = $sql_get_data_result['client_phone'];
                $user_data[$k++] = $sql_get_data_result['client_address'];
             


                $xls->addRow($user_data);
            }

            $xls->sendFile();

        else:
            redirect('home');
        endif;
    }





}
?>
