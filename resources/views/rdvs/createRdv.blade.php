@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="my-3 p-3 bg-body rounded shadow-sm" style="width:100%;">
              <div style="display: flex; align-items: center;">
                  <i class="mdi mdi-calendar-clock" alt="Icône de médecin" style="font-size: 1.7em;"></i>
                  <h3 style="margin-left: 5px;">Ajouter un rendez-vous</h3>
              </div>
              @if($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          
            
    <form style="width:90%;" method="POST"  action="{{route('rdv.ajouter')}}">
      @csrf
      <div style="display:flex; justify-content: space-between;">
        <div class="mb-3" style="flex: 1; margin-right: 10px;margin-left: 80px;">
              <label for="exampleInputEmail1" class="form-label">Patient:</label>
              <select class="form-select" name="patient_id">
                  <option value=""></option>
                  @foreach ($patients as $patient)
                  <option value="{{$patient->id}}">{{$patient->nom}}{{$patient->prenom}}</option>
                  @endforeach
              </select>
          </div>
          <div class="mb-3" style="flex: 1; margin-right: 10px;">
            <label for="exampleInputEmail1" class="form-label">Médecin:</label>
            <select class="form-select" name="medecin_id">
              <option value=""></option>
              @foreach ($medecins as $medecin)
                  <option value="{{$medecin->id}}">{{$medecin->nom}}{{$medecin->prenom}}</option>
              @endforeach
          </select>
        </div>
      </div>
      <div style="display: flex; flex-wrap: wrap;">
        <div class="mb-3" style="flex: 1; margin-right: 10px; margin-left: 80px;">
            <label for="exampleInputPassword1" class="form-label">Date:</label>
            <input type="date" class="form-control" name="date">
        </div>
        <div class="mb-3" style="flex: 1; margin-right: 10px;">
            <label for="exampleInputPassword1" class="form-label">Heure:</label>
            <input type="time" class="form-control" name="heure">
        </div>
    </div>
    
    <div style="display: flex; flex-wrap: wrap;">
      <div class="mb-3" style="flex: 1; margin-right: 10px; margin-left: 80px;">
          <label for="exampleInputPassword1" class="form-label">Durée:</label>
          <input type="text" class="form-control" name="duree">
      </div>
      <div class="mb-3" style="flex: 1; margin-right: 10px;">
          <label for="exampleInputPassword1" class="form-label">Commentaire:</label>
          <input type="text" class="form-control" name="commentaire">
      </div>
  </div>
  
           <div style="text-align: right;">
              <button type="submit" class="btn btn-primary">Enregistrer</button>
              <a href="/api/rdv" class="btn btn-danger">Annuler</a>
            </div>
    </form>
 </div>
  </div>
@endsection
@push('plugin-scripts')
  {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
  {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush
@push('custom-scripts')
  {!! Html::script('/assets/js/dashboard.js') !!}
@endpush
