@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')

<div class="container-fluid">
  <div class="my-3 p-3 bg-body rounded shadow-sm">
    
            <div style="display: flex; align-items: center;"> 
                <i class="mdi mdi-account" alt="Icône de médecin" style="font-size: 1.7em;"></i>
                <h4 style="margin-left: 5px;">{{ $patient->nom }} {{ $patient->prenom }}</h4>
            </div>
        
              <br>
              <div style="display: flex; flex-wrap: wrap; margin-left:80px;">
                <div class="mb-3" style="flex: 1;">
                    <label for="exampleInputEmail1" class="form-label"><strong>CIN:</strong></label>
                    <label>{{ $patient->cin }}</label>
                </div>
                <div class="mb-3" style="flex: 1; margin-left: 0px;">
                    <label for="exampleInputPassword1" class="form-label"><strong>Adresse:</strong></label>
                    <label>{{ $patient->adresse }}</label>
                </div>
            </div>
            <div style="display: flex; flex-wrap: wrap;margin-left:80px;">
               <div class="mb-3" style="flex: 1;">
                 <label for="exampleInputPassword1" class="form-label"><strong>Nom:</strong></label>
                 <label>{{ $patient->nom }}</label>
               </div>
               <div class="mb-3" style="flex: 1;  margin-left: 0px;">
                  <label for="exampleInputPassword1"  class="form-label"><strong>Date naissance:</strong></label>
                  <label>{{ $patient->date_Naissance }}</label>
               </div>
            </div>
            <div style="display: flex; flex-wrap: wrap;margin-left:80px;">
               <div class="mb-3" style="flex: 1;">
                 <label for="exampleInputPassword1" class="form-label"><strong>Prénome:</strong></label>
                 <label>{{ $patient->prenom }}</label>
               </div>
               <div class="mb-3" style="flex: 1; margin-left: 0px;">
                 <label for="exampleInputPassword1"  class="form-label"><strong>Téléphone:</strong></label>
                 <label>{{ $patient->telephone }}</label>
               </div>
            </div>
            <div style="display: flex; flex-wrap: wrap;margin-left:80px;">
               <div class="mb-3" style="flex: 1;">
                 <label for="exampleInputPassword1" class="form-label"><strong>Sexe:</strong></label>
                 <label>{{ $patient->sexe }}</label>
                </div>
                <div class="mb-3" style="flex: 1;  margin-left: 0px;">
                 <label for="exampleInputPassword1" class="form-label"><strong>Adresse email:</strong></label>
                 <label>{{ $patient->adresse_Email}}</label>
                </div>
            </div>
            <div style="display: flex; flex-wrap: wrap;margin-left:80px;">
              <div class="mb-3" style="flex: 1;">
                <label for="exampleInputPassword1" class="form-label"><strong>Mutuelle:</strong></label>
                <label>{{ $patient->mutuelle }}</label>
               </div>
            </div>
        </div>     
      </div> 
  <div style="text-align: right;">
     <a href="{{ route('patient') }}" class="btn btn-success">Annuler</a>
  </div>
@endsection
@push('plugin-scripts')
  {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
  {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
  {!! Html::script('/assets/js/dashboard.js') !!}
@endpush