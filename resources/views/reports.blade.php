@extends('layouts.layout')
@section('title','Reports')

@section('content')
<div class="bg-white min-vh-100">
    <div class="px-3 py-3">
        <h4>
            Report List
        </h4>
        <hr>
        <div class="row">
            <small class="text-muted col-md-6">Below are the list of inbound/outbound transaction that was happen</small>
            <small class="text-muted col-md-6">
                <button class="btn btn-search rounded-pill float-right" data-toggle="modal" data-target="#searchTransaction">     
                    <span data-toggle="tooltip" title="Custom Search" data-placement="left">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                </button>
            </small>
            <div class="mt-4 table-responsive-sm col-md-12">
                <table class="table table-hover" id="reportTable">

                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="searchTransaction" tabindex="-1" aria-labelledby="searchTransactionLabel" aria-hidden="true">
    <form action="{{ action('TransactionController@searchReport') }}" method="GET">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <input type="hidden" id="startQuery" name="start" val="">
                        <input type="hidden" id="endQuery"name="end" val=""> 
                        <div class="col-md-12">
                            <div id="searchDataRange" class="text-center">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span>
                                <i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('additionalCss')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/daterangepicker.css') }}" />
@endsection

@section('additionalScript')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


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
<script>
    $(function() {
        var start = moment().subtract(6, 'hours');
        var end = moment();

        function cb(start, end) {
        $('#searchDataRange span').html(start.format('MMMM D, YYYY hh:mm:00') + ' - ' + end.format('MMMM D, YYYY hh:mm:00'));
        }

        $('#searchDataRange').daterangepicker({
        opens: "center",
        startDate: start,
        endDate: end,
        ranges: {
            'Last 1 hour': [moment().subtract(1, 'hours'), moment()],
            'Last 6 hour': [moment().subtract(6, 'hours'), moment()],
            'Last 12 hour': [moment().subtract(12, 'hours'), moment()],
            'Last 24 hour': [moment().subtract(24, 'hours'), moment()],
            'Last 2 Days': [moment().subtract(2, 'days'), moment()],
            'Last 6 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        }, cb);

        cb(start, end);

        $('#searchDataRange').on('apply.daterangepicker', function(ev, picker) {
            var startTime = Date.parse(picker.startDate.format('YYYY/MM/DD hh:mm'));
            var endTime = Date.parse(picker.endDate.format('YYYY/MM/DD hh:mm'));
            $('#startQuery').val(startTime);
            $('#endQuery').val(endTime);
        });

    });
</script>
@endsection