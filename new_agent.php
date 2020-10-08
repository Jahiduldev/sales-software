<?php 
$host = mysql_connect('localhost', 'skrpcom_sknew', '7pFfT%3Wk%bT') or die("Failed to connect to mysql");
mysql_select_db('skrpcom_sknew',$host) or die( "Unable to select database");





?>
    <form name="uAdmin" action="" method="post" enctype="multipart/form-data">
    	 <div class="box-body">
										<div class="form-group">
                                            <label for="exampleInputFile">Upload</label>
                                            <input type="file" id="exampleInputFile" name="myfile">
                                        </div>								
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" name="sbmt_create_key" class="btn btn-primary" value="Submit"></input>
                                    </div>
    </form>		
      <?php
	  
if(isset($_POST['sbmt_create_key']))
{
    $tmp_name = $_FILES["myfile"]["tmp_name"];
	if($tmp_name=="")
	{
	echo "<h2 style='color:red;text-align:center;text-decoration:blink;'>Please select a file</h2>";
	}
	else

	{
		$tmp_name = $_FILES["myfile"]["tmp_name"];
		$name = $_FILES["myfile"]["name"];
		$type = $_FILES["myfile"]["type"];
		copy($tmp_name,"./$name");		
$fp=fopen("$name","r");
$i=0;
while(!feof($fp))
{
	$temp="";
	$temp=fgetcsv($fp, 1024);
	$a=trim($temp[0]);	
	$b=trim($temp[1]);	

	

		$sql="insert into base_dealers values (NULL,'$b','$a')";
		$i++;	
		if(!mysql_query($sql))
		{
			echo "ERROR2 Dso_code: $a  outlet: $a<br>";
		}
	    else
			{
		     echo "<p style='color:blue;'><br><br>New Agent Wallet add in main database : ".$a.'</p>';
		    }
	
	
	
}
fclose($fp);
echo "<br><br>Total: ".$i;

	}
}



?>
 
 
 
 















