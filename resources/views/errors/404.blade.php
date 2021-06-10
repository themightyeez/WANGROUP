<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Error 404</title>
        <link rel="shortcut icon" href="{{ asset('assets/logo wan-group.png') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('assets/custom.css')}}">
    </head>
    <body>
        <div class="container-fluid min-vh-100">
            <div class="empty-4-7 container mx-auto d-flex align-items-center justify-content-center flex-column" style="font-family: 'Poppins', sans-serif;">    
                <img class="img-fluid my-4" style="max-width: 50%" src="{{ asset('assets/error/err404.svg') }}" >
                
                <div class="text-center w-100">
                    <h1 class="title-text text-danger">
                        Opss! Something Missing
                    </h1>
                    <p class="title-caption">
                        The page you’re looking for isn’t found. <br class="d-sm-block d-none"> We suggest you Back to Homepage.
                    </p>
                    <div class="d-flex justify-content-center">
                        <a href="/" target="_self" rel="noopener noreferrer">
                            <button class="btn btn-back d-inline-flex text-white border-0">
                                Back to Homepage
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>