@extends('user.layouts.layout')
@section('title','Log Order')

@section('content')
<div class="bg-white min-vh-100">
    <div class="px-3 py-3">
        <h4>
            Log Order
        </h4>
        <hr>
        <div class="row">
            <small class="text-muted col-md-6">Below are the list of inbound/outbound transaction that you made</small>
            <div class="mt-4 table-responsive-sm col-md-12">
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
                            <span class=\"badge badge-info badge-pill\"> {{ $k->pivot->qty  }} </span>\
                    </div>\
                    @endforeach\
                    </div>",
                    "{{ date('d F Y', strtotime($transaction->created_at)) }}",
                    "@switch($transaction->status)
                        @case(1)<span class=\"badge badge-secondary\"> On Process </span> @break\
                        @case(2)<span class=\"badge badge-success\"> Success </span> @break\
                        @case(3)<span class=\"badge badge-danger\"> Rejected </span> @break\
                        @default\
                    @endswitch",
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
                { "sTitle" : "Status", "sClass" : "text-center", "bSortable" : false, "sWidth" : "10%", "aTargets": [5] },
                ],
                "iDisplayLength": 25,
                "sPaginationType": "full_numbers",
                "bStateSave": true
            });
            table.column( 0 ).visible( false );
 
    });
</script>
@endsection