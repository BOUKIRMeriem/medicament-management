@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
     
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div style="display: flex; align-items: center; background-color: #17A589;">
                <i class="mdi mdi-doctor" alt="Icône de médecin" style="font-size: 1.7em;"></i>
                <h4 style="margin-left: 5px; color: white;">MEDECIN</h4>
              </div><br>
          <div style="display: flex; flex-wrap: wrap; margin-left:80px;">
            <div class="mb-3" style="flex: 1; margin-right: 10px;">
              <label for="exampleInputEmail1" class="form-label">Nom:</label>
              <label>{{ $medecin->nom }}</label>
            </div>
            <div class="mb-3" style="flex: 1; margin-left:80px;">
              <label for="exampleInputPassword1" class="form-label">Prenom:</label>
              <label>{{ $medecin->prenom }}</label>
            </div>
          </div>
          <div style="display: flex; flex-wrap: wrap;margin-left:80px;">
            <div class="mb-3" style="flex: 1; margin-right: 10px;">
              <label for="exampleInputPassword1" class="form-label">email:</label>
              <label>{{ $medecin->email }}</label>
            </div>
            <div class="mb-3" style="flex: 1; margin-left:80px;">
              <label for="exampleInputPassword1"  class="form-label">Téléphone:</label>
              <label>{{ $medecin->telephone }}</label>
            </div>
            </div>
            <div class="mb-3" style="flex: 1; margin-left:80px;">
              <label for="exampleInputPassword1" class="form-label">Specialite:</label>
              <label>{{ $medecin->specialite}}</label>
            </div>
          </div>
        </div>     
      </div> 
  <div style="text-align: right;">
</div>
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div style="display: flex; align-items: center; background-color: #17A589;">
        <i class="mdi mdi-stethoscope" alt="Icône de médecin" style="font-size: 1.7em;"></i>
            <h4 style="margin-left: 5px; color: white;">Historique de consultation</h4>
    </div><br>

        <table class="table table-bordered">
          <thead>
             <tr>
                <th>Patient</th>
                <th>Date de consultation</th>
                <th>Type de consultation</th>
                <th>Diagnostic</th>
            </tr>
         </thead>
         <tbody>
          @if($consultations->count() > 0)
              @foreach ($consultations as $consultation)
                  <tr>
                      <td>{{ $consultation->rdv->patient->nom }} {{ $consultation->rdv->patient->prenom }}</td>
                      <td>{{ $consultation->date_consultation }}</td>
                      <td>{{ $consultation->type_consultation }}</td>
                      <td>{{ $consultation->diagnostic }}</td>
                  </tr>
              @endforeach
          @else
              <tr>
                  <td colspan="4"><h6>Aucune consultation trouvée.</h6></td>
              </tr>
          @endif
      </tbody>
      
       </table>
    

</div>
<div style="text-align: right;">
<a href="{{ route('medecin') }}" class="btn btn-success" style=" align-items: center; background-color: #17A589;">Annuler</a>

</div>

@endsection
@push('plugin-scripts')
  {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
  {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
  {!! Html::script('/assets/js/dashboard.js') !!}
@endpush