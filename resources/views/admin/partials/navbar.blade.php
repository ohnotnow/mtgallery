	<div class="navbar navbar-default navbar-static-top" role="navigation">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="{!! route('admin.dashboard') !!}">Monkeytwizzle</a>
	        </div>
            @if (Auth::check())
		        <div class="navbar-collapse collapse">
		          <ul class="nav navbar-nav">
		          	<li><a href="{!! route('admin.dashboard') !!}">Galleries</a></li>
		          	<li><a href="{!! route('admin.index_photos') !!}">Photographs</a></li>
		          	<li><a href="{!! route('admin.index_blogs') !!}">Blogs</a></li>
 		          </ul>
			        <ul class="nav navbar-nav navbar-right">
			            <li><a href="{{ url('/auth/logout') }}">Log Out</a></li>
		          	</ul>
		        </div><!--/.nav-collapse -->
	        @endif
	      </div>
	</div> <!-- /navbar -->
