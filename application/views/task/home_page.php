
<div id="page-wrapper">
    <div class="header">
        <h1 class="page-header">
            Dashboard
            <small>Welcome
                <?php foreach ($info as $employee): ?>
                    <?php if ($employee->id == $this->session->userdata('employee_id')): ?>
                    <?php echo $employee->firstname;?>
                    <?php endif;?>
                <?php endforeach;?>
                <?php if ($this->session->userdata('authorization') == 0): ?>
                    <?php echo 'Admin'?>
                <?php endif;?>
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Data</li>
        </ol>

    </div>
    <div id="page-inner">
        <!-- /. ROW  -->
        <div class="row">


        </div>
        <footer style="bottom: 0;position: fixed"><p>All right reserved. <strong>3w Corner</strong></p></footer>
    </div>
    <!-- /. PAGE INNER  -->
</div>