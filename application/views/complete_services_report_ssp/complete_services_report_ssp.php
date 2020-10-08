<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        View Completed Service
                    </header>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-lg-12">

                                <form role="form" class="cmxform form-horizontal tasi-form" method="post"  id="RoleForm" action="#">

                                    <div class="form-group">
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">From Date</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="default-date-picker form-control" placeholder="Enter From Date" id="date_from"  name="date_from"  required>
                                        </div>
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">To Date</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="default-date-picker form-control" placeholder="Enter To Date" id="date_to"  name="date_to"  required>
                                        </div>
                                    </div>
                                    <button type="button" name="submitDate" class="btn btn-info pull-right" onclick="getDateSearch()">Submit</button>
                                </form>


                            </div>
                        </div>
                        <br>



                        <div class="adv-table">
                            <table class="display table table-bordered" id="editable-sample"> <!--hidden-table-info   -->
                                <thead>
                                    <tr>

                                        <th >C_ID</th>
                                        <th>C_NAME</th>
                                        <th >ADDRESS</th>
                                        <th >PHONE</th>
                                        <th >STATUS</th>
                                        <th >ZONE</th>
                                        <th >MODEL</th>
                                        <th >INS_DATE</th>
                                        <th >SER_DATE</th>
                                        <th >PRIORITY</th>
                                        <th >G/R</th>
                                        <th >ACTION</th>

                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </section>
            </div>
        </div>




    </section>
</section>
<!--main content end-->

