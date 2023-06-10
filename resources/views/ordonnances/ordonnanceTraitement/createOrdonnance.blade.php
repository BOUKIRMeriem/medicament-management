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
                  <i class="mdi mdi-file-document-outline" alt="Icône de médecin" style="font-size: 1.7em;"></i>
                  <h3 style="margin-left: 5px;">ajouter une ordonnance de traitement</h3>
              </div>

    <form style="width:90%;" method="POST"  action="{{route('ordonnance.ajouter')}}">
      @csrf
      <div style="display:flex; justify-content: space-between;">
        <div class="mb-3" style="flex: 1; margin-right: 10px;margin-left: 80px;">
          <label for="exampleInputEmail1" class="form-label">Patient:</label>
          <select class="form-select" name="consultation_id">
            <option value=""></option>
            @php
              $lastPatientId = null;
            @endphp
            @foreach ($consultations as $consultation)
              @if ($lastPatientId != $consultation->rdv->patient->id)
                <option value="{{ $consultation->id }}">{{ $consultation->rdv->patient->nom }} {{ $consultation->rdv->patient->prenom }}</option>
                @php
                  $lastPatientId = $consultation->rdv->patient->id;
                @endphp
              @endif
            @endforeach
          </select>
          
        </div>
        <div class="mb-3" style="flex: 1; margin-right: 10px;">
          <label for="exampleInputPassword1" class="form-label">Médecin:</label>
          <select class="form-select" name="consultation_id">
            <option value=""></option>
            @php
              $lastMedecinId = null;
            @endphp
            @foreach ($consultations as $consultation)
              @if ($lastMedecinId != $consultation->rdv->medecin->id)
                <option value="{{ $consultation->id }}">{{ $consultation->rdv->medecin->nom }} {{ $consultation->rdv->medecin->prenom }}</option>
                @php
                  $lastMedecinId = $consultation->rdv->medecin->id;
                @endphp
              @endif
            @endforeach
          </select>
          
        </div>
    </div>
    <div style="display: flex; flex-wrap: wrap;">
        <div class="mb-3" style="flex: 1; margin-right: 10px; margin-left: 80px;">
            <label for="exampleInputPassword1" class="form-label">Médicament:</label>
            <input type="text" class="form-control" name="medicament">
        </div>
        <div class="mb-3" style="flex: 1; margin-right: 10px;">
            <label for="exampleInputPassword1" class="form-label">Dosage:</label>
            <input type="text" class="form-control" name="dosage" >
        </div>
    </div>
     <div style="display: flex; flex-wrap: wrap; margin-left:80px;">
        <div class="mb-3" style="flex: 1; margin-right: 10px;">
          <label for="exampleInputPassword1" class="form-label">Nbr de fois par jour:</label>
          <input type="text" class="form-control" name="nbr_fois" >
        </div>
        <div class="mb-3" style="flex: 1; margin-right: 10px;">
          <label for="exampleInputPassword1" class="form-label">Quantité:</label>
          <input type="text" class="form-control" name="qte" >
        </div>
      </div>
      <div class="mb-3" style="flex: 1; margin-left:80px;">
        <label for="exampleInputPassword1" class="form-label">Date d'ordonnance:</label>
        <input type="Date" class="form-control" name="date">
      </div>
       
            <div style="text-align: right;">
              <button type="submit" class="btn btn-primary">Enregistrer</button>
              <a href="/api/ordonnance" class="btn btn-danger">Annuler</a>
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
