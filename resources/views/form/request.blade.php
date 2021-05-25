<div class="container-fluid">
    <form>
        <div class="row">
            <div class="col-md-9">
                <div class="form-group row">
                    <label for="requestor" class="col-md-4 col-form-label">Requested By</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="requestor">
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-form-label col-md-5">Items</label>
                    <label class="col-form-label col-md-2">Qty</label>
                    <label class="col-form-label col-md-5">Notes</label>
                </div>
                <div id="requestedItems">
                    <div class="form-group row" id="items0">
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="item[0][item]">
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="item[0][qty]">
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="item[0][note]">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2 offset-md-10 pl-5">
                        <a class="btn btn-outline-info rounded-pill" id="btnAddRequest">
                            <i class="fas fa-plus"></i>
                        </a>
                        <a class="btn btn-outline-danger rounded-pill" id="btnDelRequest">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-2 offset-1">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-light" id="btnResetRequest">Reset</a>
            </div>
        </div>
    </form>
</div>