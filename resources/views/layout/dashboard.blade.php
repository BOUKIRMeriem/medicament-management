@extends('layout.master')
@push('plugin-styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.print.min.css" media="print" />
@endpush

<style>
    .no-underline {
      text-decoration: none;
    }
  
    .no-underline:hover {
       
    font-size: 1.5em;
 
    background-color: #F2F2F2;
    text-decoration: none;
    }



  </style>
@section('content')

  

<div class="row">
  <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 grid-margin stretch-card mx-auto">
    <a href="{{route('medecin')}}" class="no-underline">
    <div class="card card-statistics" style="width: 200px;">
        <div class="card-body" style="background-color: #1ABC9C; height: 100px;padding: 15px;">
            <div class="d-flex flex-row justify-content-between align-items-center" style="height: 100%;">
                <div class="d-flex align-items-center">
                    <i class="mdi mdi-doctor" style="color: #fff; font-size: 3em;"></i>
                    <div class="ml-3">
                      <h3 class="font-weight-medium mb-0" style="color: #fff;">{{$totalMedecins}}</h3>
                        <p class="mb-0" style="color: #fff;">Médecin</p>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
</div>

<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 grid-margin stretch-card mx-auto">   
    <a href="{{route('patient')}}" class="no-underline">
  <div class="card card-statistics" style="width: 200px;">
      <div class="card-body" style="background-color: #F1C40F; height: 100px;padding: 15px;">
        <div class="d-flex flex-row justify-content-between align-items-center" style="height: 100%;">
          <div class="d-flex align-items-center">
              <i class="mdi mdi-account-group" style="color: #fff; font-size: 3em;"></i>
              <div class="ml-3">
                <h3 class="font-weight-medium  mb-0" style="color: #fff;">{{$totalPatients}}</h3>
                  <p class="mb-0" style="color: #fff;">Patient</p>
            
              </div>
          </div>
      </div>
  </div>
</div>
</a>
 </div>

 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 grid-margin stretch-card mx-auto"> 
    <a href="/api/rdv" class="no-underline">
  <div class="card card-statistics" style="width: 200px;">
         <div class="card-body" style="background-color: #2E86C1; height: 100px;padding: 15px;">
          <div class="d-flex flex-row justify-content-between align-items-center" style="height: 100%;">
            <div class="d-flex align-items-center">
                 <i class="mdi mdi-calendar-clock" style="color: #fff; font-size: 3em;"></i>
                 <div class="ml-3">
                  <h3 class="font-weight-medium  mb-0" style="color: #fff;">{{$totalRdvs}}</h3>
                 <p class="mb-0" style="color: #fff;">Rendez-vous</p>
                 
             </div>
         </div>
     </div>
  </div>
  </div>
</a> 
 </div>
 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 grid-margin stretch-card mx-auto">
    <a href="/api/consultation" class="no-underline">  
  <div class="card card-statistics "style="width: 200px;">
         <div class="card-body" style="background-color: #DC7633; height: 100px;padding: 15px;">
          <div class="d-flex flex-row justify-content-between align-items-center" style="height: 100%;">
            <div class="d-flex align-items-center">
                 <i class="mdi mdi-stethoscope" style="color: #fff; font-size: 3em;"></i>
                 <div class="ml-3">
                  <h3 class="font-weight-medium  mb-0" style="color: #fff;">{{$totalConsultations}}</h3>
                 <p class="mb-0 " style="color: #fff;">Consultation</p>
                 
             </div>
         </div>
     </div>
  </div>
  </div>
</a>
 </div>
 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 grid-margin stretch-card mx-auto">  
    <a href="/api/ordonnance" class="no-underline">
    <div class="card card-statistics" style="width: 200px;">
         <div class="card-body" style="background-color: #9B59B6; height: 100px;padding: 15px;">
          <div class="d-flex flex-row justify-content-between align-items-center" style="height: 100%;">
            <div class="d-flex align-items-center">
                 <i class="mdi mdi-file-document-outline" style="color: #fff; font-size: 3em;"></i>
                 <div class="ml-3">
                  <h3 class="font-weight-medium  mb-0" style="color: #fff">{{$totalOrdonnances}}</h3>
                 <p class="mb-0 " style="color: #fff;">Ordonnance</p>
                
             </div>
         </div>
     </div>
  </div>
 </div>
</a>
</div>




  <div class="row">
      <div class="my-3 p-2 bg-body rounded shadow-sm" style="width: 530px; height: 300px;float: left; margin-right:25px; margin-left:30px;">
          <div style="width: 500px;">
            <h6 style="color:#A6ACAF; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Répartition des patients par groupe d'âge :</h6>
              <canvas id="ageChart"></canvas>
          </div>
      </div>
  
      <div class="my-3 p-2 bg-body rounded shadow-sm" style="width: 460px; height: 300px; float:right;">
          <div style="width: 360px;">
            <h6 style="color:#A6ACAF; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Statistiques des rendez-vous quotidiens :</h6>
            <canvas id="appointmentsChart"></canvas>
            <h6 style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;color:#C0392B;">Statistiques sur les rendez-vous passés:</h6>
            <ul>
                <li style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Nombre moyen de rendez-vous par jour : <span id="averageAppointmentsPerDay"></span></li>
                <li style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Durée moyenne des rendez-vous : <span id="averageDuration"></span> minutes</li>
            </ul>
          </div>
      </div>
  </div> 
</div>

<div class="row">
  <div class="my-3 p-2 bg-body rounded shadow-sm" style="width: 470px; margin-right:25px; margin-left:30px;">
      <h6 style="color:#A6ACAF; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Les demandes de rendez-vous:</h6>
      <div class="pagination">
          {{ $demandes->links() }}
      </div>
      <div class="table-responsive" style="overflow-y: auto; max-height: 400px;">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Statut</th>
                    <th>Médecin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @isset($demandes)
                @php
                    $urgentDemandes = $demandes->where('statut', 'urgent');
                    $normalDemandes = $demandes->where('statut', '!=', 'urgent');
                @endphp
                
                @if(count($urgentDemandes) > 0)
                    @foreach ($urgentDemandes as $demande)
                        <tr>
                            <td>{{ $demande->date }}</td>
                            <td>{{ $demande->heure }}</td>
                            <td style="color: red;">{{ $demande->statut }}</td>
                            <td>{{ $demande->medecin->nom }} {{ $demande->medecin->prenom }}</td>
                            <td>
                                <a href="{{ route('validerDemande', $demande->id) }}" class="fas fa-check-circle"></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
        
                @if(count($normalDemandes) > 0)
                    @foreach ($normalDemandes as $demande)
                        <tr>
                            <td>{{ $demande->date }}</td>
                            <td>{{ $demande->heure }}</td>
                            <td>{{ $demande->statut }}</td>
                            <td>{{ $demande->medecin->nom }} {{ $demande->medecin->prenom }}</td>
                            <td>
                                <a href="{{ route('validerDemande', $demande->id) }}" class="fas fa-check-circle"></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">Aucune demande de rendez-vous trouvée.</td>
                    </tr>
                @endif
                @endisset
            </tbody>
        </table>
        
        
      </div>
  </div>



  <div class="my-3 p-2 bg-body rounded shadow-sm" style="width: 530px; height: 330px; overflow: auto;">
   
      <h6 style="color:#A6ACAF; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Le calendrier des rendez-vous</h6>
      
      <div id='calendar' style="width: 550px;"></div>  
  
  </div>
 </div>

  



  @push('custom-scripts')
  <script>
    $(document).ready(function() {
      $('#calendar').fullCalendar({
        events: '{{ route("calendar") }}',
        eventTitleFormat: {
          month: 'short',
          day: 'numeric',
          year: 'numeric',
          separator: ' - '
        },
       
      });
    });
  </script>
  
@endpush


 

<script>
  document.addEventListener('DOMContentLoaded', function() {
      fetch('/age-chart')
          .then(response => response.json())
          .then(ageData => {
              const ageGroups = ['0-11', '12-17', '18-29', '30-49', '50-59', '60+']; // Groupes d'âge

              const ctx = document.getElementById('ageChart').getContext('2d');
              new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels: ageGroups,
                      datasets: [{
                          label: 'Nombre de patients',
                          data: ageData,
                          backgroundColor: '#9A7D0A',
                          borderColor: '#CA6F1E ',
                          borderWidth: 1
                      }]
                  },
                  options: {
                      scales: {
                          y: {
                              beginAtZero: true,
                              stepSize: 1
                          }
                      }
                  }
              });
          });
  });
