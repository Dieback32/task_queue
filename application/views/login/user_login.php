<div class="login-wrapper">
    <div class="login-container">
        <div class="login-header">
            <h4></h4>
        </div>
        <div class="login-content">
            <?php if ($this->session->flashdata('incorrect')): ?>
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry!</strong> <?php echo $this->session->flashdata('incorrect');?>.
                </div>
            <?php endif;?>
            <form action="<?php echo site_url();?>login/userLogin" method="post">
            <div class="form-group">
                <table class="login-tbl">
                    <tr>
                        <td><i class="fa fa-user fa-lg"></i></td>
                        <td><input type="text" name="login[username]" class="form-control" style="margin-left: 20px" placeholder="Username"></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-lock fa-lg"></i></td>
                        <td><input type="password" name="login[password]" class="form-control" style="margin-left: 20px" placeholder="Password"></td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-success" style="margin-top: 10px;margin-left: 37px">Login</button>
            </div>
            </form>
        </div>
    </div>
</div>