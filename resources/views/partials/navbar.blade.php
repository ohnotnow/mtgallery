	<div class="navbar navbar-default navbar-static-top" role="navigation">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="{{ url('/admin') }}">Monkeytwizzle</a>
	        </div>
            @if (Auth::check())
		        <div class="navbar-collapse collapse">
		          <ul class="nav navbar-nav">
		          	<li><a href="/admin">Galleries</a></li>
		          	<li><a href="/admin/photo">Photographs</a></li>
		          	<li><a href="/admin/blog">Blogs</a></li>
		            <!-- <li class="active"><a href="#">Home</a></li> -->
{{-- 		            <li class="dropdown">
		              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Galleries</a>
		              <ul class="dropdown-menu">
		              	<li><a href="">Whatever</a></li>
		              	<li><a href="">My bookings</a></li>
		              	<li><a href="">My fault reports</a></li>
		              	<li><a href="">My samples</a></li>
		              </ul>
		            </li>
 --}}		          </ul>
			        <ul class="nav navbar-nav navbar-right">
			            <li><a href="{{ url('/auth/logout') }}">Log Out</a></li>
		          	</ul>
		        </div><!--/.nav-collapse -->
	        @endif
	      </div>
	</div> <!-- /navbar -->
