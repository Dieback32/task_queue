<div id="createTask" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-thumbtack"></i>&nbsp;Create new task</h4>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#general">General</a></li>
                    <li><a data-toggle="tab" href="#more">More options</a></li>
                </ul>
                <form action="<?php echo site_url();?>dashboard/createTask" method="post">
                    <div class="tab-content">
                        <div id="general" class="tab-pane fade in active">
                            <input type="hidden" name="task[project_id]" value="<?php echo $project[0]->id;?>">
                            <div class="form-group">
                                <label for="task">Task</label>
                                <input type="text" name="task[task_name]" class="form-control" id="task" placeholder="What do you need to do?">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="task[task_desc]" id="" cols="0" rows="5" style="resize: none" class="form-control" placeholder="Describe what you need tot do?"></textarea>
                            </div>
                        </div>
                        <div id="more" class="tab-pane fade">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label for="urgency">Urgency</label>
                                        <select name="task[urgency]" id="urgency" class="form-control">
                                            <option value="1">Very Low</option>
                                            <option value="2">Low</option>
                                            <option value="3">Standard</option>
                                            <option value="4">High</option>
                                            <option value="5">Critical</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <label for="responsible">Responsible</label>
                                        <select name="task[responsible]" id="responsible" class="form-control">
                                            <?php foreach ($employee_info as $employee): ?>
                                                <option value="<?php echo $employee->id?>"><?php echo $employee->firstname;?> <?php echo $employee->lastname;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="task[category]" id="category" class="form-control">
                                    <option value="1">Programming</option>
                                    <option value="2">Web Development</option>
                                    <option value="3">Graphic Design</option>
                                    <option value="4">Research</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <h5 style="font-weight: bold">Set deadline?</h5>
                                <label class="switch">
                                    <input type="checkbox" class="deadline-checkbox" >
                                    <span class="slider round"></span>
                                </label>
                                <div class="task-deadline" style="display: none">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label for="">Deadline</label>
                                            <div class="form-group">
                                                <div class='input-group date' id='picker-deadline'>
                                                    <input type='text' name="task[deadline]" class="form-control" />
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Create</button>
            </div>
            </form>
        </div>

    </div>
</div>