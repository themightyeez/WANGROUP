@extends('layouts.layout')
@section('title','Dashboard')

@section('content')
<div class="pl-3 py-3">
    <h4>
        Hello {{ Auth()->user()->name }}
    </h4>
    <hr>
</div>
<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="card mb-3 border border-white rounded-custom">
            <div class="row no-gutters">
                <div class="col-md-4 py-4 bg-card">
                    <div class="px-5">
                        <i class="fas fa-5x fa-download text-white"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <a href="{{ action('WebController@incoming') }}" class="text-decoration-none">
                            <h5 class="card-title">Request</h5>
                        </a>
                        <p class="card-text"><small class="text-muted">See how many request left behind</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="card mb-3 border border-white rounded-custom">
            <div class="row no-gutters">
                <div class="col-md-4 py-4 bg-card">
                    <div class="px-5">
                        <i class="fas fa-5x fa-warehouse text-white"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <a href="{{ action('WebController@inventory') }}" class="text-decoration-none">
                            <h5 class="card-title">Inventory</h5>
                        </a>
                        <p class="card-text"><small class="text-muted">List of warehouse items</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additionalScript')

@endsection