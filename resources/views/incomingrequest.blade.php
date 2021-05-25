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
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 20%">Requestor</th>
                            <th style="width: 60%">Items</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mark Udin Dzeko</td>
                            <td>Otto Rabiot Elchachawy</td>
                            <td>@mdo</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additionalScript')

@endsection