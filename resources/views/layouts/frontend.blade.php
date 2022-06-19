<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.6" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>

<div class="container">

    <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
            <div class="container-fluid pe-0">
                <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{ url('/') }}">
                <img src="../assets/img/logo_pharmacy.png" class="navbar-brand-img h-100" alt="main_logo" style="max-height: 40px; margin-bottom: 15px; !important;">
              <span class="fs-2 ms-2 font-weight-bold">Apotik U</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">@can('member-permission')
                    <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{url('/')}}">
                    <i class="fa fa-book opacity-6 text-dark me-1"></i>
                    Katalog
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{url('/history')}}">
                    <i class="fa fa-list opacity-6 text-dark me-1"></i>
                    Riwayat Transaksi
                  </a>
                </li>@endcan
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-key opacity-6 text-dark me-1"></i>{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-circle opacity-6 text-dark me-1"></i>{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="">
                            <div class="dropdown">
                <?php $total=0; $jumlah=0;?>
                    @if(session('cart'))
                    @foreach(session('cart') as $id=>$details)
                    <?php
                        $jumlah+=$details['qty'];
                        $total+=$details['qty']*$details['price'];
                        ?>
                        @endforeach
                        @endif
                <button type="button" class="btn btn-info me-3" data-toggle="dropdown">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{$jumlah ?? '' ?? ''}}</span>
                </button>
                <div class="dropdown-menu border-radius-xl">
                <?php $total=0; $jumlah=0;?>
                    @if(session('cart'))
                    @foreach(session('cart') as $id=>$details)
                    <?php
                        $jumlah+=$details['qty'];
                        $total+=$details['qty']*$details['price'];
                        ?>
                    <div class="row cart-detail">
                        <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                            <img height='50px' src="{{asset('images/'.$details['img'])}}">
                        </div>
                        <div class="col-lg-8 col-sm-8 col-8 cart-detail-product text-sm">
                            <p>{{$details['name']}}</p>
                            <span class="price text-info"><b>Rp {{number_format($details['price'],0,',','.')}}</b></span> <span class="count text-dark">&nbsp; Qty:{{$details['qty']}}</span>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    
                    <div class="row total-header-section">
                        <div class="col-lg-6 col-sm-6 col-6">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{$jumlah ?? '' ?? ''}}</span>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                            <p>Total: <b><span class="text-info">Rp {{number_format($total,0,',','.')}},-</span></b></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 text-center  checkout">
                            <a href="<?php if($total!=0) echo "/checkout" ?>" class="btn btn-lg btn-primary text-lg btn-block p-0">Checkout<br>Rp {{number_format($total,0,',','.')}},-</a>
                        </div>
                </div>
            </div>
                            <li>
                            <li class="nav-item dropdown text-lg mt-3">
                                <!-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> -->
                                 
                                <!-- </a> -->

                                <!-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> -->
                                    <a class="text-danger text-xxl " href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ Auth::user()->name }} <i class="ni ni-button-power text-sm"></i>
                                    </a>
                                
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                <!-- </div> -->
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

<div class="row page-header mt-8">
<div class="container page">
    @yield('content')
</div>
</div>
</div>



<script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="../assets/js/plugins/jquery.editable.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.6"></script>
  
@yield('scripts')

</body>
</html>