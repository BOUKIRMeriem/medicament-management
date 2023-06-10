@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')

<div class="container-fluid">
  <div class="my-3 p-3 bg-body rounded shadow-sm">
    
           
              <br>
              <div style="display: flex; flex-wrap: wrap; margin-left:80px;">
                <div class="mb-3" style="flex: 1;">
                    <label for="exampleInputEmail1" class="form-label"><strong>Patient:</strong></label>
                    <label>{{ $consultation->rdv->patient->nom }} {{ $consultation->rdv->patient->prenom }}</label>
                </div>
                <div class="mb-3" style="flex: 1; margin-left: 0px;">
                    <label for="exampleInputPassword1" class="form-label"><strong>Medecin:</strong></label>
                    <label>{{ $consultation->rdv->medecin->nom }} {{ $consultation->rdv->medecin->prenom }}</label>
                </div>
            </div>
            <div style="display: flex; flex-wrap: wrap;margin-left:80px;">
               <div class="mb-3" style="flex: 1;">
                 <label for="exampleInputPassword1" class="form-label"><strong>Date consultation:</strong></label>
                 <label>{{ $consultation->date_consultation }}</label>
               </div>
               <div class="mb-3" style="flex: 1;  margin-left: 0px;">
                  <label for="exampleInputPassword1"  class="form-label"><strong>Type consultation:</strong></label>
                  <label>{{ $consultation->type_consultation }}</label>
               </div>
            </div>
            <div style="display: flex; flex-wrap: wrap;margin-left:80px;">
               <div class="mb-3" style="flex: 1;">
                 <label for="exampleInputPassword1" class="form-label"><strong>Diagnostic:</strong></label>
                 <label>{{ $consultation->diagnostic}}</label>
               </div>
              
            </div>
            
        </div>     
      </div> 
  <div style="text-align: right;">
     <a href="{{ route('consultation') }}" class="btn btn-success">Annuler</a>
  </div>
@endsection
@push('plugin-scripts')
  {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
  {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
  {!! Html::script('/assets/js/dashboard.js') !!}
@endpush