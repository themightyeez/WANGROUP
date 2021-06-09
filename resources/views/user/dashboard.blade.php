@extends('user.layouts.layout')
@section('title','Dashboard')

@section('content')
<div class="pl-3 py-3">
    <h4>
        Hello {{ Auth()->user()->name }}
    </h4>
    <hr>
</div>
<div class="row">
    <div class="col-lg-12 col-sm-12">
        <div class="card mb-3 mx-3 border border-white rounded-custom">
            <div class="row no-gutters">
                <div class="col-md-4 py-4 bg-card">
                    <div class="px-5 text-center">
                        <i class="fas fa-5x fa-dolly text-white"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <a href="{{ action('UserController@request') }}" class="text-decoration-none">
                            <h5 class="card-title">Request</h5>
                        </a>
                        <p class="card-text"><small class="text-muted">Order as much as you requested</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12">
        <div class="card mb-3 mx-3 border border-white rounded-custom">
            <div class="row no-gutters">
                <div class="col-md-4 py-4 bg-card">
                    <div class="px-5 text-center">
                        <i class="fas fa-5x fa-warehouse text-white"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <a href="{{ action('UserController@inventory') }}" class="text-decoration-none">
                            <h5 class="card-title">Inventory</h5>
                        </a>
                        <p class="card-text"><small class="text-muted">List of warehouse items</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12">
        <div class="card mb-3 mx-3 border border-white rounded-custom">
            <div class="row no-gutters">
                <div class="col-md-4 py-4 bg-card">
                    <div class="px-5 text-center">
                        <i class="fas fa-5x fa-sort-alpha-down text-white"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <a href="{{ action('UserController@logOrder') }}" class="text-decoration-none">
                            <h5 class="card-title">Log Order</h5>
                        </a>
                        <p class="card-text"><small class="text-muted">List of transaction you made</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additionalScript')

@endsection