</script>




<script>
  document.addEventListener('DOMContentLoaded', function() {
      fetch('/appointments-chart')
          .then(response => response.json())
          .then(appointmentData => {
              const ctx = document.getElementById('appointmentsChart').getContext('2d');
              new Chart(ctx, {
                  type: 'pie',
                  data: {
                      labels: appointmentData.labels,
                      datasets: [{
                          label: 'Nombre de rendez-vous',
                          data: appointmentData.data,
                          backgroundColor: [
                              'rgba(75, 192, 192, 0.2)',
                              'rgba(192, 75, 192, 0.2)',
                              'rgba(192, 192, 75, 0.2)',
                              'rgba(75, 75, 192, 0.2)',
                              'rgba(192, 75, 75, 0.2)',
                              'rgba(75, 192, 75, 0.2)',
                              'rgba(192, 192, 192, 0.2)'
                          ],
                          borderColor: [
                              'rgba(75, 192, 192, 1)',
                              'rgba(192, 75, 192, 1)',
                              'rgba(192, 192, 75, 1)',
                              'rgba(75, 75, 192, 1)',
                              'rgba(192, 75, 75, 1)',
                              'rgba(75, 192, 75, 1)',
                              'rgba(192, 192, 192, 1)'
                          ],
                          borderWidth: 1
                      }]
                  },
                  options: {
                      scales: {
                          y: {
                              beginAtZero: true,
                              precision: 0
                          }
                      }
                  }
              });

              // Afficher les statistiques
              document.getElementById('averageAppointmentsPerDay').textContent = (appointmentData.data.reduce((a, b) => a + b, 0) / appointmentData.labels.length).toFixed(2);
              document.getElementById('averageDuration').textContent = appointmentData.averageDuration.toFixed(2);
             
          });
  });
</script>

 



@endsection

@push('plugin-scripts')
  {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
  {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
  
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>

@endpush
@push('custom-scripts')
  {!! Html::script('/assets/js/dashboard.js') !!}
@endpush
