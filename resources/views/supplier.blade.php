@extends('layouts.layout')
@section('title','Supplier')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="border border-white rounded-bottom-custom bg-white mb-2 pb-2">
            <h4 class="mx-4 mt-3">
                Supplier
            </h4>
            <hr>
            <small class="text-muted mx-4">You can contact the supplier below by click the given button</small>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="border border-white rounded-top-custom bg-white mt-2 pb-4 px-3">
            <h5 class="col-md-11 my-3">Contact Detail</h5>

            <div class="col-md-1 pt-2">
                <button class="btn btn-light rounded-pill" data-toggle="modal" data-target="#addSupplier">     
                    Add
                </button>
            </div>
            <div class="col-12 mt-4 table-responsive-sm">
                <table id="suppliertable" class="table table-hover" style="width: auto">
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addSupplier" tabindex="-1" aria-labelledby="addSupplierLabel" aria-hidden="true">
    <form action="{{ action('SupplierController@store') }}" method="POST">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="col-form-label">Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="col-form-label">Phone Number</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="phone_number">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="col-form-label">Address</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="address">
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

<div class="modal fade" id="editSupplier" tabindex="-1" aria-labelledby="editSupplierLabel" aria-hidden="true">
    <form action="{{ action('SupplierController@edit') }}" method="POST">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="" id="supplierId">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="col-form-label">Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="name" id="editSupplierName">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="col-form-label">Phone Number</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="phone_number" id="editSupplierPhoneNumber">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="col-form-label">Address</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="address" id="editSupplierAddress">
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
            @foreach ($suppliers as $supplier)
                @php 
                    $wa = str_replace(' ','',$supplier->phone_number);
                @endphp
            [
                "{{ $supplier->id }}",
                "<a class=\"btn-edit-custom\" data-toggle=\"modal\" data-target=\"#editSupplier\" data-id=\"{{$supplier->id}}\" data-name=\"{{$supplier->name}}\" data-phonenumber=\"{{$supplier->phone_number}}\" data-address=\"{{$supplier->address}}\"> <span data-toggle=\"tooltip\" title=\"Edit\" data-placement=\"right\"> {{ $supplier->name}} </span>  </a>",
                "{{ $supplier->phone_number }}",
                "{{ $supplier->address }}",
                "<a href=\"https:\/\/wa.me\/{{$wa}}\" class=\"btn btn-success rounded-pill mb-1\"><i class=\"fab fa-lg fa-whatsapp\"></i></a>\
                <a href=\"{{ action('SupplierController@remove',$supplier->id) }}\" class=\"btn btn-outline-danger rounded-pill mb-1\"><i class=\"fas fa-trash-alt\"></i></a>",
            ],
            @endforeach
        ];

        var table = $('#suppliertable').DataTable({
            "data" : dataSet,
            "aaSorting": [[ 0, "asc" ]],
            "oLanguage": { "sSearch": "Search: " },
            "aoColumnDefs": [
            { "sTitle": "", "aTargets": [0], "bVisible": false, "bSearchable": false}, 
            { "sTitle" : "Name", "sClass" : "text-center", "bSortable" : false, "sWidth" : "30%", "aTargets": [1] },
            { "sTitle" : "Phone Number", "bSortable" : false, "sWidth" : "20%", "aTargets": [2] },
            { "sTitle" : "Address", "bSortable" : false, "sWidth" : "40%", "aTargets": [3] },
            { "sTitle" : "Action", "bSortable" : false, "sWidth" : "10%", "aTargets": [4] },
            ],
            "iDisplayLength": 25,
            "sPaginationType": "full_numbers",
            "bStateSave": true
        });
        table.column( 0 ).visible( false );


        $('#editSupplier').on('show.bs.modal', function (event) {
            var qry = $(event.relatedTarget);
            $('#supplierId').val(qry.data('id'));
            $('#editSupplierName').val(qry.data('name'));
            $('#editSupplierPhoneNumber').val(qry.data('phonenumber'));
            $('#editSupplierAddress').val(qry.data('address'));
        
        });
    });
</script>

@endsection