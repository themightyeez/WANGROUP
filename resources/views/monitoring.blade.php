@extends('layouts.layout')
@section('title','Monitoring')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="border border-white rounded-bottom-custom bg-white mb-2 pb-2">
            <h4 class="mx-4 mt-3">
                Monitored Devices
            </h4>
            <hr>
            <small class="text-muted mx-4">This pages is used to monitor the devices that already requested out from warehouse</small>
        </div>
    </div>

    <div class="col-md-12 col-sm-12" >
        <div class="border border-white rounded-custom bg-white">
            <h5 class="ml-4 my-3">Maps</h5>
            <div id="location" style="height: 400px">
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="border border-white rounded-top-custom bg-white mt-2 pb-4 px-3">
            <h5 class="my-3">Active Devices</h5>
            <div class="mt-4 table-responsive-sm">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 30%">Identity</th>
                            <th style="width: 20%">Status</th>
                            <th style="width: 20%">Graphing</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>WANGroup-PersonalBpkYuda</td>
                            <td>UP - 50ms</td>
                            <td>Gambar Graphing Ambil SDWAN</td>
                            <td>
                                <a class="btn btn-success rounded-pill"><i class="fas fa-lg fa-fingerprint"></i> Check Now</a>
                            </td>
                        </tr>
                        <tr>
                            <td>WANGroup-PT.Kevin Kemayoran</td>
                            <td>Down - Timeout</td>
                            <td>Gambar Graphing Ambil SDWAN</td>
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