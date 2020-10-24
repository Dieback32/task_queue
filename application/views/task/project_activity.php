<?php
    if (md5($project[0]->id) != $this->uri->segment(3)){
        redirect('dashboard/createProject');
    }
?>
<div id="page-wrapper">
    <div class="header">
        <h2 class="page-header">Activity in "<?php echo $project[0]->project_name;?>"</h2>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header" style="margin-left: 20px;">
                    <a class="navbar-brand" href="<?php echo site_url();?>dashboard/createProject">Project Management</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo site_url();?>dashboard/overview/<?php echo md5($project[0]->id);?>">Overview</a></li>
                    <li  class="active"><a href="<?php echo site_url();?>dashboard/projectActivity/<?php echo md5($project[0]->id);?>">Activity</a></li>
                    <li><a href="<?php echo site_url();?>dashboard/completedTask/<?php echo md5($project[0]->id);?>">Completed</a></li>
                </ul>
            </div>
        </nav>
        <ol class="breadcrumb">
            <li><a href="#">Project</a></li>
            <li><a href="#">Project Management</a></li>
            <li class="active">Activity</li>
        </ol>
    </div>
    <div id="page-inner">
        <!-- /. ROW  -->
        <div class="row">
            <ul class="timeline">
                <?php foreach ($task as $cnt => $em_task): ?>
                    <?php
                        foreach ($employee_info as $employee){
                            if ($em_task->employee_id == $employee->id){
                                $employee_id = $employee->id;
                                $firstname = $employee->firstname;
                                $lastname = $employee->lastname;
                                $user_photo = $employee->user_photo;
                            }
                        }
                    ?>
                    <?php if ($em_task->employee_id == $employee_id): ?>
                        <?php if (($cnt + 1) % 2 == 0){ ?>
                            <?php $invert = 'timeline-inverted';?>
                        <?php }else{ ?>
                            <?php $invert = '';?>
                        <?php }?>
                        <?php if ($em_task->status == 0){ ?>
                            <?php $status = 'Not started'; ?>
                            <?php $bg = 'default' ?>
                        <?php }elseif ($em_task->status == 1){?>
                            <?php $status = 'In process'; ?>
                            <?php $bg = 'warning' ?>
                        <?php }elseif ($em_task->status == 2){?>
                            <?php $status = 'On going'; ?>
                            <?php $bg = 'primary' ?>
                        <?php }elseif ($em_task->status == 3){?>
                            <?php $status = 'For testing'; ?>
                            <?php $bg = 'info' ?>
                        <?php }elseif ($em_task->status == 4){?>
                            <?php $status = 'Completed'; ?>
                            <?php $status_msg = 'has completed the task'?>
                            <?php $bg = 'success' ?>
                        <?php }?>
                        <li class="<?php echo $invert;?>">
                            <div class="timeline-badge warning">
                                <img src="<?php echo base_url();?>uploads/users_photo/<?php echo $user_photo;?>" alt="User" style="width: 50px;height: 50px;border-radius: 50%;">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title" style="margin-bottom: 2px"><?php echo $firstname;?> <?php echo $lastname;?> <?php $status_msg; ?></h4>
                                    <p>
                                        <small class="text-muted" style="color: grey">
                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                            <?php echo date('Y-m-d H:i A',$em_task->started);?>
                                        </small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <h4><?php echo $em_task->task_name;?></h4>
                                    <h4>
                                        <span class="label label-<?php echo $bg;?>">
                                            <?php echo $status;?>
                                        </span>
                                    </h4>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <footer style="bottom: 0;position: fixed"><p>All right reserved. <strong>3w Corner</strong></p></footer>
    </div>
    <!-- /. PAGE INNER  -->
</div>