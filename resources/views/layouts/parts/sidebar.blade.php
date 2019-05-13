<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="
        @if (auth()->user()->photo == null)
          {{ auth()->user()->avatar }}
        @else
          {{ Storage::url(auth()->user()->photo) }}
        @endif" 
        class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ auth()->user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="{{ Request::is('home') || Request::is('home/*') ? 'active' : '' }}">
        <a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
      </li>

      <li class="treeview {{ Request::is('categories') || Request::is('categories/*') || Request::is('products') || Request::is('products/*') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-coffee"></i> <span>Products</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('categories') || Request::is('categories/*') ? 'active' : '' }}">
            <a href="{{ route('categories.index') }}"><i class="fa fa-circle-o"></i> Categories</a>
          </li>
          <li class="{{ Request::is('products') || Request::is('products/*') ? 'active' : '' }}">
            <a href="{{ route('products.index') }}"><i class="fa fa-circle-o"></i> Items</a>
          </li>
        </ul>
      </li>

      <li class="{{ Request::is('orders') || Request::is('orders/*') ? 'active' : '' }}">
        <a href="{{ route('orders.index') }}"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a>
      </li>

      <li class="header">SETTING MENU</li>

      <li class="{{ Request::is('reports') || Request::is('reports/*') ? 'active' : '' }}">
        <a href="{{ route('reports.index') }}"><i class="fa fa-file-text"></i> <span>Company Report</span></a>
      </li>

      <li class="{{ Request::is('users') || Request::is('users/*') ? 'active' : '' }}">
        <a href="{{ route('users.index') }}"><i class="fa fa-users"></i> <span>Users</span></a>
      </li>

      <li class="{{ Request::is('payments') || Request::is('payments/*') ? 'active' : '' }}">
        <a href="{{ route('payments.index') }}"><i class="fa fa-cc-visa"></i> <span>Payments</span></a>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>