<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_user.js"></script>
<script src="<?php echo $base_url ?>public/js/form-validation-script_add_user.js"></script>
<script>


    function editUser(){

        $("#myModalEdit").modal();
    }

</script>

<script>


    function editUser(user_id){

        $.ajax({
            type: "Post",
            url: "<?php echo site_url('add_user/getMenuData');  ?>",
            data: {'user_id':user_id} ,
            success: function(data) {
                var ob=JSON.parse(data);
                var user_id=ob[0].user_id;
                var company_name=ob[0].company_name;
                var name=ob[0].name;
                var phone=ob[0].phone;
                var email=ob[0].email;
                var address=ob[0].address;
                var role=ob[0].role_id;
                var status=ob[0].status;
                console.log(data);
                $("#edit_user_id").val(user_id);
                $("#edit_company_name").val(company_name);
                $("#edit_name").val(name);
                $("#edit_phone").val(phone);
                $("#edit_email").val(email);
                $("#edit_address").val(address);
                $("#edit_role").val(role).change();
                $("#edit_status").val(status);
            }
        });


        $("#myModalEdit").modal();
    }
    
        function changeUser(user_id){

        $.ajax({
            type: "Post",
            url: "<?php echo site_url('add_user/getMenuData');  ?>",
            data: {'user_id':user_id} ,
            success: function(data) {
                var ob=JSON.parse(data);
                var user_id=ob[0].user_id;              
                var name=ob[0].name;
               var password=ob[0].password;
               var decodedString = atob(password);
              
                $("#edit_user_id2").val(user_id);                
                $("#edit_name2").val(name);
               $("#edit_password").val(decodedString);
            
            }
        });


        $("#myModalChange").modal();
    }
    
    
	 function deleteUser(user_id){
        $("#delete_user_id").val(user_id);
        $("#myModalDelete").modal();
    }

</script>



</body>
</html>
