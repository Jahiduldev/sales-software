<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
      

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        View SMS Text   <span style="color:red;">(SmS Length Max 155 Characters)</span>
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
                                        <th>Complain Create SMS </th>
                                         <th>New Sales SMS </th>

										<th class="hidden-phone">Complain Update SMS  </th>
										<th class="hidden-phone">Complain Default SMS  </th>
                                        <th>Action</th>
                                        <th class="hide_coloum">Test</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($get_sms_data as $row) :
                                        $id=$row->id;
                                        $sms1=$row->sms1;
										$sms2=$row->sms2;
										$sms3=$row->sms3;
										$sms4=$row->sms4;
                                        
                                        ?>
                                    <tr class="gradeX">
                                        <td><?php echo $sms1; ?></td>
										<td><?php echo $sms2; ?></td>
										<td><?php echo $sms3; ?></td>
										<td><?php echo $sms4; ?></td>
                                        
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
                <h4 class="modal-title">Edit SMS Text</h4>
            </div>

            <div class="modal-body">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('create_sms/editSms');  ?>">

                    <input type="hidden" class="form-control" id="edit_id" name="edit_id">


                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Complain Create SMS *</label>
                        <div class="col-lg-9">
                            <textarea class="form-control"  id="sms1" name="sms1" maxlength="155">Enter sms </textarea>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">New Sales SMS
*</label>
                        <div class="col-lg-9">
                            <textarea class="form-control"  id="sms2" name="sms2" maxlength="155">Enter sms </textarea>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3" maxlength="155">Complain Update SMS *</label>
                        <div class="col-lg-9">
                            <textarea class="form-control"  id="sms3" name="sms3">Enter sms </textarea>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Complain Default SMS *</label>
                        <div class="col-lg-9">
                            <textarea class="form-control"  id="sms4" name="sms4"maxlength="155">Enter sms </textarea>
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

