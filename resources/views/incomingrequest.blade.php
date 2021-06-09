@extends('layouts.layout')
@section('title','Incoming')

@section('content')
<div class="bg-white min-vh-100">
    <div class="px-3 py-3">
        <h4>
            Incoming Request
        </h4>
        <hr>
        <div>
            <small class="text-muted mb-5">Below are the list of requested items from user</small>
            <div class="mt-4 table-responsive-sm">
                <table class="table table-hover" id="incomingTable">
                    <!-- <thead class="thead-dark">
                        <tr>
                            <th style="width: 30%">Requestor</th>
                            <th style="width: 40%">Items</th>
                            <th style="width: 30%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mark Udin Dzeko</td>
                            <td>Otto Rabiot Elchachawy</td>
                            <td>@mdo</td>
                        </tr>
                    </tbody> -->
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
                    "<div class=\"row justify-content-center\"><form action=\"{{ action('TransactionController@approval') }}\" method=\"POST\" class=\"mr-1\"> <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token() }}\"> <input type=\"hidden\" name=\"id\" value=\"{{ $transaction->id }}\"> <input type=\"hidden\" name=\"qry\" value=\"1\"> <button class=\"btn btn-sm btn-success\" type=\"submit\"><i class=\"fas fa-check\"></i></button></form>\
                    <form action=\"{{ action('TransactionController@approval') }}\" method=\"POST\" class=\"ml-1\"> <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token() }}\"> <input type=\"hidden\" name=\"id\" value=\"{{ $transaction->id }}\"> <input type=\"hidden\" name=\"qry\" value=\"0\"> <button class=\"btn btn-sm btn-danger\"><i class=\"fas fa-times\"></i></button></form></div>",
                ],
                @endforeach
            ];

            var table = $('#incomingTable').DataTable({
                "data" : dataSet,
                "aaSorting": [[ 0, "asc" ]],
                "oLanguage": { "sSearch": "Search: " },
                "aoColumnDefs": [
                { "sTitle": "", "aTargets": [0], "bVisible": false, "bSearchable": false}, 
                { "sTitle" : "Transaction ID", "sClass" : "text-center", "bSortable" : false, "sWidth" : "20%", "aTargets": [1] },
                { "sTitle" : "Requestor", "sClass" : "text-center", "bSortable" : false, "sWidth" : "30%", "aTargets": [2] },
                { "sTitle" : "Items", "sClass" : "text-center", "bSortable" : false, "sWidth" : "40%", "aTargets": [3] },
                { "sTitle" : "Action", "sClass" : "text-center", "bSortable" : false, "sWidth" : "30%", "aTargets": [4] },
                ],
                "iDisplayLength": 25,
                "sPaginationType": "full_numbers",
                "bStateSave": true
            });
            table.column( 0 ).visible( false );
 
    });
</script>
@endsection