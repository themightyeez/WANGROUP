@extends('user.layouts.layout')
@section('title','Inventory')

@section('content')
<div class="bg-white min-vh-100">
    <div class="px-3 py-3 row">
        <div class="col-md-12 col-sm-12">
            <h4>
                Inventory Items
            </h4>
            <hr>
            <small class="text-muted mb-5">Below are the list of available item in warehouse</small>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="mt-4 table-responsive-sm">
                <table class="table table-hover" id="inventoryTable">
                    
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
    <form action="{{ action('ProductController@editProduct') }}" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="" id="productId">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Qty</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="editProductQty" name="qty">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Photo</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control" name="photo">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Notes</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="note" id="editProductNote"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('additionalCss')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endsection

@section('additionalScript')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function(){
            var dataSet = [
                @foreach ($products as $product)
                [
                    "{{ $product->id }}",
                    "<div class=\"row\"><div class=\"col-12\"><img src=\"{{ $product->getPhoto() }}\" style=\"max-width: 50%\"></div><div class=\"col-12\">{{ $product->name }}</div></div>",
                    "{{ $product->category->name }}",
                    "{{ $product->qty }}",
                    @if(strlen($product->note) > 50)
                    "<div class=\"col-md-12\">\
                    <p id=\"notes-{{$product->id}}\" class=\"text-break\"> {{ Str::limit($product->note, 50) }}\
                        <a class=\"btn-edit-custom\" onclick=\"readMore({{$product->id}})\">Read More</a>\
                    </p>\
                    <p id=\"notes-full-{{$product->id}}\" class=\"d-none text-break\"> {{ $product->note }}\
                        <a class=\"btn-edit-custom\" onclick=\"readLess({{$product->id}})\">...Read Less</a>\
                    </p>\
                    </div>",
                    @else
                    "<div class=\"col-md-12\"><p id=\"notes\"> {{ $product->note }} </p></div>",
                    @endif
                ],
                @endforeach
            ];

            var table = $('#inventoryTable').DataTable({
                "data" : dataSet,
                "aaSorting": [[ 0, "asc" ]],
                "oLanguage": { "sSearch": "Search: " },
                "aoColumnDefs": [
                { "sTitle": "", "aTargets": [0], "bVisible": false, "bSearchable": false}, 
                { "sTitle" : "Name", "sClass" : "text-center", "bSortable" : false, "sWidth" : "40%", "aTargets": [1] },
                { "sTitle" : "Category", "sClass" : "text-center", "bSortable" : false, "sWidth" : "20%", "aTargets": [2] },
                { "sTitle" : "Qty", "sClass" : "text-center", "bSortable" : false, "sWidth" : "5%", "aTargets": [3] },
                { "sTitle" : "Notes", "sClass" : "text-center", "bSortable" : false, "sWidth" : "35%", "aTargets": [4] },
                ],
                "iDisplayLength": 25,
                "sPaginationType": "full_numbers",
                "bStateSave": true
            });
            table.column( 0 ).visible( false );
 
    });
    function readMore(id){
        $('#notes-full-'+id).removeClass('d-none');
        $('#notes-full-'+id).show();
        $('#notes-'+id).hide();
    }
    

    function readLess(id){
        $('#notes-full-'+id).addClass('d-none');
        $('#notes-full-'+id).hide();
        $('#notes-'+id).show();
    }


    $('#editProduct').on('show.bs.modal', function(event){
        var qry = $(event.relatedTarget);
        var id = qry.data('id');
        var qty = qry.data('qty');
        var note = qry.data('notes');

        $('#productId').val(id);
        $('#editProductQty').val(qty);
        $('#editProductNote').val(note);
    });
</script>
@endsection