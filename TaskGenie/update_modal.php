    <div class="modal fade" id="update_modal<?php echo $list['taskid']?>" tabindex="-1" role="dialog" aria-labelledby="update_modal_label<?php echo $list['taskid']?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Update User</h3>
            </div>
            <div class="modal-body">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <div class="form-group">
                <form method="POST" action="update_Query.php">
                  <label>Task Description</label>
                  <input type="hidden" name="task_id" value="<?php echo $list['taskid']?>"/>
                  <input type="text" name="taskDesc" value="<?php echo $list['taskname']?>" class="form-control" required="required"/>
                </div>
                <div class="form-group">
                  <label>Deadline</label>
                  <input type="date" name="deadline" value="<?php $list['dateline']?>" class="form-control" required="required" />
                </div>
              </div>
            </div>
            <div style="clear:both;"></div>
            <div class="modal-footer">
              <button name="updateTask" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Update</button>
              </form>
              <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
            </div>
            </div>
            
        </div>
    </div>