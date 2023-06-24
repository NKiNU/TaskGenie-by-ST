<div class="modal fade" id="status_modal<?php echo $list['taskid']?>" tabindex="-1" role="dialog" aria-labelledby="status_modal_label<?php echo $list['taskid']?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="status_modal_label<?php echo $list['taskid']?>">Status Modal</h5>
            </div>
            <div class="modal-body">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Status</label>
                  <form method="POST" action="updateStatus_query.php">
                    <input type="hidden" name="task_id" value="<?php echo $list['taskid']?>"/>
                    <input type="text" name="status" value="<?php echo $list['status']?>" class="form-control" required="required"/>
                    <br></br>
                    <label> Change Status to:</label>
                    <select class="form-select" name="names">
                        <option value="to-do">To Do</option>
                        <option value="in-progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
            </div>
            <div style="clear:both;"></div>
            <div class="modal-footer">
              <button name="updateStatus" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Update</button>
                            </form>
              <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
            </div>
            </div>
        </div>
    </div>
</div>