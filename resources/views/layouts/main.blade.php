<!DOCTYPE html>
<html lang="en">
	<head>
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"> </script>
		<![endif]-->
		<title>Dashboard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Dashboard">
		@yield('meta')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Data Tables-->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/w/bs4/dt-1.10.18/b-1.5.6/datatables.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/w/bs4/dt-1.10.18/b-1.5.6/datatables.min.js"></script>
	</head>

	<body>
		<!-- Navigation -->
	  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
			<a class="navbar-brand mr-1" href="#">Dashboard</a>
			<span class="navbar-text ml-2 mr-auto">
				<i id="sidebar-toggle" class="fas fa-fw fa-bars" style="font-size: 1.25em"></i>
			</span>
			<span class="navbar-text ml-auto">
				Welcome, {{ Auth::user()->username }}.
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
			</span>
	  </nav>

		<div id="main-wrapper">
			<ul id="sidebar" style="display: flex;" class="sidebar navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="/">
						<i class="fas fa-fw fa-home"></i>
						<span>Home</span>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-fw fa-boxes"></i>
						<span>Inventory</span>
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="/inventoryitems">Items</a>
						<a class="dropdown-item" href="/inventorytypes">Types</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-fw fa-users"></i>
						<span>Users</span>
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="/users">Users</a>
						<a class="dropdown-item" href="/usertypes">Types</a>
					</div>
				</li>
        <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-fw fa-pallet"></i>
						<span>Orders</span>
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="/orders">Orders</a>
						<a class="dropdown-item" href="/orders/close">Open Orders</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/locations">
						<i class="fas fa-fw fa-location-arrow"></i>
						<span>Locations</span>
					</a>
				</li>
			</ul>
			<div id="wrapper">
				<div class="container-fluid">

          @yield('content')

        </div>
      </div>
    </div>

		@stack('scripts')

  </body>

  <div id="additional">
    @yield('additional')
  </div>

</html>
