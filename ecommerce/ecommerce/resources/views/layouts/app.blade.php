<!DOCTYPE html>
<html lang="en">
<head>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Photo Gallery </title>

        <!-- JavaScripts -->
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
    <!-- Fonts -->
 
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css
    ">
      <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
             font-size: 16px;
        }
       .navbar 
       {
        background : none;
        filter: none;
        box-shadow: none;
        background-color: #2d3538;
       }
       .navbar .nav >li >a {
        color: #fff;
        text-shadow: none;
       }
       #p{
        color: #fff;
        text-shadow: none;
       }
       .navbar .nav >li > a:hover
       {
color: gray;
       }

    </style>


</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <span class="navbar-brand" id="p">
                      Photo Gallery 
                </span>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav"> 

                    <li class="{{ Request::is('category')? 'active' : '' }}"><a href="{{ url('/category') }}">Home</a></li>
                    @if(!Auth::guest() && Auth::user()->isAdmin())
                    <li class="{{ Request::is('user')? 'active' : '' }}"><a href="{{ url('/user') }}">Users</a></li>
                    <li class="{{ Request::is('role')? 'active' : '' }}"><a href="{{ url('/role') }}">Roles</a></li>
                       
                    @endif
                     @if(!Auth::guest())
                        
                        <li class="{{ Request::is('album')? 'active' : '' }}"><a href="{{ url('/album') }}">Albums</a></li>
                        <li class="{{ Request::is('image')? 'active' : '' }}"><a href="{{ url('/image') }}">Images</a></li>
                        <li class="{{ Request::is('shopping_cart')? 'active' : '' }}"><a href="{{ route('image.getShoppingCart') }}">Shopping Cart

                               @if(Session::has('cart')) <span class="badge">{{Session::get('cart')->totQuantity}}  @endif  </span>
                            </a></li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li class="{{ Request::is('login')? 'active' : '' }}"><a href="{{ url('/login') }}">Login</a></li>
                        <li class="{{ Request::is('register')? 'active' : '' }}"><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                                Hello {{ Auth::user()->username }} <span class="caret"></span></a>

                            
                            <ul class="dropdown-menu" role="menu">

                                <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i>Profile</a></li>
                                <li><a href="{{ url('/reset_password') }}"><i class="fa fa-key fa-fw"></i>Change Password</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            
                            </ul>
                           
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        
    </nav>

    @yield('content')
   
    <!-- JavaScripts -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
   
    <script type="text/javascript" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    @yield('scripts')
</body>
</html>
