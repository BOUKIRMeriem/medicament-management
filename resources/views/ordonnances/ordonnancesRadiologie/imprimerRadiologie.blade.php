@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush
<style>
 label{
  font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
 }
</style>

@section('content')

<div class="my-3 p-3 bg-body rounded shadow-sm" style="width: 70%; margin: 0 auto;">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div >
        <header>
        <div style="float: left;">      
          <p style="color:#2980B9 ; "> <strong>Dr. {{ $radiologie->consultation->rdv->medecin->nom }} & {{ $radiologie->consultation->rdv->medecin->prenom }}</strong></p>
          <p>Médecin {{ $radiologie->consultation->rdv->medecin->specialite }}</p>
          <p>Tél: {{ $radiologie->consultation->rdv->medecin->telephone }}</p>
          <p>email: {{ $radiologie->consultation->rdv->medecin->email }}</p>
        </div>
        <img src="{{ url('assets/images/logo3.png') }}" alt="logo" class="img-fluid" style="float: right;" />
      </div>
    </header>

    <p style="text-align: center; color:#2980B9 "><u>  Ordonnance Médicale</u></p>
    <p style="text-align: center;">{{ $radiologie->date }}</p>
    <p><strong>Nom & Prénom :</strong> {{ $radiologie->consultation->rdv->patient->nom }} {{ $radiologie->consultation->rdv->patient->prenom }}</p>
    
    </div>
    <h5 style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;margin-bottom:30px;">faire š'il vous plaît les radiologies suivant:</h5>
    <input type="checkbox" id="radiographie">
    <label for="radiographie">Radiographie</label><br>
    
    <input type="checkbox" id="tomodensitométrie">
    <label for="tomodensitométrie">Tomodensitométrie</label><br>
    
    <input type="checkbox" id="irm">
    <label for="irm">Imagerie par résonance magnétique</label><br>
    
    <input type="checkbox" id="echographie">
    <label for="echographie">Échographie</label><br>
    
    <input type="checkbox" id="mammographie">
    <label for="mammographie">Mammographie</label><br>
    
    <input type="checkbox" id="radiographie-dentaire">
    <label for="radiographie-dentaire">Radiographie dentaire</label><br>
    
    <input type="checkbox" id="radiographie-interventionnelle">
    <label for="radiographie-interventionnelle">Radiographie interventionnelle</label><br>
    
    <input type="checkbox" id="radiologie-nucleaire">
    <label for="radiologie-nucleaire">Radiologie nucléaire</label><br>
    
    <input type="checkbox" id="radiologie-interventionnelle-vasculaire">
    <label for="radiologie-interventionnelle-vasculaire">Radiologie interventionnelle vasculaire</label><br>
    
    <input type="checkbox" id="radiologie-interventionnelle-musculosquelettique">
    <label for="radiologie-interventionnelle-musculosquelettique">Radiologie interventionnelle musculosquelettique</label><br>
    
    <input type="checkbox" id="radiologie-interventionnelle-oncologique">
    <label for="radiologie-interventionnelle-oncologique">Radiologie interventionnelle oncologique</label><br>
    
    <input type="checkbox" id="radiologie-pediatrique">
    <label for="radiologie-pediatrique">Radiologie pédiatrique</label><br>
    
    <input type="checkbox" id="radiologie-neuroradiologique">
    <label for="radiologie-neuroradiologique">Radiologie neuroradiologique</label><br>
    
    <input type="checkbox" id="radiologie-thoracique">
    <label for="radiologie-thoracique">Radiologie thoracique</label><br>
    
    <p style=" margin-left:400px;color:#2980B9 ;margin-bottom:30%;"><strong>Signature:</strong></p>
    <footer style="text-align: center;">
      <hr>
      <p><strong>Email:</strong> {{ $radiologie->consultation->rdv->medecin->email}} | <strong>Tél:</strong> {{ $radiologie->consultation->rdv->medecin->telephone }}</p>
    </footer>
    </div>
  </div>
</div>


<div style="text-align: right;">
  <a href="{{route('radiologie.pdf', ['radiologie'=>$radiologie])}}" class="btn btn-primary">Export TO PDF</a>
  <a href="{{route('radiologie')}}" class="btn btn-info">Annuler</a>
</div>
@endsection

@push('plugin-scripts')
  {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
  {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
