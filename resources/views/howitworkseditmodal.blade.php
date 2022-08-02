<div class="modal fade editcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{}}" method="post" id="update-form">
                    @csrf
                    <input type="hidden" name="cid">
                    <div class="form-group">
                        <label for="">Code</label>
                        <input type="text" class="form-control" name="code" placeholder="Enter New code">
                        <span class="text-danger error-text size_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="updatecode" class="btn btn-block btn-success">Update code</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
