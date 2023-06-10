<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
    <ul class="nav">
      
      <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">
          <i class="menu-icon mdi mdi-television"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
  
      <li class="nav-item ">
        <a class="nav-link"  href="{{route('medecin')}}">
          <i class="menu-icon mdi mdi-doctor"></i>
          <span class="menu-title">Médecins</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('patient')}}">
          <i class="menu-icon mdi mdi-account-group"></i>
          <span class="menu-title">Patient</span>
        </a>
      </li>
  
      <li class="nav-item ">
        <a class="nav-link" href="/api/rdv">
          <i class="menu-icon mdi mdi-calendar-clock"></i>
          <span class="menu-title">Rendez-vous</span>
        </a>
      </li>
  
      <li class="nav-item ">
        <a class="nav-link" href="/api/consultation">
          <i class="menu-icon mdi mdi-stethoscope"></i>
          <span class="menu-title">Consultation</span>
        </a>
      </li>
  
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ordonnance-interfaces">
          <i class="menu-icon mdi mdi-file-document-outline"></i>
          <span class="menu-title">Ordonnances</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ordonnance-interfaces">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item ">
              <a class="nav-link" href="/api/ordonnance">Ordonnance de traitement</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{route('radiologie')}}">Ordonnance de Radiologie</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('analyse')}}">Ordonnance d'Analyses médicales</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('user')}}">
          <i class="menu-icon mdi mdi-account"></i>

            <span class="menu-title">User</span>
        </a>
    </li>
  
      <li class="nav-item ">
        <a class="nav-link"  href="/login">
          <i class="menu-icon mdi mdi-logout"></i>
          <span class="menu-title">Déconnexion</span>
        </a>
      </li>
    
      
    </ul>
  </nav>