<?php

public function is_user($url){
	$per_role_arr = array();
	
	$table_name = 'subs_menu';
	$column_name = 'url';
	$column_value = $url;
	$get_url_data = $this->common_model->getDataWhere($table_name, $column_name, $column_value);
	foreach ($get_url_data as $row):
		$sub_menu_id = $row->sub_menu_id;
		$get_role_data = $this->common_model->getDataWhere('permission', 'sub_menu_id', $sub_menu_id);
		foreach ($get_role_data as $row2):
			$role_id = $row2->role_id;
			array_push($per_role_arr, $role_id);
		endforeach;
	endforeach;


}
?>