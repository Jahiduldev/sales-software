<?php

class Excel_sp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        //    $this->load->library('ExportXLS');
    }

    public function index() {
        if (in_array($this->session->userdata('role_id'), array(1,2,3,4,5,6,7,8,9,10,11,12,13))):
            $data['base_url'] = $this->config->item('base_url');
            include_once 'excelclass/export-xls.class.php';
            $filename = 'excel_sp_report.xls';
            $xls = new ExportXLS($filename);

            $header[] = "Client Id";
            $header[] = "Install Date";
            $header[] = "Client Name";
            $header[] = "Client Phone";
            $header[] = "Client Address";
            $header[] = "Status";
            $header[] = "Area Name";

            $xls->addHeader($header);
            
            $today=date('Y-m-d');
            $sql_get_data = "SELECT `c`.`client_code`,`m`.`install_date`,`c`.`client_name`,`c`.`client_phone`,`c`.`client_address`,`ns`.`name`,`a`.`area_name`  FROM `base_service_master` AS `m`  JOIN `base_clients` AS `c` ON (`c`.`ci_id` = `m`.`ref_client_id`)  JOIN `nsp_status` AS `ns` ON (`m`.`is_in_service` = `ns`.`id`)
        JOIN `base_areas` AS `a` ON (`a`.`a_id` = `c`.`ref_area_id`)
        WHERE `m`.`m_id` NOT IN (SELECT ref_master_id FROM base_service_details) and `m`.`is_in_service`=1
        group by `m`.`ref_client_id`  HAVING DATEDIFF('$today',max(`m`.`install_date`))>120";

            $result = mysql_query($sql_get_data);
            while($sql_get_data_result = mysql_fetch_array($result))   // Date Filter
            {

                $k = 0;
                $user_data[$k++] = $sql_get_data_result['client_code'];
                $user_data[$k++] = $sql_get_data_result['install_date'];
                $user_data[$k++] = $sql_get_data_result['client_name'];
                $user_data[$k++] = $sql_get_data_result['client_phone'];
                $user_data[$k++] = $sql_get_data_result['client_address'];
                $user_data[$k++] = $sql_get_data_result['name'];
                $user_data[$k++] = $sql_get_data_result['area_name'];


                $xls->addRow($user_data);
            }

            $xls->sendFile();

        else:
            redirect('home');
        endif;
    }





}
?>
