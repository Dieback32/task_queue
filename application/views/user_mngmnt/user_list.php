<div id="page-wrapper">
    <div class="header">
        <h1 class="page-header">
            User Management
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">User Management</a></li>
            <li class="active">User List</li>
        </ol>
    </div>
    <div id="page-inner">
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                                <tbody class="tbl-userlist">
                                <?php foreach ($employee_info as $count => $employee){ ?>
                                <tr>
                                    <td><?php echo $count+1;?></td>
                                    <td><img src="<?php echo base_url()?>uploads/users_photo/<?php echo $employee->user_photo?>" alt="Avatar" class="img-responsive user-list-photo"></td>
                                    <td><?php echo $employee->firstname?>&nbsp;<?php echo $employee->lastname;?></td>
                                    <?php foreach ($user_login as $users){ ?>
                                        <?php if ($users->employee_id == $employee->id){ ?>
                                    <td><?php echo $users->username;?></td>
                                        <?php }?>
                                    <?php }?>
                                    <td style="text-align: center">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" type="button" id="menu1" data-toggle="dropdown" style="color: grey;text-decoration: none">
                                                <i class="fa fa-cog fa-lg"></i>
                                                <span class="caret"></span></a>
                                            <ul class="dropdown-menu pull-left" role="menu" aria-labelledby="menu1">
                                                <li role="presentation"><a role="menuitem" href="#" style="font-size: 15px" data-toggle="modal" data-target="#editUser" class="editUserProfile" data-id="<?php echo $employee->id?>"><i class="fa fa-edit"></i>&nbsp;Edit</a></li>
                                                <li role="presentation"><a role="menuitem" href="#" style="font-size: 15px" class="deleteUserProfile" data-id="<?php echo $employee->id?>"><i class="fa fa-ban"></i>&nbsp;Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <footer style="bottom: 0;position: fixed"><p>All right reserved. <strong>3w Corner</strong></p></footer>
    </div>
    <!-- /. PAGE INNER  -->
</div>
<?php $this->load->view($modals);?>


