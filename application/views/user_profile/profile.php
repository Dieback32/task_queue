<div id="page-wrapper">
    <div class="header">
        <h1 class="page-header">
            User Management
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">User Management</a></li>
            <li class="active">My Profile</li>
        </ol>
    </div>
    <div id="page-inner">
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <form action="<?php echo site_url();?>dashboard/editProfile" method="post" enctype="multipart/form-data" runat="server">
                                    <input type="hidden" name="user[id]" value="<?php echo $profile[0]->id;?>">
                                    <img src="<?php echo base_url();?>uploads/users_photo/<?php echo $profile[0]->user_photo?>" alt="User Photo" class="img-responsive img-user-profile" id="img-prv">
                                    <div class="upload-btn-wrapper">
                                        <button class="btn btn-primary">Upload a photo</button>
                                        <input type="file"  name="userfile" size="20" id="imgInp"/>
                                    </div>
                            </div>
                            <div class="col-md-8">
                                <table class="tbl-profile-info">
                                    <tr>
                                        <td>Firstname: </td>
                                        <td>
                                            <span id="" class="profile-fname"><?php echo $profile[0]->firstname;?>
                                                <a href="" class="edit-profile-fname"> <i class="fa fa-edit fa-lg"></i></a>
                                            </span>
                                            <input type="hidden" name="user[firstname]" id="user-fname" value="<?php echo $profile[0]->firstname;?>" class="form-control" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lastname: </td>
                                        <td>
                                            <span id="" class="profile-lname"><?php echo $profile[0]->lastname;?>
                                                <a href="" class="edit-profile-lname"><i class="fa fa-edit fa-lg"></i></a>
                                            </span>
                                            <input type="hidden" name="user[lastname]" id="user-lname" value="<?php echo $profile[0]->lastname;?>" class="form-control" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><button type="submit" class="btn btn-info">Save changes</button></td>
                                    </tr>
                                </table>
                                </form>
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
<?php $this->load->view($alerts);?>
