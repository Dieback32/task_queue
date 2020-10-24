<!--Create user profile alert-->
<?php if ($this->session->flashdata('user_created')){ ?>
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> <?php echo $this->session->flashdata('user_created');?>
    </div>
<?php }elseif ($this->session->flashdata('user_failed')){?>
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Sorry!</strong> <?php echo $this->session->flashdata('user_failed');?>
    </div>
<?php }elseif ($this->session->flashdata('upload_error')){?>
    <div class="alert alert-warning alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Sorry!</strong> <?php echo $this->session->flashdata('upload_error');?>
    </div>
<?php }?>
<!--Task Alert-->
<?php if ($this->session->flashdata('category_created')){ ?>
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> <?php echo $this->session->flashdata('category_created');?>
    </div>
<?php }elseif ($this->session->flashdata('category_failed')){ ?>
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Sorry!</strong> <?php echo $this->session->flashdata('category_failed');?>
    </div>
<?php }elseif ($this->session->flashdata('task_created')){ ?>
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> <?php echo $this->session->flashdata('task_created');?>
    </div>
<?php }elseif ($this->session->flashdata('task_failed')){ ?>
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Sorry!</strong> <?php echo $this->session->flashdata('task_failed');?>
    </div>
<?php }?>
<!--User update-->
<?php if ($this->session->flashdata('profile_updated')){ ?>
<div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> <?php echo $this->session->flashdata('profile_updated');?>
</div>
<?php }elseif ($this->session->flashdata('profile_failed')){ ?>
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Sorry!</strong> <?php echo $this->session->flashdata('profile_failed');?>
    </div>
<?php }?>