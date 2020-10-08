<?php

include ('dumper.php');

try {
    $world_dumper = Shuttle_Dumper::create(array(
                'host' => 'localhost',
                'username' => 'skrpcom_sknew',
                'password' => '7pFfT%3Wk%bT',
                'db_name' => 'skrpcom_sknew',
               // 'include_tables' => array('base_areas')
    ));

    // dump the database to gzipped file
    $datetime=date('Y_m_d_H_i_s');
     $file = 'skrp_'.$datetime.'.sql';
    $world_dumper->dump($file);
   
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;



    // dump the database to plain text file
    //$world_dumper->dump('skrp.sql');

    
    
    /* 	$wp_dumper = Shuttle_Dumper::create(array(
      'host' => '',
      'username' => 'root',
      'password' => '',
      'db_name' => 'wordpress',
      ));

      // Dump only the tables with wp_ prefix
      $wp_dumper->dump('wordpress.sql', 'wp_');

      $countries_dumper = Shuttle_Dumper::create(array(
      'host' => '',
      'username' => 'root',
      'password' => '',
      'db_name' => 'world',
      'include_tables' => array('base_areas', 'base_clients'), // only include those tables
      ));
      $countries_dumper->dump('world.sql.gz');

      $world_dumper = Shuttle_Dumper::create(array(
      'host' => '',
      'username' => 'root',
      'password' => '',
      'db_name' => 'world',
      'exclude_tables' => array('city'),
      ));
      $world_dumper->dump('world-no-cities.sql.gz'); */
} catch (Shuttle_Exception $e) {
    echo "Couldn't dump database: " . $e->getMessage();
}