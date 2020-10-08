

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

	function getProccessData(type) {
        $.ajax({
            type: "Post",
            url: "<?php echo site_url('audit_report/getProccessData');  ?>",
            data: {'type':type} ,
            success: function(data) { //alert(data); 
					
				$('#myTable').DataTable().destroy();
				$("#tableRows").html(data);
				$('#myTable').DataTable({		
					dom: 'Bfrtip',
					buttons: [
						'print'
					]					
				});
            }
        });
    }


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



</script>



</body>
</html>
