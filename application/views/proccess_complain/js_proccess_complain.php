

<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_view_complete_service.js"></script>
<script src="<?php echo $base_url ?>public/js/form-validation-script_common.js"></script>
<script>

	

    $(function(){
		
		$("#main-content").draggable();
	});
	
	
	function editUser(){

        $("#myModalEdit").modal();
    }

	

    function addModal(ref_id){
        
		var arr=ref_id.split('+');
        var req_id=arr[0];
        var ref_cus_id=arr[1];
        $("#req_id").val(req_id);
        $("#ref_cus_id").val(ref_cus_id);
        $("#request_date").val(arr[2]);
		
		
		
		
		 $.ajax({
            type: "Post",
            url: "<?php echo site_url('proccess_complain/getData2');  ?>",
            data: {'user_id':ref_cus_id},
            success: function(data) {
				
                var ob=JSON.parse(data);
                var client_id=ob[0].ci_id;
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
				var service_description=ob[0].service_description; 
				
				if(is_in_service!=1){var status = '<span style="color:red">NSP</span>';}else{var status = 'SP';}
				if(is_filter_change!=0){var fstatus = '<span style="color:red">NSP</span>';}else{var fstatus = 'SP';}

                $("#client_id").html(client_id);
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
                $("#description").html(service_description);
				
				$("#basicInfo").show();
				
				$("#myModalADD").modal();
                

            }
		
		
		});
		
		

        
    }

        function removeModal(ref_id){
        var arr=ref_id.split('-');
        var req_id=arr[0];
        var ref_cus_id=arr[1];
        $("#req_id_remove").val(req_id);
        $("#ref_cus_id_remove").val(ref_cus_id);

        $("#myModalRemove").modal();
    }



    function deleteUser(user_id){
        $("#delete_user_id").val(user_id);
        $("#myModalDelete").modal();
    }
	
	
    

</script>



</body>
</html>
