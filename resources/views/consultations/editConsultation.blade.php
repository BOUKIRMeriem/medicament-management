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
                  <i class="mdi mdi-stethoscope" alt="Icône de médecin" style="font-size: 1.7em;"></i>
                  <h3 style="margin-left: 5px;">Edition d'une consultation</h3>
              </div>
              
                  <form style="width: 80%;" method="post" action="{{ route('consultation.update', ['consultation' => $consultation->id]) }}">
                    @csrf
                    @method('PUT')
                    <div style="display: flex; flex-wrap: wrap; margin-left:80px;">
                        <div class="mb-3" style="flex: 1; margin-right: 10px;">
                            <div class="row mb-3">
                              <label for="exampleInputEmail1" class="col-sm-3 col-form-label">Patient:</label>
                              <div class="col-sm-9">
                                <select class="form-select" name="rdv_id">
                                  <option value=""></option>
                                  @php
                                  $selectedPatients = [];
                                  @endphp
                                  @foreach (App\Models\Rdv::all() as $rdv)
                                  @if (!in_array($rdv->patient->id, $selectedPatients))
                                  @php
                                  $selectedPatients[] = $rdv->patient->id;
                                  @endphp
                                  @if ($rdv->id == $consultation->rdv_id)
                                  <option value="{{ $rdv->id }}" selected>{{ $rdv->patient->nom }} {{ $rdv->patient->prenom }}</option>
                                  @else
                                  <option value="{{ $rdv->id }}">{{ $rdv->patient->nom }} {{ $rdv->patient->prenom }}</option>
                                  @endif
                                  @endif
                                  @endforeach
                                </select>
                              </div>
                              
                              
                                
                            </div>
                            
                        <div class="row mb-3">
                            <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Médecin:</label>
                            <div class="col-sm-9">
                              <select class="form-select" name="rdv_id">
                                <option value=""></option>
                                @php
                                  $selectedMedecins = [];
                                @endphp
                                @foreach (App\Models\Rdv::all() as $rdv)
                                  @if (!in_array($rdv->medecin->id, $selectedMedecins))
                                    @php
                                      $selectedMedecins[] = $rdv->medecin->id;
                                    @endphp
                                    @if ($rdv->id == $consultation->rdv_id)
                                      <option value="{{ $rdv->id }}" selected>{{ $rdv->medecin->nom }} {{ $rdv->medecin->prenom }}</option>
                                    @else
                                      <option value="{{ $rdv->id }}">{{ $rdv->medecin->nom }} {{ $rdv->medecin->prenom }}</option>
                                    @endif
                                  @endif
                                @endforeach
                              </select>
                            </div>
                            
                            </div>
                            <div class="row mb-3">
                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Date consultation:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="date_consultation" value="{{ $consultation->date_consultation }}" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Type de consultation:</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="type_consultation">
                                        @if ($consultation->type_consultation)
                                            <option value="{{ $consultation->type_consultation }}">{{ $consultation->type_consultation }}</option>
                                        @endif
                                        @unless ($consultation->type_consultation === 'consultation spécialisée')
                                            <option value="consultation spécialisée">consultation spécialisée</option>
                                        @endunless
                                        @unless ($consultation->type_consultation === 'examen')
                                            <option value="examen">examen</option>
                                        @endunless
                                        @unless ($consultation->type_consultation === 'consultation générale')
                                            <option value="consultation générale">consultation générale</option>
                                        @endunless
                                    </select>
                                    
                                    
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Diagnostic:</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="diagnostic">{{ $consultation->diagnostic }}</textarea>
                                </div>
                            </div>
                        <div style="text-align: right;">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <a href="{{ route('consultation') }}" class="btn btn-danger">Annuler</a>
                        </div>
                    </div>
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
