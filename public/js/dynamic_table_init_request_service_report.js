function fnFormatDetails ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
   
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>CUSTOMER ID:</td><td>'+aData[1]+'</td></tr>';
    sOut += '<tr><td>CUSTOMER NAME:</td><td>'+aData[2]+'</td></tr>';
    sOut += '<tr><td>ADDRESS:</td><td>'+aData[3]+'</td></tr>';
    sOut += '<tr><td>PHONE:</td><td>'+aData[4]+'</td></tr>';
     sOut += '<tr><td>STATUS:</td><td>'+aData[5]+'</td></tr>';
    sOut += '<tr><td>TECH ZONE:</td><td>'+aData[6]+'</td></tr>';
     sOut += '<tr><td>MODEL:</td><td>'+aData[7]+'</td></tr>';
    sOut += '<tr><td>INSTALL DATE:</td><td>'+aData[8]+'</td></tr>';
     sOut += '<tr><td>SERVICE DATE:</td><td>'+aData[9]+'</td></tr>';
    sOut += '<tr><td>PRIORITY:</td><td>'+aData[10]+'</td></tr>';

    sOut += '</table>';

    return sOut;
}
var host=window.location.host;
$(document).ready(function() {

    $('#dynamic-table').dataTable( {
        "aaSorting": [[ 11, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
    var nCloneTh = document.createElement( 'th' );
    var nCloneTd = document.createElement( 'td' );
    nCloneTd.innerHTML = '<img src="http://'+host+'/bl_topup/public/img/details_open.png">';
    nCloneTd.className = "center";

    $('#hidden-table-info thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

    $('#hidden-table-info tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
    var oTable = $('#hidden-table-info').dataTable( {
        "aoColumnDefs": [
        {
            "bSortable": false,
            "aTargets": [ 0 ]
        },
         { "sClass": 'hide_coloum', "aTargets": [ 0 ] }
        // {  "aTargets": [ 6 ], "bVisible": false }
          
        ],
        "aaSorting": [[9, 'desc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    $(document).on('click','#hidden-table-info tbody td img',function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "http://"+host+"/bl_topup/public/img/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "http://"+host+"/bl_topup/public/img/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
        }
    } );
} );