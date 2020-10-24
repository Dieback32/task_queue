<div id="page-wrapper">
    <div class="header">
        <h1 class="page-header">
            User Management
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">User Management</a></li>
            <li class="active">Create User</li>
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
                            <li class="active"><a href="#user-profile" data-toggle="tab">User Profile</a>
                            </li>
                            <li class=""><a href="#accnt-settings" data-toggle="tab">Account Settings</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="user-profile">
                                <div class="row">
                                    <div class="col-md-4">
                                        <form action="<?php echo site_url();?>dashboard/create_new_user" method="post" enctype="multipart/form-data" runat="server">
                                        <img src="<?php echo base_url();?>assets/image/avatar.jpg" alt="User Photo" class="img-responsive img-user-profile" id="img-prv">
                                        <div class="upload-btn-wrapper">
                                            <button class="btn btn-primary">Upload a photo</button>
                                            <input type="file"  name="userfile" size="20" id="imgInp"/>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <table class="tbl-profile-info">
                                            <tr>
                                                <td>Firstname: </td>
                                                <td><input type="text" name="user[firstname]" class="form-control" required></td>
                                            </tr>
                                            <tr>
                                                <td>Lastname: </td>
                                                <td><input type="text" name="user[lastname]" class="form-control" required></td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="accnt-settings">
                                <table class="tbl-profile-info">
                                    <tr>
                                        <td>Username: </td>
                                        <td><input type="text" name="user[username]" class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <td>Password: </td>
                                        <td><input type="password" name="user[password]" id="create-pass" class="form-control" minlength="6" required></td>
                                    </tr>
                                    <tr>
                                        <td>Confirm Password: </td>
                                        <td>
                                            <input type="password" id="create-cpass" class="form-control" minlength="6" required>
                                            <span class="password-error-div" style="display: none;color: red;font-size: 12"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><button type="reset" class="btn btn-default">Clear</button>&nbsp;<button type="submit" class="btn btn-success">Save</button></td>
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
