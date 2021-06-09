<!DOCTYPE html>
  <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>@yield('title') | WAN Group</title>
            <link rel="shortcut icon" href="{{ asset('assets/logo wan-group.png') }}">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
            <link rel="stylesheet" href="{{ asset('assets/custom.css')}}">
            <link rel="stylesheet" href="{{ asset('assets/font-awesome/free-v4-font-face.min.css')}}">
            <link rel="stylesheet" href="{{ asset('assets/font-awesome/free-v4-shims.min.css')}}">
            <link rel="stylesheet" href="{{ asset('assets/font-awesome/free.min.css')}}">
            @yield('additionalCss')
        </head>
        <body>
                @include('user.layouts.navbar')
                <div style="background-color: #ededed; font-family: 'Poppins', sans-serif;">
                    <div class="container-fluid min-vh-100 pb-3">
                        @yield('content')
                    </div>
                </div>
                @include('user.layouts.footer')
                
                <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
                <!-- <script src="https://kit.fontawesome.com/7dbccb5dce.js" crossorigin="anonymous"></script> -->
                <script>
                $(document).ready(function() {
                    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
                });
                </script>
                @include('sweetalert::alert')

                @yield('additionalScript')    
            
        </body>
  </html>