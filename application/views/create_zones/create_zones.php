<!--main content start-->
<section id="main-content" style='color:black;'>
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Create Zones
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addZoneForm"  role="form" method="post"  action="<?php echo site_url('create_zones/addZone');  ?>">

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Zone Name *</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Zone Name" id="add_zone_name" name="add_zone_name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Description *</label>
                                <div class="col-lg-10">  
                                   <textarea class="form-control"  placeholder="Enter Description" id="add_description" name="add_description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Status *</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="add_status" name="add_status"> <!-- input-sm m-bot15  -->
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="2">Deactive</option>
                                    </select>
                                </div>
                            </div>



                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        View Zones
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
                                        <th>Zone Name </th>

                                        <th class="hidden-phone">Description </th>
                                        <th>Action</th>
                                        <th class="hide_coloum">Test</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($get_base_areas_data as $row) :
                                        $id=$row->a_id;
                                        $area_name=$row->area_name;
                                        $area_description=$row->area_description;
                                        ?>
                                    <tr class="gradeX">
                                        <td><?php echo $area_name; ?></td>
                                        <td class="hidden-phone"><?php echo $area_description; ?></td>
                                        <td>
                                            <button class="btn btn-primary btn-xs" onclick="editModal(<?=$id?>);"><i class="fa fa-pencil"></i></button>
                                            <!--<button class="btn btn-danger btn-xs" onclick="deleteModal(<?=$id?>);"><i class="fa fa-trash-o "></i></button>-->
                                        </td>
                                        <td class="hide_coloum"><?php echo $id; ?></td>
                                    </tr>

                                    <?php endforeach;  ?>
                                </tbody>
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

<!-- modal -->

<!-- Modal -->
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Zone Confirmation</h4>
            </div>

            <div class="modal-body">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('create_zones/editZone');  ?>">

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Zone Name*</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Enter Zone Name" id="edit_zone_name" name="edit_zone_name">
                        </div>
                        <input type="hidden" class="form-control" id="edit_id" name="edit_id">
                    </div>


                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Description *</label>
                        <div class="col-lg-9">
                            <textarea class="form-control"  id="edit_description" name="edit_description">Enter Description </textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Status *</label>
                        <div class="col-lg-9">
                            <select class="form-control" id="edit_status" name="edit_status"> <!-- input-sm m-bot15  -->
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="2">Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-10 col-lg-2">
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
<!-- Modal -->
<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="<?=site_url('create_zones/deleteZone')?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delete Zone Confirmation</h4>
                </div>
                <div class="modal-body">

                    Do You Want To Delete This Zone?
                    <input type="hidden" id="delete_id" name="delete_id" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Yes</button>
                    <button data-dismiss="modal" class="btn btn-default" type="button">No</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- modal -->

</section>
</section>
<!--main content end-->

