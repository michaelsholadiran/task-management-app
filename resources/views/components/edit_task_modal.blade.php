   <div class="modal fade" id="editTask" tabindex="-1" role="dialog" aria-labelledby="formModal"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">Update Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" class="ajaxForm2 form-validate2" method="post">
                 @csrf
                
                  <div class="form-group">
                    <label>Name</label>
                    <div class="form-group">
                        <input type="text" class="form-control"  name="name" id="name">
                    </div>
                  </div>
                  <div  class="form-group">
                    <select class="form-control" name="project" id="project">
                    <option value="">Select Project</option>
                    <option value="0">HTML</option>
                    <option value="1">PHP</option>
                    <option value="2">LARAVEL</option>
                </select>
                  </div>
                 
                
                  <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                </form>
              </div>
            </div>
          </div>
        </div>