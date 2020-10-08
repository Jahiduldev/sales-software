
<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_model.js"></script>
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

    function getModelCode(){
        var model_code= $("#add_model_code").val();
        $.ajax({
            type: "Post",
            url: "<?php echo site_url('create_models/getDataModel');  ?>",
            data: {'model_code':model_code} ,
            success: function(data) {

                if(data=="exist"){
                    $("#add_model_code").val("");
                    $("#model_code_status").text("Already exist");
                }else{               
                    $("#model_code_status").text("");
                }
            }
        });
    }


    function editModal(id){

        $.ajax({
            type: "Post",
            url: "<?php echo site_url('add_dealer/getData');  ?>",
            data: {'id':id} ,
            success: function(data) {
                var ob=JSON.parse(data);
                var id=ob[0].id;
                var model_code=ob[0].model_code;
                var model_name=ob[0].model_name;
                
                console.log(data);
                $("#edit_id").val(id);
                $("#edit_dealer_code").val(model_code);
                $("#edit_dealer_name").val(model_name);
               


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
