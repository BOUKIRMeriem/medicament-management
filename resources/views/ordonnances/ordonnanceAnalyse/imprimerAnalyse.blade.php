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
          <p style="color:#2980B9 ; "> <strong>Dr. {{ $analyse->consultation->rdv->medecin->nom }} & {{ $analyse->consultation->rdv->medecin->prenom }}</strong></p>
          <p>Médecin {{ $analyse->consultation->rdv->medecin->specialite }}</p>
          <p>Tél: {{ $analyse->consultation->rdv->medecin->telephone }}</p>
          <p>email: {{ $analyse->consultation->rdv->medecin->email }}</p>
        </div>
        <img src="{{ url('assets/images/logo3.png') }}" alt="logo" class="img-fluid" style="float: right;" />
      </div>
    </header>

    <p style="text-align: center; color:#2980B9 "><u>  Ordonnance Médicale</u></p>
    <p style="text-align: center;">{{ $analyse->date }}</p>
    <p><strong>Nom & Prénom :</strong> {{ $analyse->consultation->rdv->patient->nom }} {{ $analyse->consultation->rdv->patient->prenom }}</p>
    
    </div>
    <h5 style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;margin-bottom:30px;">faire š'il vous plaît les analyses suivant:</h5>
    <input type="checkbox" id="radiographie">
    <label for="radiographie">Numération formule sanguine</label><br>
    
    <input type="checkbox" id="tomodensitométrie">
    <label for="tomodensitométrie">Profil lipidique</label><br>
    
    <input type="checkbox" id="irm">
    <label for="irm">Glycémie à jeun</label><br>
    
    <input type="checkbox" id="echographie">
    <label for="echographie">Test de la fonction thyroïdienne</label><br>
    
    <input type="checkbox" id="mammographie">
    <label for="mammographie">Test de la fonction rénale</label><br>
    
    <input type="checkbox" id="radiographie-dentaire">
    <label for="radiographie-dentaire">Électrolytes sériques</label><br>
    
    <input type="checkbox" id="radiographie-interventionnelle">
    <label for="radiographie-interventionnelle">Analyse d'urine</label><br>
    
    <input type="checkbox" id="radiologie-nucleaire">
    <label for="radiologie-nucleaire">Test hépatique</label><br>
    
    <input type="checkbox" id="radiologie-interventionnelle-vasculaire">
    <label for="radiologie-interventionnelle-vasculaire">Analyse des gaz du sang</label><br>
    
    <input type="checkbox" id="radiologie-interventionnelle-musculosquelettique">
    <label for="radiologie-interventionnelle-musculosquelettique">Test de dépistage des maladies sexuellement transmissibles </label><br><br><br>
    
 
    
    <p style=" margin-left:400px;color:#2980B9 ;margin-bottom:30%;"><strong>Signature:</strong></p>
    <footer style="text-align: center;">
      <hr>
      <p><strong>Email:</strong> {{ $analyse->consultation->rdv->medecin->email}} | <strong>Tél:</strong> {{ $analyse->consultation->rdv->medecin->telephone }}</p>
    </footer>
    </div>
  </div>
</div>


<div style="text-align: right;">
  <a href="{{route('analyse.pdf', ['analyse'=>$analyse])}}" class="btn btn-primary">Export TO PDF</a>
  <a href="{{route('analyse')}}" class="btn btn-info">Annuler</a>
</div>
@endsection

@push('plugin-scripts')
  {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
  {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
