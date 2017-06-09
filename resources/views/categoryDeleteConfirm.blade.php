<div class="modal fade" id="delete-category" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationLabel" style="z-index: 2500;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteConfirmationLabel">Delete Category</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Category?</p>
            </div>
            <div class="modal-footer">
                {{ Form::open(array( 'url' => '' , 'method' => 'DELETE' , 'class'=>'form-horizontal')) }}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>