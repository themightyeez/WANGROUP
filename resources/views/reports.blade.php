@extends('layouts.layout')
@section('title','Reports')

@section('content')
<div class="bg-white min-vh-100">
    <div class="px-3 py-3">
        <h4>
            Report List
        </h4>
        <hr>
        <div>
            <small class="text-muted mb-5">Below are the list of inbound/outbound transaction that was happen</small>
            <div class="mt-4 table-responsive-sm">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 20%">Transaction ID</th>
                            <th style="width: 20%">Requested By</th>
                            <th style="width: 50%">Items</th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>WG/OUT/25-05-2021/1</td>
                            <td>Mang KP Racing</td>
                            <td>55</td>
                            <td>
                                <a href="" class="btn btn-dark"><i class="fas fa-file-download"></i></a>
                            </td>
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