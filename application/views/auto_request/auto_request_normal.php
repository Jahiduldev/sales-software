
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <?php

            $toatalval = 200;

            $rowsperpage=50;
            $totalpages = ceil($toatalval / $rowsperpage);
            if (isset($c_page) && is_numeric($c_page)) {
                $currentpage = (int)$c_page;
            } else {
                $currentpage = 1;
            }

            if ($currentpage >= $totalpages) {
                $currentpage = $totalpages;
            }
            if ($currentpage <= 1) {
                $currentpage = 1;
            }

            $offset = ($currentpage - 1) * $rowsperpage;
            echo "<div class='paging_link'>";
          

            $range=5;
            for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {

                if (($x > 0) && ($x <= $totalpages)) {
                    if ($x == $currentpage) {
                        echo " [<b>$x</b>] ";
                    } else {
                        echo "<a href='".site_url('auto_request/showTable/'.$x.'/'.$offset)."'>$x</a> ";
                    }
                }
            }



            if ($currentpage != $totalpages) {

                $nextpage = $currentpage + 1;

                echo "<a class='a_bg' href='".site_url('auto_request/showTable/'.$nextpage.'/'.$offset)."'>NEXT</a>";


            }
            else {

                echo " <a class='a_bg_inac' >NEXT</a> ";


            }


            echo '</div>';
            ?>
        </div>



        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Send Sms To All
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body">

                        <form class="cmxform form-horizontal tasi-form" id="addCustomerForm"  role="form" method="post"  action="<?php echo site_url('auto_request/sendSms');  ?>">


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Sms Box *</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Text" id="sms" name="sms" required></textarea>

                                </div>
                            </div>






                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>


                    </div>
                </section>
            </div>
        </div>




    </section>
</section>
<!--main content end-->



<!-- Modal -->
<div class="modal fade" id="myModalADD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Service Confirmation</h4>
            </div>

            <div class="modal-body">
                <form class="cmxform form-horizontal tasi-form" id="addServiceForm"  role="form" method="post"  action="<?php echo site_url('auto_request/addReqService');  ?>">

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Customer Code *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" readonly="readonly" placeholder="Enter Customer Code" id="add_customer_code" name="add_customer_code">
                            <input type="hidden" class="form-control"  id="client_id" name="client_id">
                            <input type="hidden" class="form-control"  id="master_id" name="master_id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Mobile NUmber *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" readonly="readonly" placeholder="Enter Mobile Number" id="add_mobile_number" name="add_mobile_number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Service Priority *</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="add_service_priority" id="add_service_priority" required>
                                <option value="">Select Priority</option>
                                <option value="1">Normal</option>
                                <option value="2">Moderate</option>
                                <option value="3">High</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Service Date *</label>
                        <div class="col-lg-9">
                            <input class="form-control form-control-inline input-medium default-date-picker" size="16" placeholder="Enter Service Date" value="" type="text" id="add_request_date" name="add_request_date">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Service Description *</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" placeholder="Enter Service Description" id="add_service_description" name="add_service_description"></textarea>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-3">
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- modal -->


</section>
</section>
<!--main content end-->














