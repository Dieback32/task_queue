<div id="page-wrapper">
    <div class="header">
        <h1 class="page-header">
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Project</a></li>
            <li><a href="#">Task</a></li>
            <li class="active">Employee Task</li>
        </ol>
    </div>
    <div id="page-inner">
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#programming" data-toggle="tab">Programming</a>
                            </li>
                            <li class=""><a href="#profile" data-toggle="tab">Web Development</a>
                            </li>
                            <li class=""><a href="#messages" data-toggle="tab">Graphic Design</a>
                            </li>
                            <li class=""><a href="#settings" data-toggle="tab">Research</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="programming">
                                <h4>Programming</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Task</th>
                                            <th>Responsible</th>
                                            <th>Urgency</th>
                                            <th>Status</th>
                                            <th>Latest Comment</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($task as $cnt => $em_task): ?>
                                            <?php
                                            if ($em_task->category == 1){
                                                if ($em_task->employee_id == 0){
                                                    $employee_name = '';
                                                }else{
                                                    foreach ($info as $employee):
                                                        if ($em_task->employee_id == $employee->id){
                                                            $employee_name = $employee->firstname.' '.$employee->lastname;
                                                        }
                                                    endforeach;
                                                }

                                                $urgency = '';
                                                if ($em_task->urgency == 1){
                                                    $urgency = 'Very Low';
                                                    $bg = 'default';
                                                }elseif ($em_task->urgency == 2){
                                                    $urgency = 'Low';
                                                    $bg = 'info';
                                                }elseif ($em_task->urgency == 3){
                                                    $urgency = 'Standard';
                                                    $bg = 'primary';
                                                }elseif ($em_task->urgency == 4){
                                                    $urgency = 'High';
                                                    $bg = 'warning';
                                                }elseif ($em_task->urgency == 5){
                                                    $urgency = 'Critical';
                                                    $bg = 'danger';
                                                }
                                                ?>

                                                <tr>
                                                    <td><?php echo $cnt+1?></td>
                                                    <td>
                                                        <h4 style="font-weight: bold">
                                                            <?php echo $em_task->task_name;?>
                                                            <?php if ($em_task->employee_id == $this->session->userdata('employee_id')): ?>
                                                            <span class="label label-danger new-task-badge"><?php echo $this->session->tempdata($em_task->task_name);?></span>
                                                            <?php endif; ?>
                                                        </h4>
                                                        <small><?php echo $em_task->description?></small>
                                                    </td>
                                                    <td><?php echo $employee_name;?></td>
                                                    <td>
                                                        <span class="label label-<?php echo $bg;?>">
                                                             <?php echo $urgency;?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <select name="" data-id="<?php echo $em_task->id;?>" id="" class="form-control selected-status" style="display: inline-block!important;" <?php if ($em_task->employee_id != $this->session->userdata('employee_id')){echo 'disabled';} ?>>
                                                            <?php if ($em_task->status == 1){ ?>
                                                                <?php $status = 'In Progress' ?>
                                                            <?php }elseif ($em_task->status == 2){?>
                                                                <?php $status = 'On Going' ?>
                                                            <?php }elseif ($em_task->status == 3){?>
                                                                <?php $status = 'For Testing' ?>
                                                            <?php }elseif ($em_task->status == 4){?>
                                                                <?php $status = 'Completed' ?>
                                                            <?php }elseif ($em_task->status == 0){?>
                                                                <?php $status = 'Not Started' ?>
                                                            <?php }?>
                                                            <option value="<?php echo $em_task->status; ?>"><?php echo $status;?></option>
                                                            <option value="0">Not Started</option>
                                                            <option value="1">In Progress</option>
                                                            <option value="2">On Going</option>
                                                            <option value="3">For Testing</option>
                                                            <option value="4">Completed</option>
                                                        </select>
                                                        <span class="status-spinner" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>

                                                    </td>
                                                    <td>
                                                        <?php $cnt_notify = 0; ?>
                                                        <?php foreach ($notify_data as $notify){ ?>
                                                            <?php if ($notify->task_id == $em_task->id && $notify->type == 1){ ?>
                                                                <?php $cnt_notify = $cnt_notify + 1; ?>
                                                            <?php } ?>
                                                        <?php }?>
                                                        <span class="label label-danger comment-badge" style="<?php if ($cnt_notify == 0){echo "visibility:hidden";}else{echo "visibility:visible";} ?>"><?php echo $cnt_notify;?></span>
                                                        <a href="#" style="color: grey;font-weight: bold" data-toggle="modal" data-target="#taskComment" class="comment-task read-comment" data-id="<?php echo $em_task->id;?>" id="read-comment" ><i class="fa fa-comments fa-lg"></i> View Comments</a>
                                                    </td>
                                                </tr>
                                            <?php }?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <h4>Web Development</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Task</th>
                                            <th>Responsible</th>
                                            <th>Urgency</th>
                                            <th>Status</th>
                                            <th>Latest Comment</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($task as $cnt => $em_task): ?>
                                            <?php
                                            if ($em_task->category == 2){
                                                if ($em_task->employee_id == 0){
                                                    $employee_name = '';
                                                }else{
                                                    foreach ($info as $employee):
                                                        if ($em_task->employee_id == $employee->id){
                                                            $employee_name = $employee->firstname.' '.$employee->lastname;
                                                        }
                                                    endforeach;
                                                }

                                                $urgency = '';
                                                if ($em_task->urgency == 1){
                                                    $urgency = 'Very Low';
                                                    $bg = 'default';
                                                }elseif ($em_task->urgency == 2){
                                                    $urgency = 'Low';
                                                    $bg = 'info';
                                                }elseif ($em_task->urgency == 3){
                                                    $urgency = 'Standard';
                                                    $bg = 'primary';
                                                }elseif ($em_task->urgency == 4){
                                                    $urgency = 'High';
                                                    $bg = 'warning';
                                                }elseif ($em_task->urgency == 5){
                                                    $urgency = 'Critical';
                                                    $bg = 'danger';
                                                }
                                                ?>

                                                <tr>
                                                    <td><?php echo $cnt+1?></td>
                                                    <td>
                                                        <h4 style="font-weight: bold">
                                                            <?php echo $em_task->task_name;?>
                                                            <?php if ($em_task->employee_id == $this->session->userdata('employee_id')): ?>
                                                                <span class="label label-danger new-task-badge"><?php echo $this->session->tempdata($em_task->task_name);?></span>
                                                            <?php endif; ?>
                                                        </h4>
                                                        <small><?php echo $em_task->description?></small>
                                                    </td>
                                                    <td><?php echo $employee_name;?></td>
                                                    <td>
                                                        <span class="label label-<?php echo $bg;?>">
                                                             <?php echo $urgency;?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <select name="" data-id="<?php echo $em_task->id;?>" id="" class="form-control selected-status" style="display: inline-block!important;" <?php if ($em_task->employee_id != $this->session->userdata('employee_id')){echo 'disabled';} ?>>
                                                            <?php if ($em_task->status == 1){ ?>
                                                                <?php $status = 'In Progress' ?>
                                                            <?php }elseif ($em_task->status == 2){?>
                                                                <?php $status = 'On Going' ?>
                                                            <?php }elseif ($em_task->status == 3){?>
                                                                <?php $status = 'For Testing' ?>
                                                            <?php }elseif ($em_task->status == 4){?>
                                                                <?php $status = 'Completed' ?>
                                                            <?php }elseif ($em_task->status == 0){?>
                                                                <?php $status = 'Not Started' ?>
                                                            <?php }?>
                                                            <option value="<?php echo $em_task->status; ?>"><?php echo $status;?></option>
                                                            <option value="0">Not Started</option>
                                                            <option value="1">In Progress</option>
                                                            <option value="2">On Going</option>
                                                            <option value="3">For Testing</option>
                                                            <option value="4">Completed</option>
                                                        </select>
                                                        <span class="status-spinner" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>

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
                                            <?php }?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="messages">
                                <h4>Graphic Design</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Task</th>
                                            <th>Responsible</th>
                                            <th>Urgency</th>
                                            <th>Status</th>
                                            <th>Latest Comment</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($task as $cnt => $em_task): ?>
                                            <?php
                                            if ($em_task->category == 3){
                                                if ($em_task->employee_id == 0){
                                                    $employee_name = '';
                                                }else{
                                                    foreach ($info as $employee):
                                                        if ($em_task->employee_id == $employee->id){
                                                            $employee_name = $employee->firstname.' '.$employee->lastname;
                                                        }
                                                    endforeach;
                                                }
                                                $urgency = '';
                                                if ($em_task->urgency == 1){
                                                    $urgency = 'Very Low';
                                                    $bg = 'default';
                                                }elseif ($em_task->urgency == 2){
                                                    $urgency = 'Low';
                                                    $bg = 'info';
                                                }elseif ($em_task->urgency == 3){
                                                    $urgency = 'Standard';
                                                    $bg = 'primary';
                                                }elseif ($em_task->urgency == 4){
                                                    $urgency = 'High';
                                                    $bg = 'warning';
                                                }elseif ($em_task->urgency == 5){
                                                    $urgency = 'Critical';
                                                    $bg = 'danger';
                                                }
                                                ?>

                                                <tr>
                                                    <td><?php echo $cnt+1?></td>
                                                    <td>
                                                        <h4 style="font-weight: bold">
                                                            <?php echo $em_task->task_name;?>
                                                            <?php if ($em_task->employee_id == $this->session->userdata('employee_id')): ?>
                                                                <span class="label label-danger new-task-badge"><?php echo $this->session->tempdata($em_task->task_name);?></span>
                                                            <?php endif; ?>
                                                        </h4>
                                                        <small><?php echo $em_task->description?></small>
                                                    </td>
                                                    <td><?php echo $employee_name;?></td>
                                                    <td>
                                                        <span class="label label-<?php echo $bg;?>">
                                                             <?php echo $urgency;?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="" id="task_id" value="<?php echo $em_task->id;?>">
                                                        <select name="" data-id="<?php echo $em_task->id;?>" id="" class="form-control selected-status" style="display: inline-block!important;" <?php if ($em_task->employee_id != $this->session->userdata('employee_id')){echo 'disabled';} ?>>
                                                            <?php if ($em_task->status == 1){ ?>
                                                                <?php $status = 'In Progress' ?>
                                                            <?php }elseif ($em_task->status == 2){?>
                                                                <?php $status = 'On Going' ?>
                                                            <?php }elseif ($em_task->status == 3){?>
                                                                <?php $status = 'For Testing' ?>
                                                            <?php }elseif ($em_task->status == 4){?>
                                                                <?php $status = 'Completed' ?>
                                                            <?php }elseif ($em_task->status == 0){?>
                                                                <?php $status = 'Not Started' ?>
                                                            <?php }?>
                                                            <option value="<?php echo $em_task->status; ?>"><?php echo $status;?></option>
                                                            <option value="0">Not Started</option>
                                                            <option value="1">In Progress</option>
                                                            <option value="2">On Going</option>
                                                            <option value="3">For Testing</option>
                                                            <option value="4">Completed</option>
                                                        </select>
                                                        <span class="status-spinner" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>

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
                                            <?php }?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="settings">
                                <h4>Research</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Task</th>
                                            <th>Responsible</th>
                                            <th>Urgency</th>
                                            <th>Status</th>
                                            <th>Option</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($task as $cnt => $em_task): ?>
                                            <?php
                                            if ($em_task->category == 4){
                                                if ($em_task->employee_id == 0){
                                                    $employee_name = '';
                                                }else{
                                                    foreach ($info as $employee):
                                                        if ($em_task->employee_id == $employee->id){
                                                            $employee_name = $employee->firstname.' '.$employee->lastname;
                                                        }
                                                    endforeach;
                                                }
                                                $urgency = '';
                                                if ($em_task->urgency == 1){
                                                    $urgency = 'Very Low';
                                                    $bg = 'default';
                                                }elseif ($em_task->urgency == 2){
                                                    $urgency = 'Low';
                                                    $bg = 'info';
                                                }elseif ($em_task->urgency == 3){
                                                    $urgency = 'Standard';
                                                    $bg = 'primary';
                                                }elseif ($em_task->urgency == 4){
                                                    $urgency = 'High';
                                                    $bg = 'warning';
                                                }elseif ($em_task->urgency == 5){
                                                    $urgency = 'Critical';
                                                    $bg = 'danger';
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo $cnt+1?></td>
                                                    <td>
                                                        <h4 style="font-weight: bold">
                                                            <?php echo $em_task->task_name;?>
                                                            <?php if ($em_task->employee_id == $this->session->userdata('employee_id')): ?>
                                                                <span class="label label-danger new-task-badge"><?php echo $this->session->tempdata($em_task->task_name);?></span>
                                                            <?php endif; ?>
                                                        </h4>
                                                        <small><?php echo $em_task->description?></small>
                                                    </td>
                                                    <td><?php echo $employee_name;?></td>
                                                    <td>
                                                        <span class="label label-<?php echo $bg;?>">
                                                             <?php echo $urgency;?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <select name="" data-id="<?php echo $em_task->id;?>" id="" class="form-control selected-status" style="display: inline-block!important;" <?php if ($em_task->employee_id != $this->session->userdata('employee_id')){echo 'disabled';} ?>>
                                                            <?php if ($em_task->status == 1){ ?>
                                                                <?php $status = 'In Progress' ?>
                                                            <?php }elseif ($em_task->status == 2){?>
                                                                <?php $status = 'On Going' ?>
                                                            <?php }elseif ($em_task->status == 3){?>
                                                                <?php $status = 'For Testing' ?>
                                                            <?php }elseif ($em_task->status == 4){?>
                                                                <?php $status = 'Completed' ?>
                                                            <?php }elseif ($em_task->status == 0){?>
                                                                <?php $status = 'Not Started' ?>
                                                            <?php }?>
                                                            <option value="<?php echo $em_task->status; ?>"><?php echo $status;?></option>
                                                            <option value="0">Not Started</option>
                                                            <option value="1">In Progress</option>
                                                            <option value="2">On Going</option>
                                                            <option value="3">For Testing</option>
                                                            <option value="4">Completed</option>
                                                        </select>
                                                        <span class="status-spinner" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>

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
                                            <?php }?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <footer style="bottom: 0;position: fixed"><p>All right reserved. <strong>3w Corner</strong></p></footer>
    </div>
    <!-- /. PAGE INNER  -->
</div>
<?php $this->load->view($task_comment);?>
