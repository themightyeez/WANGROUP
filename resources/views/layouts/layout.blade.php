<!DOCTYPE html>
  <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>@yield('title') | WAN Group</title>
            <link rel="shortcut icon" href="{{ asset('assets/logo wan-group.png') }}">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
            <link rel="stylesheet" href="{{ asset('assets/custom.css')}}">
            @yield('additionalCss')
        </head>
        <body>
                @include('layouts.navbar')
                <div style="background-color: #ededed; font-family: 'Poppins', sans-serif;">
                    <div class="container-fluid min-vh-100 pb-3">
                        @yield('content')
                    </div>
                </div>
                @include('layouts.footer')
                
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
                <script src="https://kit.fontawesome.com/7dbccb5dce.js" crossorigin="anonymous"></script>
                @yield('additionalScript')    
            
        </body>
  </html>