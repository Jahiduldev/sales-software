<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Update_status extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {

        $get_data= $this->common_model->getData('test');
        $counter=0;
        foreach( $get_data as $row2):
            $ref_client_id=$row2->ref_client_id;
            $count=$row2->count;
         /*   if($count>=4):
                $counter++;
                $data = array(
                        'is_in_service' => 2

                );
                $table_name='base_service_master';
                $up_result = $this->common_model->updateData($table_name, $data,"ref_client_id",$ref_client_id);
            endif; */
             $counter++;
             $data = array(
                        'service_total' => $count

                );
                $table_name='base_service_master';
           //    echo $up_result = $this->common_model->updateData($table_name, $data,"ref_client_id",$ref_client_id);


        endforeach;
        echo $counter;
    }

//insert into test(`ref_client_id`,`count`)  SELECT `ref_client_id`,count(*) as count FROM
// `base_service_details`  group by `ref_client_id`


/*UPDATE base_service_master m,
(   SELECT ref_client_id, `count` as c
    FROM test
) t
SET m.service_total = t.c
WHERE m.ref_client_id = t.ref_client_id

*/





}
?>
