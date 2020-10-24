<!-- Edit user modals -->
<div id="editUser" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit user profile</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="edit-user-profile">
                    <input type="hidden" name="id" class="user-id-edit" required>
                    <div class="form-group">
                        <label for="">Firstname:</label>
                        <input type="text" name="user[firstname]" id="user-firstname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Lastname:</label>
                        <input type="text" name="user[lastname]" id="user-lastname" class="form-control" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info" >Update</button>
                </form>
            </div>
        </div>

    </div>
</div>
