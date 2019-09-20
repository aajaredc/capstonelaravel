<!DOCTYPE html>
<html lang="en">
	<head>
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"> </script>
		<![endif]-->
		<title>Dashboard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Dashboard">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Data Tables-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
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
						<a class="nav-link" href="index.php">
							<i class="fas fa-fw fa-home"></i>
							<span>Home</span>
						</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-fw fa-user"></i>
							<span>Me</span>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="viewschedule.php">My Schedule</a>
							<a class="dropdown-item" href="updatemyinformation.php">My Information</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-fw fa-table"></i>
							<span>Menu</span>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<h6 class="dropdown-header">Menu Items:</h6>
							<a class="dropdown-item" href="selectmenuitems.php">Select</a>
							<a class="dropdown-item" href="insertmenuitems.php">Insert</a>
							<a class="dropdown-item" href="updatemenuitems.php">Update</a>
							<a class="dropdown-item" href="deletemenuitems.php">Delete</a>
							<div class="dropdown-divider"></div>
							<h6 class="dropdown-header">Menu Types:</h6>
							<a class="dropdown-item" href="selectmenutypes.php">Select</a>
							<a class="dropdown-item" href="insertmenutypes.php">Insert</a>
							<a class="dropdown-item" href="updatemenutypes.php">Update</a>
							<a class="dropdown-item" href="deletemenutypes.php">Delete</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-fw fa-users"></i>
							<span>Employees</span>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<h6 class="dropdown-header">Employees:</h6>
							<a class="dropdown-item" href="selectemployees.php">Select</a>
							<a class="dropdown-item" href="insertemployees.php">Insert</a>
							<a class="dropdown-item" href="updateemployees.php">Update</a>
							<a class="dropdown-item" href="deleteemployees.php">Delete</a>
							<div class="dropdown-divider"></div>
							<h6 class="dropdown-header">Employee Types:</h6>
							<a class="dropdown-item" href="selectemployeetypes.php">Select</a>
							<a class="dropdown-item" href="insertemployeetypes.php">Insert</a>
							<a class="dropdown-item" href="updateemployeetypes.php">Update</a>
							<a class="dropdown-item" href="deleteemployeetypes.php">Delete</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-fw fa-user-tag"></i>
							<span>Customers</span>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="selectcustomers.php">Select</a>
							<a class="dropdown-item" href="insertcustomers.php">Insert</a>
							<a class="dropdown-item" href="updatecustomers.php">Update</a>
							<a class="dropdown-item" href="deletecustomers.php">Delete</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-fw fa-pallet"></i>
							<span>Orders</span>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="selectorders.php">Select</a>
							<a class="dropdown-item" href="insertorders.php">Insert</a>
							<a class="dropdown-item" href="updateorders.php">Update</a>
							<a class="dropdown-item" href="deleteorders.php">Delete</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="closeorders.php">Current Orders</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-fw fa-receipt"></i>
							<span>Tickets</span>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="selecttickets.php">Select</a>
							<a class="dropdown-item" href="updatetickets.php">Update</a>
							<a class="dropdown-item" href="deletetickets.php">Delete</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="closetickets.php">Current Tickets</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-fw fa-clock"></i>
							<span>Schedules</span>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<h6 class="dropdown-header">Schedules:</h6>
							<a class="dropdown-item" href="selectschedules.php">Select</a>
							<a class="dropdown-item" href="insertschedules.php">Insert</a>
							<a class="dropdown-item" href="updateschedules.php">Update</a>
							<a class="dropdown-item" href="deleteschedules.php">Delete</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="viewschedule.php">My Schedule</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-fw fa-location-arrow"></i>
							<span>Locations</span>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<h6 class="dropdown-header">Locations:</h6>
							<a class="dropdown-item" href="selectlocations.php">Select</a>
							<a class="dropdown-item" href="insertlocations.php">Insert</a>
							<a class="dropdown-item" href="updatelocations.php">Update</a>
							<a class="dropdown-item" href="deletelocations.php">Delete</a>
							<div class="dropdown-divider"></div>
							<h6 class="dropdown-header">Tables:</h6>
							<a class="dropdown-item" href="selecttables.php">Select</a>
							<a class="dropdown-item" href="inserttables.php">Insert</a>
							<a class="dropdown-item" href="updatetables.php">Update</a>
							<a class="dropdown-item" href="deletetables.php">Delete</a>
						</div>
					</li>
			</ul>
			<div id="wrapper">
				<div class="container-fluid">

          @yield('content')

        </div>
      </div>
    </div>
  </body>

  <div>
    @yield('additional')
  </div>
</html>
