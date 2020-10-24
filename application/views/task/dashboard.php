<?php
    if ($this->uri->segment(2) == 'createProject' || $this->uri->segment(2) == 'overview' || $this->uri->segment(2) == 'projectActivity' || $this->uri->segment(2) == 'completedTask' || $this->uri->segment(2) == 'manageProject' || $this->uri->segment(2) == 'employeeTask'){
        $active_project = 'active-menu';
    }else{
        $active_project = null;
    }
    if($this->uri->segment(2) == null || $this->uri->segment(2) == 'index'){
        $active_dash = 'active-menu';
    }else{
        $active_dash = null;
    }
    if($this->uri->segment(2) == 'create_users' || $this->uri->segment(2) == 'user_list'){
        $active_user_mngmnt = 'active-menu';
    }else{
        $active_user_mngmnt = null;
    }
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php $this->load->view($css);?>
    <title>3w Task Management</title>
</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-default top-navbar" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url();?>dashboard"><strong><img src="<?php echo base_url();?>assets/image/3wlogo.png" alt="logo" width="50" height="40"> 3w Corner</strong></a>

            <div id="sideNav" href="">
                <i class="fa fa-bars icon"></i>
            </div>
        </div>

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fa fa-bell fa-fw"></i><span class="label label-danger"><?php echo $notification;?></span>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <?php
                        if ($this->session->userdata('authorization') != 0){
                            $comment_redirect = 'dashboard/employeeTask';
                        }else{
                            if ($notify_data == null){
                                $url = '';
                            }else{
                                $url = md5($notify_data[0]->project_id);

                            }
                            $comment_redirect = 'dashboard/overview/'.$url;
                        }
                        if ($notify_data == null){
                            $project = null;
                        }else{
                            $project = $notify_data[0]->project_id;

                        }
                    ?>
                    <input type="hidden" id="comment-url" value="<?php echo $comment_redirect;?>">
                    <li class="comment-notify-wrapper">
                        <a href="#" class="comment-notify" data-id="<?php echo $this->session->userdata('employee_id');?>">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="label label-danger"><?php echo $comment_notify;?></span>
<!--                                <span class="pull-right text-muted small">4 min</span>-->
                            </div>
                        </a>
                    </li>
                    <?php if ($this->session->userdata('authorization') != 0): ?>
                    <li class="divider"></li>
                    <li>
                        <a href="#" class="new-task-notify" data-project="<?php echo $project==null?null:$notify_data[0]->project_id;?>">
                            <div>
                                <i class="fa fa-tasks fa-fw"></i> New Task
                                <span class="label label-danger"><?php echo $new_task;?></span>
<!--                                <span class="pull-right text-muted small">4 min</span>-->
                            </div>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
                <!-- /.dropdown-alerts -->
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <?php if($this->session->userdata('authorization') != 0){ ?>
                    <li>
                        <a href="<?php echo site_url();?>dashboard/profile"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li class="divider"></li>
                    <?php }?>
                    <li>
                        <a href="<?php echo site_url();?>dashboard/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!--/. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
                <li>
                    <a class="<?php echo $active_dash;?>" href="<?php echo site_url();?>dashboard/index"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li>
                    <a class="<?php echo $active_project;?>" href="#"><i class="fa fa-tasks"></i> Project<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php if ($this->session->userdata('authorization') == 0){ ?>
                            <li>
                                <a href="<?php echo site_url();?>dashboard/createProject">Project Management</a>
                            </li>
                        <?php }elseif ($this->session->userdata('authorization') != 0){ ?>
                            <li>
                                <a href="<?php echo site_url();?>dashboard/employeeTask">Employee Task</a>
                            </li>
                        <?php }?>
                    </ul>
                </li>
                <?php if ($this->session->userdata('authorization') == 0){ ?>
                <li>
                    <a class="<?php echo $active_user_mngmnt;?>" href="#"><i class="fa fa-users"></i> User Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo site_url();?>dashboard/create_users">Create User Profile</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url();?>dashboard/user_list">User List</a>
                        </li>
                    </ul>
                </li>
                <?php }?>
            </ul>

        </div>

    </nav>
    <!-- /. NAV SIDE  -->
    <?php $this->load->view($content);?>
    <!-- /. PAGE WRAPPER  -->
</div>

<?php $this->load->view($js);?>
</body>
</html>