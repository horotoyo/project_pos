<header class="main-header">
  <!-- Logo -->
  <a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>D</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>De</b>Latte<small>.com</small></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="
            @if (empty(auth()->user()->photo))
              {{ auth()->user()->avatar }}
            @else
              {{ Storage::url(auth()->user()->photo) }}
            @endif
            " class="user-image" alt="User Image">
            <span class="hidden-xs">{{ auth()->user()->name }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="
              @if (empty(auth()->user()->photo))
                {{ auth()->user()->avatar }}
              @else
                {{ Storage::url(auth()->user()->photo) }}
              @endif
              " class="img-circle" alt="User Image">

              <p>
                {{ auth()->user()->name }}
                <small>Member since {{ auth()->user()->created_at->format('d M Y') }}</small>
              </p>
            </li>
            <!-- Menu Body -->
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <form action="{{ route('logout') }}" method="post">
                  @csrf
                  <button type="submit" class="btn btn-default btn-flat">Sign out</button>
                </form>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        {{-- <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li> --}}
      </ul>
    </div>
  </nav>
</header>