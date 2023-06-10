<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
      <a class="navbar-brand brand-logo" href="#">
        <img src="{{ url('assets/images/logo.png') }}" alt="logo" /> </a>
      <a class="navbar-brand brand-logo-mini" href="#">
        <img src="{{ url('assets/images/logo2.png') }}" alt="logo" /> </a>
    </div>
    
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
      </button>
      
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item">
          <h6 style="margin-right: 20px; margin-top: 10px;">{{ $request->id }}</h6>

      

          <img class="img-xs rounded-circle" src="{{ url('assets/images/administrateur.jpg') }}" alt="Profile image">
        </li>
      </ul>
      
    </div>
  </nav>
  