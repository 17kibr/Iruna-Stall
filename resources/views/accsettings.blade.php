<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
	<meta name="robots" content="index, follow"/>
	<meta name="description" content="Find, buy and sell items for free on the Iruna Online Global Stall! In the Global Stall, you can post your items as a seller and search for items as a buyer. The stall is free to use and requires no account to search for items."/>
	<meta name="keywords" content="Iruna, Stall, Global, iruna, stall, global"/>
    <meta property="og:image" content="https://irunastall.com/img/iruna.jpg">
    <meta property="og:title" content="Iruna Stall">
    <meta property="og:description" content="Find, buy and sell items for free on the Iruna Online Global Stall! In the Global Stall, you can post your items as a seller and search for items as a buyer. The stall is free to use and requires no account to search for items.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="hostname" content="irunastall.com"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Iruna Global Stall</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>

<body>
        
<div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Iruna Global Stall
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
		    <ul class="navbar-nav ml-auto">
		    	<li class="nav-item">
                             <a class="nav-link" href="/account">Account</a>
                        </li>
			<li class="nav-item">
                             <a class="nav-link" href="/additem">Add item</a>
                        </li>
			<li class="nav-item">
                             <a class="nav-link" href="/viewitem">View my items</a>
                        </li>
			<li class="nav-item">
                             <a class="nav-link" href="/about">About</a>
                        </li>
		    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container">
        <div class="row" >
            <div class="col-md-7 offset-md-3" >

                <div style="height: auto !important;">
		    		<br>
                    <h4>Account settings</h4>
                    <hr>

                    <div>
                    <h3>Change Password</h3>
                    @error('current_password')
                    <div style="color:red;"> {{ $message }}</div>
                    @enderror

                    @error('current_email')
                    <div style="color:red;"> {{ $message }}</div>
                    @enderror

                    @error('success')
                    <div style="color:green;"> {{ $message }}</div>
                    @enderror

                    <form  action="/user/updatepassword" method="POST">
                        @csrf
						<div class="input-group">
							<label>Old password</label>
							<input class="form-control" type="password" name="password" style="margin-left:20px;">
						</div>
						<div class="input-group">
							<label>Email address</label>
							<input class="form-control" type="text" name="email" style="margin-left:13px;">
						</div>
						<div class="input-group">
							<br>
							<button type="submit" class="btn btn-success" name="user_changepass">Change Password</button>
						</div>
					</form> 
                    <hr/>
                    
                    @error('wrong_password')
                    <div style="color:red;"> {{ $message }}</div>
                    @enderror

                    @error('wrong_email')
                    <div style="color:red;"> {{ $message }}</div>
                    @enderror
					<h3 style="color:red;"><b>Delete Account &#38; All Posts</b></h3>
                    <form action="/user/delete" method="POST">
                        @csrf
                        @method('delete')
						<div class="input-group">
							<label>Email</label>
							<input class="form-control" type="text" name="email" style="margin-left:45px;">
						</div>
						<div class="input-group">
							<label>Password</label>
							<input class="form-control" type="password" name="password" style="margin-left:14px;">
						</div>
						<div class="input-group">
							<br>
							<button type="submit" class="btn btn-danger"style="margin-top: 10px;"><b>DELETE ACCOUNT</b></button>
						</div>
					</form> 
				</div>
                    <div class="row divider" role="separator" style="margin-top:20px;"></div>
                </div>
                <div></div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
    <!-- bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" id="cookieinfo"
    src="//cookieinfoscript.com/js/cookieinfo.min.js">
</script>
</body>

</html>
