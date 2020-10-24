<div id="taskComment" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-thumbtack"></i>&nbsp;Task Comments</h4>
            </div>
            <div class="modal-body" style="max-height: 500px;overflow-y: scroll">
                <div class="task-comment-container" style="margin-bottom: 20px"></div>
                <form action="" method="post" id="comment-task-form">
                    <div class="form-group">
                        <input type="hidden" name="id" id="comment-taskID">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $this->session->userdata('employee_id');?>">
                        <textarea name="comments" id="comments" cols="0" rows="5" class="form-control" placeholder="Write something..." style="resize: none" required></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info">Comment</button>
                </form>
            </div>
        </div>

    </div>
</div>
