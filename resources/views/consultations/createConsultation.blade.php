@extends('layout.master')

@section('content')

<div class="container-fluid">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="my-3 p-3 bg-body rounded shadow-sm" style="width:100%;">
              <div style="display: flex; align-items: center;">
                  <i class="mdi mdi-stethoscope" alt="Icône de médecin" style="font-size: 1.7em;"></i>
                  <h3 style="margin-left: 5px;">Ajouter une consultation</h3>
              </div>
              
          <form method="POST" action="{{ route('consultation.ajouter') }}" style="width:90%;">
            @csrf
            <div style="display: flex; flex-wrap: wrap; margin-left:80px;">
            <div class="mb-3" style="flex: 1; margin-right: 10px;">
            <div class="row mb-3">
              <label for="patient" class="col-sm-3 col-form-label">Patient:</label>
                <div class="col-sm-9">
                  <select class="form-select" name="rdv_id">
                    <option value=""></option>
                     @php
                        $lastPatient = null;
                      @endphp
                      @foreach ($rdvs as $rdv)
                     @if ($lastPatient != $rdv->patient->nom)
                         <option value="{{ $rdv->id }}">{{ $rdv->patient->nom }} {{ $rdv->patient->prenom }}</option>
                      @php
                        $lastPatient = $rdv->patient->nom;
                     @endphp
                     @endif
                    @endforeach
                   </select>
                 </div>
              </div>
            <div class="row mb-3">
              <label for="medecin" class="col-sm-3 col-form-label">Médecin:</label>
              <div class="col-sm-9">
                <select class="form-select" name="rdv_id">
                  <option value=""></option>
                  @php
                    $lastMedecin = null;
                  @endphp
                  @foreach ($rdvs as $rdv)
                    @if ($lastMedecin != $rdv->medecin->nom)
                      <option value="{{ $rdv->id }}">{{ $rdv->medecin->nom }} {{ $rdv->medecin->prenom }}</option>
                      @php
                        $lastMedecin = $rdv->medecin->nom;
                      @endphp
                    @endif
                  @endforeach
                </select>
              </div>
              
            <div class="row mb-3">
              <label for="date" class="col-sm-3 col-form-label">Date:</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" id="date_consultation" name="date_consultation">
              </div>
            </div>
            <div class="row mb-3">
              <label for="text" class="col-sm-3 col-form-label">Type :</label>
              <div class="col-sm-9">
                <select class="form-select" name="type_consultation">
                       <option value=""></option>
                       <option value="consultation spécialisée">consultation spécialisée</option>
                       <option value="examen">examen</option>
                       <option value="consultation générale">consultation générale	</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label for="notes" class="col-sm-3 col-form-label">Diagnostic:</label>
              <div class="col-sm-9">
                <textarea class="form-control" id="diagnostic" name="diagnostic" rows="3"></textarea>
              </div>
            </div>
            <div style="text-align: right;">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{route('consultation')}}" class="btn btn-danger">Annuler</a>
            </div>
          </form>
        </div>
      </div>
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
