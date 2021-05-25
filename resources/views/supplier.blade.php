@extends('layouts.layout')
@section('title','Supplier')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="border border-white rounded-bottom-custom bg-white mb-2 pb-2">
            <h4 class="mx-4 mt-3">
                Supplier
            </h4>
            <hr>
            <small class="text-muted mx-4">You can contact the supplier below by click the given button</small>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="border border-white rounded-top-custom bg-white mt-2 pb-4 px-3">
            <h5 class="my-3">Contact Detail</h5>

            <div class="float-right my-2">
                <button class="btn btn-light rounded-pill">   
                    Add
                </button>
            </div>
            <div class="mt-4 table-responsive-sm">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 30%">Identity</th>
                            <th style="width: 20%">Phone Number</th>
                            <th style="width: 40%">Address</th>
                            <th style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PT. Alexander Pioner Berkah</td>
                            <td>021 80666777</td>
                            <td>Jalan Senoparty No 77, Kec. Rawa Buaya, Kota Tangerang Barat</td>
                            <td>
                                <a class="btn btn-success rounded-pill mb-1"><i class="fab fa-lg fa-whatsapp"></i></a>
                                <a class="btn btn-outline-danger rounded-pill mb-1"><i class="fas fa-trash-alt"></i></a>    
                            </td>
                        </tr>
                        <tr>
                            <td>PT. Alexander Pioner Berkah</td>
                            <td>021 80666777</td>
                            <td>Jalan Senoparty No 77, Kec. Rawa Buaya, Kota Tangerang Barat</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <td>PT. Alexander Pioner Berkah</td>
                            <td>021 80666777</td>
                            <td>Jalan Senoparty No 77, Kec. Rawa Buaya, Kota Tangerang Barat</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <td>PT. Alexander Pioner Berkah</td>
                            <td>021 80666777</td>
                            <td>Jalan Senoparty No 77, Kec. Rawa Buaya, Kota Tangerang Barat</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <td>PT. Alexander Pioner Berkah</td>
                            <td>021 80666777</td>
                            <td>Jalan Senoparty No 77, Kec. Rawa Buaya, Kota Tangerang Barat</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <td>PT. Alexander Pioner Berkah</td>
                            <td>021 80666777</td>
                            <td>Jalan Senoparty No 77, Kec. Rawa Buaya, Kota Tangerang Barat</td>
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