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
                <form action="{{ action('ProductController@addCategory') }}" method="POST">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                <label class="col-form-label">Category</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="category">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="removeCategory" tabindex="-1" aria-labelledby="removeCategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Remove Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ action('ProductController@removeCategory') }}" method="POST">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                <label class="col-form-label">Category</label>
                            </div>
                            <div class="col-md-9">
                                <select class="select2_multiple form-control" id="qryCategory" name="category" style="width: 100%" required="required">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Remove</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form action="{{ action('ProductController@addProduct') }}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <form action="">
                <div class="col-md-9">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Item Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="itemName" name="itemName">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Category</label>
                        <div class="col-md-6">
                            <select class="select2_multiple form-control" id="category" name="category" style="width: 100%" required="required">
                                <option value=""></option>
                                @foreach($opnameCategory as $category)
                                <option value="{{ $category->id }}"> {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Qty</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="qty" name="qty">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Photo</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                    </div>
                </div>
            </form>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary col-6 offset-3">Submit</button>
                    <a class="btn btn-light col-6 offset-3 mb-3" id="btnResetOpname">Reset</a>
                    <a class="btn btn-light col-6 offset-3" data-toggle="modal" data-target="#addCategory">Add Category</a>
                    <a class="btn btn-light col-6 offset-3" data-toggle="modal" data-target="#removeCategory">Remove</a>
                </div>
            
        </div>
    </form>
</div>