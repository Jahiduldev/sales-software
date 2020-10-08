<script>

    $(document).ready(function() {
        // alert("data");
        var oTable = $('#editable-sample').dataTable({
            "processing": true,
            "serverSide": true,
            "pagingType": "full_numbers",
            "ajax": '<?php echo site_url('view_customer/getTableData'); ?>',
            "aoColumns": [
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},              
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"}
            ],
            "aaSorting": [[ 7, "desc" ]]

        });
    });


    function editModal(id){

        $.ajax({
            type: "Post",
            url: "<?php echo site_url('view_customer/getData');  ?>",
            data: {'id':id} ,
            success: function(data) {
                var ob=JSON.parse(data);
                var ci_id=ob[0].ci_id;
                var ref_area_id=ob[0].ref_area_id;
                var client_code=ob[0].client_code;
                var client_name=ob[0].client_name;
                var client_address=ob[0].client_address;
                var client_phone=ob[0].client_phone;
                var is_in_service=ob[0].is_in_service;
                var is_active=ob[0].is_active;
                var date_of_birth=ob[0].date_of_birth;
                var email_address=ob[0].email_address;

                var ref_sale_by=ob[0].ref_sale_by;
                var ref_install_by=ob[0].ref_install_by;



                console.log(data);
                $("#edit_id").val(ci_id);
                $("#customer_code").val(client_code);
                
                $("#salesby").val(ref_sale_by);
                $("#installby").val(ref_install_by);
                
                $("#techzone").val(ref_area_id);
                $("#customer_name").val(client_name);
                $("#address").val(client_address);
                $("#phone").val(client_phone);
                $("#date_birth").val(date_of_birth);
                $("#email").val(email_address);


            }
        });


        $("#myModalEdit").modal();
    }

</script>


</body>
</html>
