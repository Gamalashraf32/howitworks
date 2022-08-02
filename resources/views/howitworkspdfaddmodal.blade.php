<div class="modal fade addfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add file</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{}}" method="post" id="add-pdf">
                    @csrf
                    <input type="hidden" name="pid">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter New Title">
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">File</label>
                        <input type="file" class="form-control" name="file" placeholder="Enter PDF">
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="savefile" class="btn btn-block btn-success">Save File</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
