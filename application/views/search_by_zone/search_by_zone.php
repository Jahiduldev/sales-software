<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        View CUSTOMER
                    </header>
                    <div class="panel-body">
                        <form role="form" class="cmxform form-horizontal tasi-form" method="post"  id="RoleForm" action="#">
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Zone *</label>
                                <div class="col-lg-10">  
                                    <select class="form-control" name="techzone" id="techzone" required>
                                        <option value="">Select Zone</option>
                                        <?php
                                        foreach ($get_base_areas_data as $row) :
                                            $id = $row->a_id;
                                            $area_name = $row->area_name;
                                            ?>
                                            <option value="<?=$id ?>"><?= $area_name ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>
                            <button type="button" name="submitDate" class="btn btn-info pull-right" onclick="getSearchZone()">Submit</button>
                        </form>


                        <div class="adv-table">
                            <table class="display table table-bordered" id="editable-sample"> <!--hidden-table-info   -->
                                <thead>
                                    <tr>

                                        <th>C_ID</th>
                                        <th>INS.DATE</th>
                                        <th>C_NAME</th>
                                        <th>PHONE</th>
                                        <th>SALES BY</th>
                                        <th>STATUS</th>
                                        <th>ZONE</th>
                                        <th>Action</th>

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

<!-- Modal -->
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Customer Confirmation</h4>
            </div>

            <div class="modal-body">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('search_by_zone/editModel'); ?>">
                    <input type="hidden" class="form-control" id="edit_id" name="edit_id">



                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Customer Code *</label>
                        <div class="col-lg-9">
                            <input type="text" readonly="readonly" class="form-control" value="" placeholder="Auto Generated" id="customer_code" name="customer_code">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Tech Zone *</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="techzone" id="techzone" required>
                                <option value="">Select Zone</option>
                                <?php
                                foreach ($get_base_areas_data as $row) :
                                    $id = $row->a_id;
                                    $area_name = $row->area_name;
                                    ?>
                                    <option value="<?= $id ?>"><?= $area_name ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Customer Name *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Enter Customer Name" id="customer_name" name="customer_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Customer Address *</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" placeholder="Enter Address" id="address" name="address"></textarea>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Customer Phone *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Enter Phone" id="phone" name="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Date of Birth </label>
                        <div class="col-lg-9">
                            <input class="form-control form-control-inline input-medium default-date-picker" size="16" placeholder="Enter Date Of Birth" value="" type="text" id="date_birth" name="date_birth">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Email Address </label>
                        <div class="col-lg-9">
                            <input type="email" class="form-control" placeholder="Enter Email" id="email" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-10 col-lg-3">
                            <button class="btn btn-success" type="submit">Submit</button>
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