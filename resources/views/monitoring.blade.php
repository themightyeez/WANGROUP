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
                <table class="table table-hover" id="monitoringtable">

                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="checkDevice" tabindex="-1" aria-labelledby="checkDeviceLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Realtime Check Device</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-4">
                            <span class="small font-weight-bolder">Identity</span>
                        </div>
                        <div class="col-md-8 text-center">
                            <div id="deviceIdentity"></div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-4">
                            <span class="small font-weight-bolder">Latency</span>
                        </div>
                        <div class="col-md-8 text-center">
                            <div class="spinner-border text-secondary" id="spinner" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div id="deviceLatency"></div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-12 mb-1">
                            <span class="small font-weight-bolder">Graph</span>
                        </div>
                        <div class="col-md-12">
                            <div id="deviceGraph"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="modal fade" id="editDevice" tabindex="-1" aria-labelledby="editDeviceLabel" aria-hidden="true">
    <form action="{{ action('MonitoringController@edit') }}" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Device</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="" id="deviceId">
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-3">
                            <span class="small font-weight-bolder">Identity</span>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="identity" id="editDeviceName">
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-3">
                            <span class="small font-weight-bolder">Location</span>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="location" id="editDeviceLocation">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('additionalCss')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endsection


@section('additionalScript')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<script>
    
    var map = L.map('location').setView([-6.1858284,106.836],14);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> | Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1Ijoia3Jpc25heXVkYSIsImEiOiJja285Z2Y2bDAwNGNnMnVtbjJzZGU4NXg4In0.67nZNG6fc8Vs0NMjikglwA'
    }).addTo(map);

    var headofficepin = L.icon({
        iconUrl: '{{ asset('assets/marker/noc-marker.png') }}',
        iconSize: [100, 100],
        iconAnchor: [18, 18],
        popupAnchor: [-3, -20],
    });

    var status_reply = L.icon({
        iconUrl: '{{ asset('assets/marker/status-ok.png') }}',
        iconSize: [50, 50],
        iconAnchor: [18, 18],
        popupAnchor: [-3, -20],
    });

    var status_timeout = L.icon({
        iconUrl: '{{ asset('assets/marker/status-timeout.png') }}',
        iconSize: [50, 50],
        iconAnchor: [18, 18],
        popupAnchor: [-3, -20],
    });

    var headoffice = L.marker([-6.1858284,106.8363342], {icon:headofficepin}).bindPopup("<strong>WAN GROUP Office</strong>").addTo(map);

    @foreach ($devices as $device)
        @php 
            $location = explode("," , $device->location);
            $lat = $location[0];
            $lon = $location[1];
        @endphp

        @switch($device->status)
            @case('timeout')
                L.marker([{{$lat}} , {{$lon}}], {icon:status_timeout}).bindPopup("<strong>{{$device->identity}}</strong>").addTo(map);
            @break

            @default
                L.marker([{{$lat}} , {{$lon}}], {icon:status_reply}).bindPopup("<strong>{{$device->identity}}</strong>").addTo(map);
            @break
        @endswitch
        
    @endforeach

    function changeView(id){
        var qry = document.querySelector('#changeView-'+id);
        var lat = qry.dataset.lat;
        var lon = qry.dataset.lon;
        map.setView(new L.LatLng(lat,lon),15); 
    }

</script>

