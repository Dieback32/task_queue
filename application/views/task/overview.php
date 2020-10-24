<?php
    if (md5($project[0]->id) != $this->uri->segment(3)){
        redirect('dashboard/createProject');
    }
?>
<div id="page-wrapper">
    <div class="header">
        <h2 class="page-header"><?php echo $project[0]->project_name;?></h2>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header" style="margin-left: 20px;">
                    <a class="navbar-brand" href="<?php echo site_url();?>dashboard/createProject">Project Management</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo site_url();?>dashboard/overview/<?php echo md5($project[0]->id);?>">Overview</a></li>
                    <li><a href="<?php echo site_url();?>dashboard/projectActivity/<?php echo md5($project[0]->id);?>">Activity</a></li>
                    <li><a href="<?php echo site_url();?>dashboard/completedTask/<?php echo md5($project[0]->id);?>">Completed</a></li>
                </ul>
            </div>
        </nav>
        <ol class="breadcrumb">
            <li><a href="#">Project</a></li>
            <li><a href="#">Project Management</a></li>
            <li class="active">Overview</li>
        </ol>
    </div>
    <div id="page-inner">
        <div class="panel panel-default" style="padding: 10px 10px 10px 10px">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createTask" style="margin: 10px 10px 30px 10px;">Create new task</button>
            <div class="dropdown" style="float: right;margin: 10px 10px 30px 10px;">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Manage
                    <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-header">Project</li>
                    <li><a href="<?php echo site_url();?>dashboard/manageProject/<?php echo $this->uri->segment(3);?>"><i class="fa fa-list-ul"></i>&nbsp;Manage Project</a></li>
                </ul>
            </div>
            </div>
        </div>
            <div class="row">
                <h4 style="margin-left: 50px">#Programming</h4>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Task</th>
                                <th>Urgency</th>
                                <th>Status</th>
                                <th>Responsible</th>
                                <th>Latest Comment</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($task as $cnt => $em_task): ?>
                                <?php
                                if ($em_task->category == 1):
                                    $urgency = '';
                                    if ($em_task->urgency == 1){
                                        $urgency = 'Very Low';
                                    }elseif ($em_task->urgency == 2){
                                        $urgency = 'Low';
                                    }elseif ($em_task->urgency == 3){
                                        $urgency = 'Standard';
                                    }elseif ($em_task->urgency == 4){
                                        $urgency = 'High';
                                    }elseif ($em_task->urgency == 5){
                                        $urgency = 'Critical';
                                    }
                                    $status = '';
                                    if ($em_task->status == 0){
                                        $status = 'Not started';
                                    }elseif ($em_task->status == 1){
                                        $status = 'In process';
                                    }elseif ($em_task->status == 2){
                                        $status = 'On going';
                                    }elseif ($em_task->status == 3){
                                        $status = 'For testing';
                                    }elseif ($em_task->status == 4){
                                        $status = 'Completed';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt+1;?></td>
                                        <td>
                                            <h4 style="font-weight: bold"><?php echo $em_task->task_name?></h4>
                                            <small><?php echo $em_task->description?></small>
                                        </td>
                                        <td>
                                            <select name="" data-id="<?php echo $em_task->id;?>" class="form-control selected-urgency" style="display: inline-block;">
                                                <option id="urgency-num" value="<?php echo $em_task->urgency;?>"><span id="urgency-type"><?php echo $urgency;?></span></option>
                                                <option value="1">Very Low</option>
                                                <option value="2">Low</option>
                                                <option value="3">Standard</option>
                                                <option value="4">High</option>
                                                <option value="5">Critical</option>
                                            </select>
                                            <span id="" class="urgency-spinner" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
                                        </td>
                                        <td>
                                            <select name="" id="" data-id="<?php echo $em_task->id;?>" class="form-control selected-status" style="display: inline-block;">
                                                <option id="status-num" value="<?php echo $em_task->status;?>"><span id="status-type"><?php echo $status;?></span></option>
                                                <option value="0">Not started</option>
                                                <option value="1">In process</option>
                                                <option value="2">On going</option>
                                                <option value="3">For testing</option>
                                                <option value="4">Completed</option>
                                            </select>
                                            <span class="status-spinner" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
                                        </td>
                                        <td>
                                            <?php
                                            foreach ($employee_info as $employee){
                                                if ($employee->id == $em_task->employee_id){
                                                    $firstname = $employee->firstname;
                                                    $lastname = $employee->lastname;
                                                }
                                            }
                                            ?>
                                            <select name="" id="" data-id="<?php echo $em_task->id;?>" class="form-control selected-res" style="display: inline-block;">
                                                <option id="employeeID" value="<?php echo $em_task->employee_id;?>"><span id="employee-name"><?php echo $firstname;?> <?php echo $lastname[0];?></span>.</option>
                                                <?php foreach ($employee_info as $employee){ ?>
                                                    <?php if ($employee->id != $em_task->employee_id){ ?>
                                                        <option value="<?php echo $employee->id?>"><?php echo $employee->firstname?> <?php echo $employee->lastname[0];?>.</option>
                                                    <?php }?>
                                                <?php }?>
                                            </select>
                                            <span class="responsible-spinner" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
                                        </td>
                                        <td>
                                            <?php $cnt_notify = 0; ?>
                                            <?php foreach ($notify_data as $notify){ ?>
                                                <?php if ($notify->task_id == $em_task->id){ ?>
                                                    <?php $cnt_notify = $cnt_notify + 1; ?>
                                                <?php } ?>
                                            <?php }?>
                                            <span class="label label-danger comment-badge" style="<?php if ($cnt_notify == 0){echo "visibility:hidden";}else{echo "visibility:visible";} ?>"><?php echo $cnt_notify;?></span>
                                            <a href="#" style="color: grey;font-weight: bold" data-toggle="modal" data-target="#taskComment" class="comment-task read-comment" data-id="<?php echo $em_task->id;?>" id="read-comment" ><i class="fa fa-comments fa-lg"></i> View Comments</a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4 style="margin-left: 50px">#Web Development</h4>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Task</th>
                                <th>Urgency</th>
                                <th>Status</th>
                                <th>Responsible</th>
                                <th>Latest Comment</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($task as $cnt => $em_task): ?>
                                <?php
                                if ($em_task->category == 2):
                                    $urgency = '';
                                    if ($em_task->urgency == 1){
                                        $urgency = 'Very Low';
                                    }elseif ($em_task->urgency == 2){
                                        $urgency = 'Low';
                                    }elseif ($em_task->urgency == 3){
                                        $urgency = 'Standard';
                                    }elseif ($em_task->urgency == 4){
                                        $urgency = 'High';
                                    }elseif ($em_task->urgency == 5){
                                        $urgency = 'Critical';
                                    }
                                    $status = '';
                                    if ($em_task->status == 0){
                                        $status = 'Not started';
                                    }elseif ($em_task->status == 1){
                                        $status = 'In process';
                                    }elseif ($em_task->status == 2){
                                        $status = 'On going';
                                    }elseif ($em_task->status == 3){
                                        $status = 'For testing';
                                    }elseif ($em_task->status == 4){
                                        $status = 'Completed';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt+1;?></td>
                                        <td>
                                            <h4 style="font-weight: bold"><?php echo $em_task->task_name?></h4>
                                            <small><?php echo $em_task->description?></small>
                                        </td>
                                        <td>
                                            <select name="" data-id="<?php echo $em_task->id;?>" id="" class="form-control selected-urgency" style="display: inline-block;">
                                                <option id="urgency-num" value="<?php echo $em_task->urgency;?>"><span id="urgency-type"><?php echo $urgency;?></span></option>
                                                <option value="1">Very Low</option>
                                                <option value="2">Low</option>
                                                <option value="3">Standard</option>
                                                <option value="4">High</option>
                                                <option value="5">Critical</option>
                                            </select>
                                            <span class="urgency-spinner" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
                                        </td>
                                        <td>
                                            <select name="" id="" data-id="<?php echo $em_task->id;?>" class="form-control selected-status" style="display: inline-block;">
                                                <option id="status-num" value="<?php echo $em_task->status;?>"><span id="status-type"><?php echo $status;?></span></option>
                                                <option value="0">Not started</option>
                                                <option value="1">In process</option>
                                                <option value="2">On going</option>
                                                <option value="3">For testing</option>
                                                <option value="4">Completed</option>
                                            </select>
                                            <span class="status-spinner" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
                                        </td>
                                        <td>
                                            <?php
                                            foreach ($employee_info as $employee){
                                                if ($employee->id == $em_task->employee_id){
                                                    $firstname = $employee->firstname;
                                                    $lastname = $employee->lastname;
                                                }
                                            }
                                            ?>
                                            <select name="" id="" data-id="<?php echo $em_task->id;?>" class="form-control selected-res" style="display: inline-block;">
                                                <option id="employeeID" value="<?php echo $em_task->employee_id;?>"><span id="employee-name"><?php echo $firstname;?> <?php echo $lastname[0];?></span>.</option>
                                                <?php foreach ($employee_info as $employee){ ?>
                                                    <?php if ($employee->id != $em_task->employee_id){ ?>
                                                        <option value="<?php echo $employee->id?>"><?php echo $employee->firstname?> <?php echo $employee->lastname[0];?>.</option>
                                                    <?php }?>
                                                <?php }?>
                                            </select>
                                            <span class="responsible-spinner" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
                                        </td>
                                        <td>
                                            <?php $cnt_notify = 0; ?>
                                            <?php foreach ($notify_data as $notify){ ?>
                                                <?php if ($notify->task_id == $em_task->id){ ?>
                                                    <?php $cnt_notify = $cnt_notify + 1; ?>
                                                <?php } ?>
                                            <?php }?>
                                            <span class="label label-danger comment-badge" style="<?php if ($cnt_notify == 0){echo "visibility:hidden";}else{echo "visibility:visible";} ?>"><?php echo $cnt_notify;?></span>
                                            <a href="#" style="color: grey;font-weight: bold" data-toggle="modal" data-target="#taskComment" class="comment-task read-comment" data-id="<?php echo $em_task->id;?>" id="read-comment" ><i class="fa fa-comments fa-lg"></i> View Comments</a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4 style="margin-left: 50px">#Graphic Design</h4>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Task</th>
                                <th>Urgency</th>
                                <th>Status</th>
                                <th>Responsible</th>
                                <th>Latest Comment</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($task as $cnt => $em_task): ?>
                                <?php
                                if ($em_task->category == 3):
                                    $urgency = '';
                                    if ($em_task->urgency == 1){
                                        $urgency = 'Very Low';
                                    }elseif ($em_task->urgency == 2){
                                        $urgency = 'Low';
                                    }elseif ($em_task->urgency == 3){
                                        $urgency = 'Standard';
                                    }elseif ($em_task->urgency == 4){
                                        $urgency = 'High';
                                    }elseif ($em_task->urgency == 5){
                                        $urgency = 'Critical';
                                    }
                                    $status = '';
                                    if ($em_task->status == 0){
                                        $status = 'Not started';
                                    }elseif ($em_task->status == 1){
                                        $status = 'In process';
                                    }elseif ($em_task->status == 2){
                                        $status = 'On going';
                                    }elseif ($em_task->status == 3){
                                        $status = 'For testing';
                                    }elseif ($em_task->status == 4){
                                        $status = 'Completed';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt+1;?></td>
                                        <td>
                                            <h4 style="font-weight: bold"><?php echo $em_task->task_name?></h4>
                                            <small><?php echo $em_task->description?></small>
                                        </td>
                                        <td>
                                            <select name="" data-id="<?php echo $em_task->id;?>" id="" class="form-control selected-urgency" style="display: inline-block;">
                                                <option id="urgency-num" value="<?php echo $em_task->urgency;?>"><span id="urgency-type"><?php echo $urgency;?></span></option>
                                                <option value="1">Very Low</option>
                                                <option value="2">Low</option>
                                                <option value="3">Standard</option>
                                                <option value="4">High</option>
                                                <option value="5">Critical</option>
                                            </select>
                                            <span class="urgency-spinner" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
                                        </td>
                                        <td>
                                            <select name="" data-id="<?php echo $em_task->id;?>" id="" class="form-control selected-status" style="display: inline-block;">
                                                <option id="status-num" value="<?php echo $em_task->status;?>"><span id="status-type"><?php echo $status;?></span></option>
                                                <option value="0">Not started</option>
                                                <option value="1">In process</option>
                                                <option value="2">On going</option>
                                                <option value="3">For testing</option>
                                                <option value="4">Completed</option>
                                            </select>
                                            <span class="status-spinner" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
                                        </td>
                                        <td>
                                            <?php
                                            foreach ($employee_info as $employee){
                                                if ($employee->id == $em_task->employee_id){
                                                    $firstname = $employee->firstname;
                                                    $lastname = $employee->lastname;
                                                }
                                            }
                                            ?>
                                            <select name="" id="" data-id="<?php echo $em_task->id;?>" class="form-control selected-res" style="display: inline-block;">
                                                <option id="employeeID" value="<?php echo $em_task->employee_id;?>"><span id="employee-name"><?php echo $firstname;?> <?php echo $lastname[0];?></span>.</option>
                                                <?php foreach ($employee_info as $employee){ ?>
                                                    <?php if ($employee->id != $em_task->employee_id){ ?>
                                                        <option value="<?php echo $employee->id?>"><?php echo $employee->firstname?> <?php echo $employee->lastname[0];?>.</option>
                                                    <?php }?>
                                                <?php }?>
                                            </select>
                                            <span class="responsible-spinner" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
                                        </td>
                                        <td>
                                            <?php $cnt_notify = 0; ?>
                                            <?php foreach ($notify_data as $notify){ ?>
                                                <?php if ($notify->task_id == $em_task->id){ ?>
                                                    <?php $cnt_notify = $cnt_notify + 1; ?>
                                                <?php } ?>
                                            <?php }?>
                                            <span class="label label-danger comment-badge" style="<?php if ($cnt_notify == 0){echo "visibility:hidden";}else{echo "visibility:visible";} ?>"><?php echo $cnt_notify;?></span>
                                            <a href="#" style="color: grey;font-weight: bold" data-toggle="modal" data-target="#taskComment" class="comment-task read-comment" data-id="<?php echo $em_task->id;?>" id="read-comment" ><i class="fa fa-comments fa-lg"></i> View Comments</a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4 style="margin-left: 50px">#Research</h4>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Task</th>
                                <th>Urgency</th>
                                <th>Status</th>
                                <th>Responsible</th>
                                <th>Latest Comment</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($task as $cnt => $em_task): ?>
                                <?php
                                if ($em_task->category == 4):
                                    $urgency = '';
                                    if ($em_task->urgency == 1){
                                        $urgency = 'Very Low';
                                    }elseif ($em_task->urgency == 2){
                                        $urgency = 'Low';
                                    }elseif ($em_task->urgency == 3){
                                        $urgency = 'Standard';
                                    }elseif ($em_task->urgency == 4){
                                        $urgency = 'High';
                                    }elseif ($em_task->urgency == 5){
                                        $urgency = 'Critical';
                                    }
                                    $status = '';
                                    if ($em_task->status == 0){
                                        $status = 'Not started';
                                    }elseif ($em_task->status == 1){
                                        $status = 'In process';
                                    }elseif ($em_task->status == 2){
                                        $status = 'On going';
                                    }elseif ($em_task->status == 3){
                                        $status = 'For testing';
                                    }elseif ($em_task->status == 4){
                                        $status = 'Completed';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt+1;?></td>
                                        <td>
                                            <h4 style="font-weight: bold"><?php echo $em_task->task_name?></h4>
                                            <small><?php echo $em_task->description?></small>
                                        </td>
                                        <td>
                                            <select name="" data-id="<?php echo $em_task->id;?>" id="" class="form-control selected-urgency" style="display: inline-block;">
                                                <option id="urgency-num" value="<?php echo $em_task->urgency;?>"><span id="urgency-type"><?php echo $urgency;?></span></option>
                                                <option value="1">Very Low</option>
                                                <option value="2">Low</option>
                                                <option value="3">Standard</option>
                                                <option value="4">High</option>
                                                <option value="5">Critical</option>
                                            </select>
                                            <span class="urgency-spinner" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
                                        </td>
                                        <td>
                                            <select name="" id="" data-id="<?php echo $em_task->id;?>" class="form-control selected-status" style="display: inline-block;">
                                                <option id="status-num" value="<?php echo $em_task->status;?>"><span id="status-type"><?php echo $status;?></span></option>
                                                <option value="0">Not started</option>
                                                <option value="1">In process</option>
                                                <option value="2">On going</option>
                                                <option value="3">For testing</option>
                                                <option value="4">Completed</option>
                                            </select>
                                            <span class="status-spinner" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
                                        </td>
                                        <td>
                                            <?php
                                            foreach ($employee_info as $employee){
                                                if ($employee->id == $em_task->employee_id){
                                                    $firstname = $employee->firstname;
                                                    $lastname = $employee->lastname;
                                                }
                                            }
                                            ?>
                                            <select name="" id="" data-id="<?php echo $em_task->id;?>" class="form-control selected-res" style="display: inline-block;">
                                                <option id="employeeID" value="<?php echo $em_task->employee_id;?>"><span id="employee-name"><?php echo $firstname;?> <?php echo $lastname[0];?></span>.</option>
                                                <?php foreach ($employee_info as $employee){ ?>
                                                    <?php if ($employee->id != $em_task->employee_id){ ?>
                                                        <option value="<?php echo $employee->id?>"><?php echo $employee->firstname?> <?php echo $employee->lastname[0];?>.</option>
                                                    <?php }?>
                                                <?php }?>
                                            </select>
                                            <span class="responsible-spinner" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
                                        </td>
                                        <td>
                                            <?php $cnt_notify = 0; ?>
                                            <?php foreach ($notify_data as $notify){ ?>
                                                <?php if ($notify->task_id == $em_task->id){ ?>
                                                    <?php $cnt_notify = $cnt_notify + 1; ?>
                                                <?php } ?>
                                            <?php }?>
                                            <span class="label label-danger comment-badge" style="<?php if ($cnt_notify == 0){echo "visibility:hidden";}else{echo "visibility:visible";} ?>"><?php echo $cnt_notify;?></span>
                                            <a href="#" style="color: grey;font-weight: bold" data-toggle="modal" data-target="#taskComment" class="comment-task read-comment" data-id="<?php echo $em_task->id;?>" id="read-comment" ><i class="fa fa-comments fa-lg"></i> View Comments</a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <footer style="bottom: 0;position: fixed"><p>All right reserved. <strong>3w Corner</strong></p></footer>
    </div>
    <!-- /. PAGE INNER  -->
</div>

<!--Create Task Modal -->
<?php $this->load->view($create_task);?>
<!--Task Comments Modal-->
<?php $this->load->view($task_comment);?>
<!--Alerts-->
<?php $this->load->view($alert);?>