<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Flexible Management') }}
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 main-sidebar hidden-print">
                    <ul class="nav navbar-nav">
                        @if (Auth::check())
                            <li><a href="{{url('/home')}}"><strong>Dashboard</strong></a></li>
                            <li class="accordion-heading"  >
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapseSix">Employees <span class="caret pull-right"></span></a>
                                <ul id="collapseSix" class="collapsed_menu accordion-body collapse">
                                    <li><a href="{{url('/employees')}}">All Employees</a></li>
                                </ul>
                            </li>
                            <li class="accordion-heading"  >
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapseOne">Birds <span class="caret pull-right"></span></a>
                                <ul id="collapseOne" class="collapsed_menu accordion-body collapse">
                                    <li><a href="{{url('/birds')}}">Birds Summary</a></li>
                                    <li><a href="{{url('/suppliers')}}">Suppliers</a></li>
                                    <li><a href="{{url('/customers')}}">Customers</a></li>
                                    <li><a href="{{url('/purchases')}}">Purchases</a></li>
                                    <li><a href="{{url('/sales')}}">Sales</a></li>
                                </ul>
                            </li>
                            <li class="accordion-heading"  >
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapseThree">Chicks <span class="caret pull-right"></span></a>
                                <ul id="collapseThree" class="collapsed_menu accordion-body collapse">
                                    <li><a href="{{url('/chicks')}}">Chicks Summary</a></li>
                                    <li><a href="{{url('/chicksuppliers')}}">Suppliers</a></li>
                                    <li><a href="{{url('/chickcustomers')}}">Customers</a></li>
                                    <li><a href="{{url('/chickpurchases')}}">Purchases</a></li>
                                    <li><a href="{{url('/chicksales')}}">Sales</a></li>
                                </ul>
                            </li>
                            <li class="accordion-heading"  >
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapseFour">Feeds <span class="caret pull-right"></span></a>
                                <ul id="collapseFour" class="collapsed_menu accordion-body collapse">
                                    <li><a href="{{url('/feeds')}}">Feeds Summary</a></li>
                                    <li><a href="{{url('/feedsuppliers')}}">Suppliers</a></li>
                                    <li><a href="{{url('/feedcustomers')}}">Customers</a></li>
                                    <li><a href="{{url('/feedpurchases')}}">Purchases</a></li>
                                    <li><a href="{{url('/feedsales')}}">Sales</a></li>
                                </ul>
                            </li>
                            <li class="accordion-heading"  >
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapsetwo">Expense<span class="caret pull-right"></span></a>
                                <ul id="collapsetwo" class="collapsed_menu accordion-body collapse">
                                    <li><a href="{{url('/expenses')}}">{{trans('dashboard.expenses')}}</a></li>
                                    <li><a href="{{url('/expensecategory')}}">Categories</a></li>
                                </ul>
                            </li>
                            <li class="accordion-heading"  >
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapseFive">Report<span class="caret pull-right"></span></a>
                                <ul id="collapseFive" class="collapsed_menu accordion-body collapse">
                                    <li><a href="{{url('/dailyreport')}}">Daily Report</a></li>
                                    <li><a href="{{url('/birdreports')}}">Birds Summary</a></li>
                                    <li><a href="{{url('/reportsummary')}}">Total Summary</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 print-width">
                    <div class="content">
                        <div class="visible-print text-center">
                            <h1>M/S KEYA ENTERPRISE</h1>
                            <p>Office : Shah Amanat Tower, Kaptai Raster Matha, (In Fron of Police Box), Chandgaon, Chittagong</p>
                            <h4>Mobile : 01854-814152-62</h4>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
            <div class="row app-footer hidden-print">
                <div class="col-md-12">
                    <div class="links dev-logo text-center">
                        <p>Designed and Developed by <a href="http://www.flexibleit.net"><img src="{{asset('img/logo-blue.png')}}" alt=""></a></p>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>--}}

    <script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/jquery-1.12.4.min.js') }}" type="text/javascript"></script>



    <script src="{{ asset('js/jquery-ui.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jspdf.debug.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jspdf.plugin.autotable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.table2excel.min.js') }}" type="text/javascript"></script>



    <script src="{{ asset('js/getreport.js') }}" type="text/javascript"></script>

@yield('scripts')
</body>
</html>
