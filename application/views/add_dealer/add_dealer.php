<!--main content start-->
<section id="main-content" style='color:black;'>
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Create Dealers
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addModelForm" 
						onSubmit="returnbuttonDisable();"  role="form" method="post"  
						action="<?php echo site_url('add_dealer/addModel');  ?>">

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Dealer Name *</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Dealer Name" 
									id="add_dealer_name" name="add_dealer_name" 
									onchange=""  required>
                                    <span id="model_code_status" class="text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Dealer Code *</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Dealer Code" id="add_dealer_code" 
									name="add_dealer_code"  required>
                                </div>
                            </div>                            

                            <button type="submit" id="submitEmployee" class="btn btn-info pull-right">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        View Dealers
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
                                        <th class="hidden-phone">Dealer Code</th>
                                        <th>Dealer Name</th>
                                        
                                        <th>Action</th>
                                        <th class="hide_coloum">Test</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($get_base_dealers_data as $row) :
                                        $id=$row->id;
                                        $model_code=$row->model_code;
                                        $model_name=$row->model_name;
                                        //$model_description=$row->model_description;
                                        ?>
                                    <tr class="gradeX">
                                        <td class="hidden-phone"><?php echo $model_code; ?></td>
                                        <td><?php echo $model_name; ?></td>
                                       
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
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Model Confirmation</h4>
            </div>

            <div class="modal-body">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('add_dealer/editModel');  ?>">

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Dealer Name *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Enter Dealer Name" id="edit_dealer_name" name="edit_dealer_name">
                        </div>
                         <input type="hidden" class="form-control" id="edit_id" name="edit_id">
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Dealer Code *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Enter Dealer Code" id="edit_dealer_code" name="edit_dealer_code">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-10 col-lg-2">
                            <button class="btn btn-success"  type="submit">Submit</button>
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
        <form method="post" action="<?=site_url('create_models/deleteModel')?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delete Model Confirmation</h4>
                </div>
                <div class="modal-body">

                    Do You Want To Delete This Model?
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

