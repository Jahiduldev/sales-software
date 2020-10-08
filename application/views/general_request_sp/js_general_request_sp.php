
<script>
	
	function responseCheck(id){
		
		if(id==1){			
			//alert(id);
			$('#showHideForm').show();
		}else{
			$('#showHideForm').hide();
		}
		
		
	}

    

    function addModal(d_id){

        $.ajax({
            type: "Post",
            url: "<?php echo site_url('general_request_sp/getData');  ?>",
            data: {'d_id':d_id} ,
            success: function(data) { //alert(data);                 
			
			if(data != ''){
				
					var ob=JSON.parse(data);
					var client_id=ob[0].ci_id;
					var m_id=ob[0].m_id;
					var client_code=ob[0].client_code; 
					var client_name=ob[0].client_name; 
					var is_in_service=ob[0].is_in_service; 
					var client_phone=ob[0].client_phone;
					
					var client_address=ob[0].client_address;
					var employee_name=ob[0].saler; 
					var installer=ob[0].installer; 
					var area_name=ob[0].area_name;
					var is_in_service=ob[0].is_in_service; 
					var is_filter_change=ob[0].is_filter_change; 
					var cu_id=ob[0].ref_client_id; 
					//var service_description=ob[0].service_description; 
					
					
					$("#basicInfo").show();					
					
					if(is_in_service!=1){var status = '<span style="color:red">NSP</span>';}else{var status = 'SP';}
					if(is_filter_change!=0){var fstatus = '<span style="color:red">NSP</span>';}else{var fstatus = 'SP';}

					$("#client_id").html(client_id);
					$("#ccode").val(m_id);
					$("#cid").val(d_id);
					$("#hidden_client_id").val(client_id);
					$("#add_customer_code").html(client_code);
					$("#add_customer_name").html(client_name);
					$("#add_status_number").html(status);
					$("#add_mobile_number").html(client_phone);					
					
					$("#add_client_address").html(client_address);
					$("#add_sales_by").html(employee_name);
					$("#add_install_by").html(installer);
					$("#add_tech_zone").html(area_name);
					$("#add_filterStatus_number").html(fstatus);
					//$("#description").html(service_description);
				}else{
					
					
					$("#notFound").html('<span style="color:red">No Data Found !</span>');
					
				}

            }
        });


        $("#myModalAd").modal();
    }
	
	
	function getDateSearch(){

        var date_from=$("#date_from").val();
        var date_to=$("#date_to").val();
		
		if(date_from!='' && date_to!=''){
			$.ajax({
				type: "Post",
				url: "<?php echo site_url('general_request_sp/getDateSearch');  ?>",
				data: {'date_from':date_from, 'date_to':date_to } ,
				success: function(data) {  
					
					$('#myTable').DataTable().destroy();
					$("#dateTable").html(data);
					$('#myTable').DataTable();
				
				}			
				
			});
		}else{
			if(date_from==''){$("#date_from").focus();}			
			if(date_from!='' && date_to==''){$("#date_to").focus();}
			
			
		}

    }

</script>


</body>
</html>
