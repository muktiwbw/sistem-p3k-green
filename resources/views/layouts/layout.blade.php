<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Aplikasi Pemantau Kotak P3K - @yield('title')</title>

    <!-- start: Css -->
    <link rel="stylesheet" type="text/css" href="{{asset("css/bootstrap.min.css")}}">

    <!-- plugins -->
    <link rel="stylesheet" type="text/css" href="{{asset("css/plugins/font-awesome.min.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset("css/plugins/animate.min.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset("css/plugins/nouislider.min.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset("css/plugins/select2.min.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset("css/plugins/ionrangeslider/ion.rangeSlider.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset("css/plugins/ionrangeslider/ion.rangeSlider.skinFlat.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset("css/plugins/bootstrap-material-datetimepicker.css")}}"/>
    <link href="{{asset("css/style.css")}}" rel="stylesheet">
    <!-- end: Css -->
</head>
<body>
    <!-- start: Header -->
    <nav class="navbar navbar-default header navbar-fixed-top bg-dark-green">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
                <a href="index.html" class="navbar-brand"> 
                 <b>Petro First Aid Box Controller</b>
                </a>

              <ul class="nav navbar-nav navbar-right user-nav">
                @if(Auth::check())
                <li class="user-name"><span><a href="/logout">Logout</a></span></li>
                @endif
              </ul>
            </div>
          </div>
        </nav>
      <!-- end: Header -->
    <div class="container-fluid mimin-wrapper">
        <div id="left-menu">
            <div class="sub-left-menu scroll">
            <ul class="nav nav-list">
                @if(Auth::check())
                <li>
                    <a class="nav-header" href="/dashboard">Dashboard 
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                </li>
                <li>
                    <a class="nav-header" href="/department">Departemen
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                </li>
                <li>
                    <a class="nav-header" href="/kotak">Kotak 
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                </li>
                <li>
                    <a class="nav-header" href="/obat">Obat 
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                </li>
                @if(Auth::user()->admin)
                <li>
                    <a class="nav-header" href="/user">User 
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                </li>
                <li>
                    <a class="nav-header" href="/order">Permintaan 
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                </li>
                @else
                <li>
                    <a class="nav-header" href="/user/{{ Auth::user()->id }}/edit">Setting 
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                </li>
                @endif
                @endif
                </ul>
            </div>
        </div>
        <div id="content">
            <div class="panel box-shadow-none content-header">
                <div class="panel-body">
                  <div class="col-md-12">
                      <h3 class="animated fadeInLeft">@yield('page-title')</h3>
                      <p class="animated fadeInDown">@yield('breadcrumb')</p>
                  </div>
                </div>
              </div>
            @yield('content')
        </div>
    </div>
</body>
</html>