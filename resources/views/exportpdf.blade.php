<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Transaction Detail</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="http://tb-web2.wellsa.id/assets/custom.css">
    </head>

    <body>
        <div class="container-fluid min-vh-100">            
            <div class="empty-4-7 container-fluid mx-auto d-flex align-items-center justify-content-center flex-column">    
                <div class="w-100 text-left">
                    <img style="max-width: 10%" src="{{ asset('assets/WG-JPG.jpg') }}" >
                </div>
                
                <div class="w-100">
                    <p class="h3 text-danger text-center pb-3">
                        <strong>
                            Transaction Invoice
                        </strong>
                    </p>

                    <div class="pt-3">
                        <strong>{{ $transaction->transaction_id }}</strong>
                        <p class="font-weight-light font-italic">Transaction ID</p>
                        <div>
                            <strong>{{ $transaction->contact }}</strong>
                            <p class="font-weight-light font-italic">Requested by</p>
                        </div>

                        <div>
                            <strong>{{ date('d F Y', strtotime($transaction->created_at)) }}</strong>
                            <p class="font-weight-light font-italic">Timestamp</p>
                        </div>
                    </div>

                    <div class="watermark">
                        <img src="{{ asset('assets/WG-JPG.jpg') }}"/>
                    </div>

                    <div class="pt-3">
                        <strong>List Items</strong>
                        <table class="table table-borderless">
                            <tbody>                        
                                @foreach($transaction->product as $product)
                                <tr>
                                    <td style="width: 35%">{{ $product->name }}</td>
                                    <td style="width: 15%" class="text-center">{{ $product->pivot->qty }} unit</td>
                                    <td style="width: 60%" class="text-center">{{ $product->pivot->note ?? '-'}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pt-3">
                        <div>
                            <strong>Status</strong>
                            <p>
                            @switch($transaction->status)
                                @case(1) <span class="badge badge-secondary"> On Process </span> @break
                                @case(2) <span class="badge badge-success"> Success </span> @break
                                @case(3) <span class="badge badge-danger"> Rejected </span> @break
                                @default
                            @endswitch
                            </p>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
        <footer class="fixed-bottom">
            <p class="text-center font-weight-normal">
                All Right Reserved © 2021
            </p>
        </footer>
    </body>
</html>