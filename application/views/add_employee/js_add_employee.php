
<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_employee.js"></script>
<!--<script src="<?php //echo $base_url ?>public/js/form-validation-script_common.js"></script>-->
<script>


    function editUser(){

        $("#myModalEdit").modal();
    }

</script>

<script>

function buttonDisable(){
    $("#submitEmployee").attr('disabled', 'disabled');
    return true;
}
    


   function getEmployeeCode(){
        var employee_code= $("#add_employee_code").val();
        $.ajax({
            type: "Post",
            url: "<?php echo site_url('add_employee/getDataEmployee');  ?>",
            data: {'employee_code':employee_code} ,
            success: function(data) {

                if(data=="exist"){
                    $("#add_employee_code").val("");
                    $("#employee_code_status").text("Already exist");
                }else{
                    $("#employee_code_status").text("");
                }
            }
        });
    }


  
    function editModal(id){

        $.ajax({
            type: "Post",
            url: "<?php echo site_url('add_employee/getData');  ?>",
            data: {'id':id} ,
            success: function(data) {
                var ob=JSON.parse(data);
                var id=ob[0].em_id;
                var employee_code=ob[0].employee_code;
                var ref_type_id=ob[0].ref_type_id;
				var employee_name=ob[0].employee_name;
                var employee_phone=ob[0].employee_phone;
				var employee_address=ob[0].employee_address;
                var is_active=ob[0].is_active;
               
                console.log(data);
                $("#edit_id").val(id);
                $("#edit_employee_code").val(employee_code);
                $("#edit_employee_type").val(ref_type_id);
                $("#edit_employee_name").val(employee_name);
                $("#edit_employee_phone").val(employee_phone);
				$("#edit_employee_address").val(employee_address);
                $("#edit_status").val(is_active);


            }
        });


        $("#myModalEdit").modal();
    }
    function deleteModal(id){
        $("#delete_id").val(id);
        $("#myModalDelete").modal();
    }

</script>



</body>
</html>