<script>
    $(document).ready(function(){
        var dataSet = [
            @foreach ($devices as $device)
                @php 
                    $location = explode("," , $device->location);
                    $lat = $location[0];
                    $lon = $location[1];
                @endphp
            [
                "{{ $device->id }}",
                "<div class=\"row\"><div class=\"col-12\"><img src=\"/assets/router/{{$device->router_type}}.png\" style=\"max-width: 50%\"></div><div class=\"col-12\">{{ $device->identity }}</div></div>",
                @if($device->status == 'timeout')
                    "<span class=\"badge badge-danger\"> Timeout </span>",
                    "<a class=\"btn btn-light rounded-pill\" id=\"changeView-{{$device->id}}\" data-lat=\"{{ $lat }}\" data-lon=\"{{ $lon }}\" onclick=\"changeView({{$device->id}})\"><i class=\"fas fa-map-marker-alt pr-1 py-1\"></i> Locate Me!</a>",
                    "<a class=\"btn btn-success rounded-pill disabled\" data-toggle=\"modal\" data-target=\"#checkDevice\"><i class=\"fas fa-lg fa-fingerprint pr-1 py-1\"></i>Check</a>\
                    <a class=\"btn btn-edit-monitoring rounded-pill\" data-toggle=\"modal\" data-target=\"#editDevice\" data-id=\"{{ $device->id }}\" data-identity=\"{{ $device->identity }}\" data-location=\"{{ $device->location }}\"><i class=\"fas fa-edit px-1 py-1\"></i></a>"
                @else
                    "{{ $device->status }}ms",
                    "<a class=\"btn btn-light rounded-pill\" id=\"changeView-{{$device->id}}\" data-lat=\"{{ $lat }}\" data-lon=\"{{ $lon }}\" onclick=\"changeView({{$device->id}})\"><i class=\"fas fa-map-marker-alt pr-1 py-1\"></i> Locate Me!</a>",
                    "<a class=\"btn btn-success rounded-pill mb-1\" data-toggle=\"modal\" data-target=\"#checkDevice\" data-id=\"{{ $device->id }}\" data-identity=\"{{ $device->identity }}\" data-graph-id=\"{{ $device->graph_id }}\"><i class=\"fas fa-lg fa-fingerprint pr-1 py-1\"></i>Check</a>\
                    <a class=\"btn btn-edit-monitoring rounded-pill\" data-toggle=\"modal\" data-target=\"#editDevice\" data-id=\"{{ $device->id }}\" data-identity=\"{{ $device->identity }}\" data-location=\"{{ $device->location }}\"><i class=\"fas fa-edit px-1 py-1\"></i></a>"
                @endif
            ],
            @endforeach
        ];

        var table = $('#monitoringtable').DataTable({
            "data" : dataSet,
            "aaSorting": [[ 0, "asc" ]],
            "oLanguage": { "sSearch": "Search: " },
            "aoColumnDefs": [
            { "sTitle": "", "aTargets": [0], "bVisible": false, "bSearchable": false}, 
            { "sTitle" : "Identity", "sClass" : "text-center", "bSortable" : false, "sWidth" : "30%", "aTargets": [1] },
            { "sTitle" : "Status", "sClass" : "text-center", "bSortable" : false, "sWidth" : "20%", "aTargets": [2] },
            { "sTitle" : "Location", "sClass" : "text-center", "bSortable" : false, "sWidth" : "20%", "aTargets": [3] },
            { "sTitle" : "Action", "sClass" : "text-center", "bSortable" : false, "sWidth" : "20%", "aTargets": [4] },
            ],
            "iDisplayLength": 25,
            "sPaginationType": "full_numbers",
            "bStateSave": true
        });
        table.column( 0 ).visible( false );

        $('#editDevice').on('show.bs.modal', function (event) {
            var qry = $(event.relatedTarget);
            $('#deviceId').val(qry.data('id'));
            $('#editDeviceName').val(qry.data('identity'));
            $('#editDeviceLocation').val(qry.data('location'));
        
        });

        $('#checkDevice').on('show.bs.modal', function (event) {
            var qry = $(event.relatedTarget);
            var id = qry.data('id');
            var graphId = qry.data('graph-id');
            var identity = qry.data('identity');
            
            $('#spinner').show();
            $('#deviceLatency').hide();


            $('#deviceIdentity').html(identity);
            $('#deviceGraph').html('<iframe src=\"{{env('GRAPH_HOST')}}/d-solo/Jvk5ekQGz/maxmon-cpe?orgId=1&var-router_id='+graphId+'&panelId=5" width="450" height="300" frameborder="0"></iframe>');
            
            $.ajax({
                url: "{{ action('MonitoringController@pingExec') }}",
                type: "post", 
                data: {
                    _token: '{!! csrf_token() !!}',
                    id: id
                },
                success: function(response) {
                    $('#spinner').hide();
                    $('#deviceLatency').html(response['result']+'ms');
                    $('#deviceLatency').show();
                },
                error: function(){

                }
            });

        });

    });

</script>


@endsection