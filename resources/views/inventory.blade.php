@extends('layouts.layout')
@section('title','Inventory')

@section('content')
<div class="bg-white min-vh-100">
    <div class="px-3 py-3">
        <h4>
            Inventory Items
        </h4>
        <hr>
        <div>
            <small class="text-muted mb-5">Below are the list of available item in warehouse</small>
            <div class="mt-4 table-responsive-sm">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 40%">Name</th>
                            <th style="width: 20%">Category</th>
                            <th style="width: 10%">Qty</th>
                            <th style="width: 30%">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Router RB3011</td>
                            <td>Routerboard</td>
                            <td>55</td>
                            <td>-</td>
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