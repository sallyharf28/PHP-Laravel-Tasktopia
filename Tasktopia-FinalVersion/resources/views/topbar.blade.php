<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-primary navbar-dark ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      @if(isset(auth()->user()->id))
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
      </li>
    @endif 
      <li>
        <a class="nav-link text-white"  href="./" role="button"> <large><b>{{ config('system-settings.name') }}</b></large></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
     
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
     <li class="nav-item dropdown">
            <a class="nav-link"  data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
              <span>
                <div class="d-felx badge-pill">
                  <span class="fa fa-user mr-2"></span>
                  <span><b>{{ ucwords(auth()->user()->firstname) }}</b></span>
                  <span class="fa fa-angle-down ml-2"></span>
                </div>
              </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
              <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a>
            </div>
      </li>
    </ul>
  </nav>
