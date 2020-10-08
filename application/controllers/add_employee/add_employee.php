<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Add Employee
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addEmployeeForm"  role="form" method="post"  action="<?php echo site_url('add_employee/addEmployee');  ?>">

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Employee Code *</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Employee Code" id="add_employee_code" name="add_employee_code" onchange="getEmployeeCode()">
                                     <span id="employee_code_status" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Employee Type *</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="add_employee_type" name="add_employee_type"> <!-- input-sm m-bot15  -->
                                        <option value="">Select Type</option>
                                        <option value="1">Salesman</option>
                                        <option value="2">Technician</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Employee Name*</label>
                                <div class="col-lg-10">  
                                    <input type="text" class="form-control" placeholder="Enter Employee Name" id="add_employee_name" name="add_employee_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Employee Phone *</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Phone Number" id="add_phone" name="add_phone">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Employee Address *</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Address" id="add_address" name="add_address"></textarea>

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
                        View Empoyee
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
                                        <th class="hidden-phone">Employee Code </th>
                                        <th class="hidden-phone">Employee Type</th>
                                        <th >Employee Name</th>
                                        <th class="hidden-phone">Employee Phone</th>
                                        <th class="hidden-phone">Employee Address</th>
                                        <th>Action</th>
                                        <th class="hide_coloum">Test</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($get_base_employees_data as $row) :
                                        $id=$row->em_id;
                                        $employee_code=$row->employee_code;
                                        $ref_type_id=$row->ref_type_id;

                                        $queryArea= $this->db->query("SELECT * FROM base_employee_types WHERE emty_id='$ref_type_id'");
                                        foreach ($queryArea->result() as $rowArea) {
                                            $type_name=$rowArea->type_name;
                                        }

                                        $employee_name=$row->employee_name;
                                        $employee_phone=$row->employee_phone;
                                        $employee_address=$row->employee_address;

                                        ?>
                                    <tr class="gradeX">
                                        <td class="hidden-phone"><?php echo $employee_code; ?></td>
                                        <td class="hidden-phone"><?php echo $type_name; ?></td>
                                        <td ><?php echo $employee_name; ?></td>
                                        <td class="hidden-phone"><?php echo $employee_phone; ?></td>
                                        <td class="hidden-phone"><?php echo $employee_address; ?></td>

                                        <td>
                                            <button class="btn btn-primary btn-xs" onclick="editModal(<?=$id?>);"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-danger btn-xs" onclick="deleteModal(<?=$id?>);"><i class="fa fa-trash-o "></i></button>
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
                <h4 class="modal-title">Edit Employee Confirmation</h4>
            </div>

            <div class="modal-body">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('add_employee/editEmployee');  ?>">

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Employee Code *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Enter Employee Code" id="edit_employee_code" name="edit_employee_code">
                        </div>
                        <input type="hidden" class="form-control" id="edit_id" name="edit_id">
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Employee Type  *</label>
                        <div class="col-lg-9">
                            <select class="form-control" id="edit_employee_type" name="edit_employee_type"> <!-- input-sm m-bot15  -->
                                <option value="">Select Type</option>
                                <option value="1">Salesman</option>
                                <option value="2">Technician</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Employee Name*</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Enter Employee Name" id="edit_employee_name" name="edit_employee_name">
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Employee Phone*</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Enter Employee Phone" id="edit_employee_phone" name="edit_employee_phone">
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Employee Address*</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Enter Employee Address" id="edit_employee_address" name="edit_employee_address">
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
        <form method="post" action="<?=site_url('add_employee/deleteEmployee')?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delete Employee Confirmation</h4>
                </div>
                <div class="modal-body">

                    Do You Want To Delete This Employee?
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

