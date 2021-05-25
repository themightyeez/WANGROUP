<div class="container-fluid">

    <!-- Modal -->
    <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="col-form-label">Category</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="category">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <form>
        <div class="row">
            <form action="">
                <div class="col-md-9">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Item Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="itemName" name="itemName">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Category</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="category" name="category">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Qty</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="qty" name="qty">
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary col-6 offset-3">Submit</button>
                    <a class="btn btn-light col-6 offset-3" id="btnResetOpname">Reset</a>
                    <a class="btn btn-info col-6 offset-3" data-toggle="modal" data-target="#addCategory">Add Category</a>
                </div>
            </form>
        </div>
    </form>
</div>