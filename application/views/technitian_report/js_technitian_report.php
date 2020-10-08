

<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_request_service_report.js"></script>
<script src="<?php echo $base_url ?>public/js/form-validation-script_common.js"></script>
<script>

	$(document).ready(function() {
		$('#myTable').DataTable().destroy();
		$('#myTable').DataTable({		
		
			dom: 'Bfrtip',
			buttons: [
				'print'
			]
			
		});
	});

    function editUser() {

        $("#myModalEdit").modal();
    }


    function editUser() {

        $("#myModalEdit").modal();
    }

</script>

<script>


    function addModal(ref_id) {
        var arr = ref_id.split('-');
        var req_id = arr[0];
        var ref_cus_id = arr[1];
        $("#req_id").val(req_id);
        $("#ref_cus_id").val(ref_cus_id);
        $("#myModalADD").modal();
    }

    function removeModal(ref_id) {
        var arr = ref_id.split('-');
        var req_id = arr[0];
        var ref_cus_id = arr[1];
        $("#req_id_remove").val(req_id);
        $("#ref_cus_id_remove").val(ref_cus_id);
        $("#myModalRemove").modal();
    }



    function deleteUser(user_id) {
        $("#delete_user_id").val(user_id);
        $("#myModalDelete").modal();
    }
	
	
	function getDateSearch(){

        var date_from=$("#date_from").val();
        var date_to=$("#date_to").val();
		
		if(date_from!='' && date_to!=''){
			$.ajax({
				type: "Post",
				url: "<?php echo site_url('technitian_report/getDateSearch');  ?>",
				data: {'date_from':date_from, 'date_to':date_to } ,
				success: function(data) {  
					
					$('#myTable').DataTable().destroy();
					$("#dateTable").html(data);
					$('#myTable').DataTable();
				
				}			
				
			});
		}else{
			if(date_from==''){ $("#date_from").focus(); }			
			if(date_from!='' && date_to==''){ $("#date_to").focus(); }
			
			
		}

    }



</script>



</body>
</html>
