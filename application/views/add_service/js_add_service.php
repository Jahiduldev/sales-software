<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_view_service.js"></script>
<script src="<?php echo $base_url ?>public/js/form-validation-script_common.js"></script>
<script>


    function editUser(){

        $("#myModalEdit").modal();
    }

</script>

<script>


    function addModal(){
		
		var user_id = $('#customer_code').val();  
        $.ajax({
            type: "Post",
            url: "<?php echo site_url('add_service/getData1');  ?>",
			beforeSend: function(){
				$("#notFound").html('');
				$("#basicInfo").hide();
				$('#customer_code').css({'height':'5px'});
			},
            data: {'user_id':user_id},
            success: function(data) {
				//alert(data.length);
				
				if(data.length > 100){
				
					var ob=JSON.parse(data);
					var client_id=ob[0].ci_id;
					var client_code=ob[0].client_code; 
					var client_name=ob[0].client_name; 
					var is_in_service=ob[0].is_in_service; 
					var client_phone=ob[0].client_phone;
					var alt_phone=ob[0].client_phone_alt;

					var client_address=ob[0].client_address;
					var employee_name=ob[0].saler; 
					var installer=ob[0].installer; 
					var area_name=ob[0].area_name;
					var is_in_service=ob[0].is_in_service; 
					var is_filter_change=ob[0].is_filter_change; 
					var custo_status=ob[0].default; 
					var dealer = ob[0].model_name; 	

					$("#notFound").hide();
					$("#basicInfo").show();					
					
					if(is_in_service !=1 ){var status = '<span style="color:red">NSP</span>';}else{var status = 'SP';}
					if(is_filter_change !=0 ){var fstatus = '<span style="color:red">NSP</span>';}else{ var fstatus = 'SP'; }
					if(custo_status != 0){ 
					var cust_status = '<span style="color:red">Default</span>'; 
					}else{ var cust_status = '';}

					$("#client_id").html(client_code);
					$("#hidden_client_id").val(client_id);
					$("#add_customer_code").html(client_code);
					$("#add_customer_name").html(client_name);
					$("#add_status_number").html(status);
					$("#add_mobile_number").val(client_phone);
					$("#add_service_phone_alt").val(alt_phone);	
					$("#custo_status").html(cust_status);	
				        $("#details_link").attr('href','<?php echo base_url()?>view_customer/getCustomerServiceDetail/'+client_id);	
					$("#dealer").html(dealer);					
					
					$("#add_client_address").html(client_address);
					$("#add_sales_by").html(employee_name);
					$("#add_install_by").html(installer);
					$("#add_tech_zone").html(area_name);
					$("#add_filterStatus_number").html(fstatus);
				}else{
					
					$("#basicInfo").hide();		
					$("#notFound").html('<span style="color:red">'+data+'</span>')
								  .show();
					
				}
				
                
				$('#customer_code').css({'height':'auto'});
            }
        });

    }
    function deleteUser(user_id){
        $("#delete_user_id").val(user_id);
        $("#myModalDelete").modal();
    }

</script>



</body>
</html>
