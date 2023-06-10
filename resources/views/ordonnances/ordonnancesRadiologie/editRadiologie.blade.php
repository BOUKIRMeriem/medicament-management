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
                  <h3 style="margin-left: 5px;">édition une ordonnance radiologie</h3>
              </div>
              <div class="mt-4">
                  
                <form style="width: 80%;" method="POST" action="{{route('radiologie.update',['radiologie'=>$radiologie->id])}}">
                    @csrf
                    @method('PUT')
                  
                    <div class="mb-3" style="flex: 1; margin-left: 80px;">
                      <label for="exampleInputEmail1" class="form-label">Patient:</label>
                      <select class="form-select" name="consultation_id">
                        <option value=""></option>
                        @php
                        $selectedPatients = [];
                        @endphp
                        @foreach (App\Models\Consultation::all() as $consultation)
                        @if (!in_array($consultation->rdv->patient->id, $selectedPatients))
                        @php
                        $selectedPatients[] = $consultation->rdv->patient->id;
                        @endphp
                        @if ($consultation->id == $radiologie->consultation_id)
                        <option value="{{ $consultation->id }}" selected>{{ $consultation->rdv->patient->nom }} {{ $consultation->rdv->patient->prenom }}</option>
                        @else
                        <option value="{{ $consultation->id }}">{{ $consultation->rdv->patient->nom }} {{ $consultation->rdv->patient->prenom }}</option>
                        @endif
                        @endif
                        @endforeach
                      </select>
                    </div>
                  
                    <div class="mb-3" style="flex: 1; margin-left: 80px;">
                      <label for="exampleInputEmail1" class="form-label" style="white-space: nowrap;">Médecin:</label>
                      <select class="form-select" name="medecin_id">
                        <option value=""></option>
                        @php
                        $selectedMedecins = [];
                        @endphp
                        @foreach (App\Models\Consultation::all() as $consultation)
                        @if (!in_array($consultation->rdv->medecin->id, $selectedMedecins))
                        @php
                        $selectedMedecins[] = $consultation->rdv->medecin->id;
                        @endphp
                        @if ($consultation->id == $radiologie->consultation_id)
                        <option value="{{ $consultation->id }}" selected>{{ $consultation->rdv->medecin->nom }} {{ $consultation->rdv->medecin->prenom }}</option>
                        @else
                        <option value="{{ $consultation->id }}">{{ $consultation->rdv->medecin->nom }} {{ $consultation->rdv->medecin->prenom }}</option>
                        @endif
                        @endif
                        @endforeach
                      </select>
                    </div>
                  
                    <div class="mb-3" style="flex: 1; margin-left: 80px;">
                      <label for="exampleInputPassword1" class="form-label">Date d'ordonnance:</label>
                      <input type="date" class="form-control" name="date" value="{{ $radiologie->date }}">
                    </div>
                  
                    <div class="mb-3" style="flex: 1; margin-left: 80px;">
                      <label for="exampleInputPassword1" class="form-label">Spécial instructions:</label>
                      <input type="text" class="form-control" name="special_instructions" value="{{ $radiologie->special_instructions }}">
                    </div>
                  
                    <div style="text-align: right;">
                      <button type="submit" class="btn btn-primary">Enregistrer</button>
                      <a href="{{ route('radiologie') }}" class="btn btn-danger">Annuler</a>
                    </div>
                  </form>
                  
                </div>

@endsection
@push('plugin-scripts')
  {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
  {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
  {!! Html::script('/assets/js/dashboard.js') !!}
@endpush