@extends('layouts.layout')
@section('title','Dashboard')

@section('content')
<div class="pl-3 py-3">
    <h4>
        Hello Admin
    </h4>
    <hr>
</div>
<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="card mb-3 border border-white rounded-custom">
            <div class="row no-gutters">
                <div class="col-md-4 py-4 bg-card">
                    <div class="px-5">
                        <i class="fas fa-5x fa-luggage-cart text-white"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <a href="{{ action('WebController@incoming') }}" class="text-decoration-none">
                            <h5 class="card-title">Incoming Request</h5>
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
    <div class="col-lg-6 col-sm-12">
        <div class="card mb-3 border border-white rounded-custom">
            <div class="row no-gutters">
                <div class="col-md-4 py-4 bg-card">
                    <div class="px-5">
                        <i class="fas fa-5x fa-file-invoice-dollar text-white"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <a href="{{ action('WebController@transactions') }}" class="text-decoration-none">
                            <h5 class="card-title">Transaction</h5>
                        </a>
                        <p class="card-text"><small class="text-muted">Write down inbound/outbound items</small></p>
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
                        <i class="fas fa-5x fa-chart-bar text-white"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <a href="{{ action('WebController@reports') }}" class="text-decoration-none">
                            <h5 class="card-title">Report</h5>
                        </a>
                        <p class="card-text"><small class="text-muted">List of all transaction</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12" >
        <div class="border border-white rounded-custom bg-white pb-3">
            <h5 class="ml-4 my-3">Active Devices</h5>
            <div id="location" style="height: 400px">
            </div>
        </div>
    </div>
</div>
@endsection

@section('additionalScript')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="anonymous"></script>

<script>
    var map = L.map('location').setView([-6.1858284,106.836],13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> | Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1Ijoia3Jpc25heXVkYSIsImEiOiJja285Z2Y2bDAwNGNnMnVtbjJzZGU4NXg4In0.67nZNG6fc8Vs0NMjikglwA'
    }).addTo(map);
    var headoffice = L.marker([-6.1858284,106.836]).addTo(map);
</script>
@endsection