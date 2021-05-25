<div class="w-100" style="box-sizing: border-box; background-color: #525298; font-family: 'Poppins', sans-serif" >
    <nav class="navbar-custom navbar navbar-expand-lg navbar-dark px-md-4 py-3 bg-purple">
        <div class="container">
            <a class="navbar-brand" href="{{ action('WebController@dashboard') }}">
                <img style="width:64px" src="{{ asset('assets/logo wan-group.png') }}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link rounded-pill px-md-4" href="{{ action('WebController@dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded-pill px-md-4" href="{{ action('MonitoringController@index') }}">Monitoring</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded-pill px-md-4" href="{{ action('WebController@supplier') }}">Supplier</a>
                    </li>
                </ul>
                <div class="d-flex d-lg-none float-right">
                    <a class="btn btn-account btn-account-kanan" href="{{ action('WebController@account') }}"><i class="fas fa-user-circle"></i> Account</a>
                    <a class="btn btn-danger rounded-lg ml-2" href="#"><i class="fas fa-sign-out-alt"></i></a>
                </div>
                <div class="dropdown d-none d-lg-block">
                    <button class="btn btn-account btn-account-kanan dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-lg fa-user-circle"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ action('WebController@account') }}">Account</a>
                        <a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div> 