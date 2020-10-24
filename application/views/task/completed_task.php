<?php
if (md5($project[0]->id) != $this->uri->segment(3)){
    redirect('dashboard/createProject');
}
?>
<div id="page-wrapper">
    <div class="header">
        <h2 class="page-header"><?php echo $cnt_completed;?> tasks totally completed so far and counting...</h2>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header" style="margin-left: 20px;">
                    <a class="navbar-brand" href="<?php echo site_url();?>dashboard/createProject">Project Management</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo site_url();?>dashboard/overview/<?php echo md5($project[0]->id);?>">Overview</a></li>
                    <li><a href="<?php echo site_url();?>dashboard/projectActivity/<?php echo md5($project[0]->id);?>">Activity</a></li>
                    <li class="active"><a href="<?php echo site_url();?>dashboard/completedTask/<?php echo md5($project[0]->id);?>">Completed</a></li>
                </ul>
            </div>
        </nav>
        <ol class="breadcrumb">
            <li><a href="#">Project</a></li>
            <li><a href="#">Project Management</a></li>
            <li class="active">Completed</li>
        </ol>
    </div>
    <div id="page-inner">
        <!-- /. ROW  -->
        <div class="row">
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
                            <th>Completed</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($task as $cnt => $em_task): ?>
                            <?php if ($em_task->status == 4){ ?>
                                <?php if ($em_task->urgency == 1){ ?>
                                    <?php $urgency = 'Very Low'; ?>
                                    <?php $bg = 'default' ?>
                                <?php }elseif ($em_task->urgency == 2){?>
                                    <?php $urgency = 'Low'; ?>
                                    <?php $bg = 'info' ?>
                                <?php }elseif ($em_task->urgency == 3){?>
                                    <?php $urgency = 'Strandard'; ?>
                                    <?php $bg = 'primary' ?>
                                <?php }elseif ($em_task->urgency == 4){?>
                                    <?php $urgency = 'High'; ?>
                                    <?php $bg = 'warning' ?>
                                <?php }elseif ($em_task->urgency == 5){?>
                                    <?php $urgency = 'Critical'; ?>
                                    <?php $bg = 'danger' ?>
                                <?php }?>
                            <tr>
                                <td><?php echo $cnt+1;?></td>
                                <td><?php echo $em_task->task_name;?></td>
                                <td><small  class="label label-<?php echo $bg;?>"><?php echo $urgency;?></small></td>
                                <td>Completed</td>
                                <?php
                                foreach ($employee_info as $employee){
                                    if ($employee->id == $em_task->employee_id){
                                        $firstname = $employee->firstname;
                                        $lastname = $employee->lastname;
                                    }
                                }
                                ?>
                                <td><?php echo $firstname;?> <?php echo $lastname;?></td>
                                <td><?php echo date('D M d, Y H:i A',$em_task->completed);?></td>
                            </tr>
                            <?php }?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <footer style="bottom: 0;position: fixed"><p>All right reserved. <strong>3w Corner</strong></p></footer>
    </div>
    <!-- /. PAGE INNER  -->
</div>