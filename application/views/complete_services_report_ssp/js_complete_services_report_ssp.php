
<script>

    $(document).ready(function() {

        var oTable = $('#editable-sample').dataTable({
            "processing": true,
            "serverSide": true,
            "pagingType": "full_numbers",
            "ajax": '<?php echo site_url('complete_services_report/getTableData'); ?>',
            "aoColumns": [
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},              
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "hide_coloum"}
            ],
            "aaSorting": [[ 11, "desc" ]]
        });

    });


    function getDateSearch(){

        var date_from=$("#date_from").val();
        var date_to=$("#date_to").val();
       
        var oTable = $('#editable-sample').dataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "pagingType": "full_numbers",
            "ajax": "<?php echo site_url('complete_services_report/getTableDataDate/?date_from='); ?>"+date_from+"&date_to="+date_to,
            "aoColumns": [
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "hide_coloum"}
            ],
            "aaSorting": [[ 11, "desc" ]]
        });

    }

</script>


</body>
</html>
