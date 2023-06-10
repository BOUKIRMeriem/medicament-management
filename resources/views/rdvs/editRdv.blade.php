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
                  <i class="mdi mdi-doctor" alt="Icône de médecin" style="font-size: 1.7em;"></i>
                  <h3 style="margin-left: 5px;">Edition un rendez-vous</h3>
              </div>
              @if($errors->has('msg'))
              <div class="alert alert-danger">
                  {{ $errors->first('msg') }}
              </div>
          @endif
          

                <form style="width:80%;" method="post"  action="{{route('rdv.update',['rdv'=>$rdv->id])}}">
                      @csrf
                      @method('PUT')
                      <div style="display:flex; justify-content: space-between;">
                        <div class="mb-3" style="flex: 1; margin-right: 10px;margin-left: 80px;">
                          <label for="exampleInputEmail1" class="form-label">Patient:</label>
                          <select class="form-select" name="patient_id">
                            <option value=""></option>
                            @foreach (App\Models\Patient::all() as $patient)
                              @if($rdv->patient_id == $patient->id)
                                <option value="{{ $patient->id }}" selected>{{ $patient->nom }} {{ $patient->prenom }}</option>
                              @else  
                                <option value="{{ $patient->id }}">{{ $patient->nom }} {{ $patient->prenom }}</option>
                              @endif 
                            @endforeach
                          </select>
                         
                      </div>
                      <div class="mb-3" style="flex: 1; margin-right: 10px;">
                        <label for="exampleInputEmail1" class="form-label">Medecin:</label>
                        <select class="form-select" name="medecin_id">
                          <option value=""></option>
                          @foreach (App\Models\Medecin::all() as $medecin)
                            @if($rdv->medecin_id == $medecin->id)
                              <option value="{{ $medecin->id }}" selected>{{ $medecin->nom }} {{ $medecin->prenom }}</option>
                            @else  
                              <option value="{{ $medecin->id }}">{{ $medecin->nom }} {{ $medecin->prenom }}</option>
                            @endif 
                          @endforeach
                        </select>
                       
                    </div>
                  </div>
                    <div style="display: flex; flex-wrap: wrap; margin-left:80px;">
                           <div class="mb-3" style="flex: 1; margin-right: 10px;">
                              <label for="exampleInputPassword1" class="form-label">Heure:</label>
                              <input type="time" class="form-control" name="heure" value="{{$rdv->heure}}" >
                            </div>
                            <div class="mb-3" style="flex: 1; margin-right: 10px;">
                                <label for="exampleInputPassword1" class="form-label">Date:</label>
                                <input type="Date" class="form-control" name="date" value="{{$rdv->date}}" >
                            </div>
                    </div>
                    <div style="display: flex; flex-wrap: wrap; margin-left:80px;">
                      <div class="mb-3" style="flex: 1; margin-right: 10px;">
                          <label for="exampleInputPassword1"  class="form-label">Durée:</label>
                          <input type="text" class="form-control" name="duree" value="{{ $rdv->duree }}" >
                         </div>
                         <div class="mb-3" style="flex: 1; margin-right: 10px;">
                        <label for="exampleInputPassword1"  class="form-label">Commentaire:</label>
                        <input type="text" class="form-control" name="commentaire" value="{{ $rdv->commentaire }}" >
                       </div>
                      </div>
                      <div style="text-align: right;">
                          <button type="submit" class="btn btn-primary">Enregistrer</button>
                          <a href="/api/rdv" class="btn btn-danger">Annuler</a>
                        
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