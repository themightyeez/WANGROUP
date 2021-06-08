@extends('layouts.layout')
@section('title','Search Result')

@section('content')
<div class="bg-white min-vh-100">
    <div class="px-3 py-3">
        <h4>
            Search Result Report 
        </h4>
        <hr>
        <div>
            <small class="text-muted mb-5">Below are list of searched query inbound/outbound transaction</small>
            <div class="mt-4 table-responsive-sm">
                <table class="table table-hover" id="reportTable">

                </table>
            </div>
        </div>
    </div>
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
                @foreach ($transactions as $transaction)
                [
                    "{{ $transaction->id }}",
                    "{{ $transaction->transaction_id }}",
                    "{{ $transaction->contact }}",
                    "<div class=\"row\">\
                    @foreach($transaction->product as $k)\
                    <div class=\"col-md-10\"> <span data-toggle=\"tooltip\" title=\"{{ $k->pivot->note ?? '' }}\">{{ $k->name }} </span> </div>\
                    <div class=\"col-md-2\">\
                            <span class=\"badge badge-{{ $transaction->transaction_type == 'request' ? 'success' : 'danger' }} badge-pill\"> {{ $k->pivot->qty  }} </span>\
                    </div>\
                    @endforeach\
                    </div>",
                    "{{ date('d F Y', strtotime($transaction->created_at)) }}",
                    "<a class=\"btn btn-export\"><i class=\"fas fa-file-download\"></i></a>"
                ],
                @endforeach
            ];

            var table = $('#reportTable').DataTable({
                "data" : dataSet,
                "aaSorting": [[ 0, "asc" ]],
                "oLanguage": { "sSearch": "Search: " },
                "aoColumnDefs": [
                { "sTitle": "", "aTargets": [0], "bVisible": false, "bSearchable": false}, 
                { "sTitle" : "Transaction ID", "sClass" : "text-center", "bSortable" : false, "sWidth" : "20%", "aTargets": [1] },
                { "sTitle" : "Contact", "sClass" : "text-center", "bSortable" : false, "sWidth" : "20%", "aTargets": [2] },
                { "sTitle" : "Items", "sClass" : "text-center", "bSortable" : false, "sWidth" : "35%", "aTargets": [3] },
                { "sTitle" : "Created at", "sClass" : "text-center", "bSortable" : false, "sWidth" : "15%", "aTargets": [4] },
                { "sTitle" : "Action", "sClass" : "text-center", "bSortable" : false, "sWidth" : "10%", "aTargets": [5] },
                ],
                "iDisplayLength": 25,
                "sPaginationType": "full_numbers",
                "bStateSave": true
            });
            table.column( 0 ).visible( false );
 
    });
</script>
@endsection