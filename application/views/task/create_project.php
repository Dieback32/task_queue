<div id="page-wrapper">
    <div class="header">
        <h2 class="page-header">Project</h2>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header" style="margin-left: 20px;">
                    <a class="navbar-brand" href="<?php echo site_url();?>dashboard/createProject" >Project Management</a>
                </div>
                <ul class="nav navbar-nav mr-auto">
                    <li class="active"><a href="<?php echo site_url();?>dashboard/createProject">Create Project</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right" style="margin-right: 20px">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="font-weight: bold">Projects
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php foreach ($projects as $pro):?>
                            <li><a href="<?php echo site_url();?>dashboard/overview/<?php echo md5($pro->id);?>"><?php echo $pro->project_name;?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <ol class="breadcrumb">
            <li><a href="#">Project</a></li>
            <li><a href="#">Project Management</a></li>
            <li class="active">Create Project</li>
        </ol>
    </div>
    <?php if ($this->session->flashdata('project_succ')){ ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> <?php echo $this->session->flashdata('project_succ');?>
        </div>
    <?php }elseif ($this->session->flashdata('project_failed')){ ?>
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Sorry!</strong> <?php echo $this->session->flashdata('project_failed');?>
    </div>
    <?php }?>
    <div id="page-inner">
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-xs-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="<?php echo base_url();?>assets/image/teamwork-projects-logo.png" alt="Project" class="img-responsive" style="width: 100%;height: 100px;">
                        <div>
                            <h3 style="margin-bottom: 7px;text-align: center">Project Information</h3>
                            <p style="text-align: center;font-size: 85%">Please enter a project name (keep it short) and description of your project. This can be later changed in your settings for the project</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="card-title">
                            <div class="title">Create Project</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo site_url()?>dashboard/creatingProject" method="post">
                            <div class="form-group">
                                <label for="projectName">Project Name</label>
                                <input type="text" name="project" class="form-control" id="projectName" placeholder="Enter a name of your project. Try to keep it short." required>
                            </div>
                            <div class="form-group">
                                <label for="desc">Description</label>
                                <textarea name="description" id="desc" cols="0" rows="5" style="resize: none;" class="form-control" placeholder="Describe what you need to do and accomplish."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="link">UCM Link</label>
                                <input type="text" name="ucm_link" id="link" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer style="bottom: 0;position: fixed"><p>All right reserved. <strong>3w Corner</strong></p></footer>
    </div>
    <!-- /. PAGE INNER  -->
</div>