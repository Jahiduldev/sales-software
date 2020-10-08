
<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_zone.js"></script>
<script src="<?php echo $base_url ?>public/js/form-validation-script_common.js"></script>
<script>


    function editUser(){

        $("#myModalEdit").modal();
    }

</script>

<script>


  
    function editModal(id){

        $.ajax({
            type: "Post",
            url: "<?php echo site_url('create_sms/getData');  ?>",
            data: {'id':id} ,
            success: function(data) {
                var ob=JSON.parse(data);
                var id=ob[0].id;
                var sms1=ob[0].sms1;
				var sms2=ob[0].sms2;
				var sms3=ob[0].sms3;
				var sms4=ob[0].sms4;
               
                
                console.log(data);
                $("#edit_id").val(id);
                $("#sms1").val(sms1);
				$("#sms2").val(sms2);
				$("#sms3").val(sms3);
				$("#sms4").val(sms4);
                


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
