@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush
<style>
 
</style>

@section('content')

<div class="my-3 p-3 bg-body rounded shadow-sm" style="width: 70%; margin: 0 auto;">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div >
        <header>
        <div style="float: left;">      
          <p style="color:#2980B9 ; "> <strong>Dr. {{ $ordonnance->consultation->rdv->medecin->nom }} & {{ $ordonnance->consultation->rdv->medecin->prenom }}</strong></p>
          <p>Médecin {{ $ordonnance->consultation->rdv->medecin->specialite }}</p>
          <p>Tél: {{ $ordonnance->consultation->rdv->medecin->telephone }}</p>
          <p>email: {{ $ordonnance->consultation->rdv->medecin->email }}</p>
        </div>
        <img src="{{ url('assets/images/logo3.png') }}" alt="logo" class="img-fluid" style="float: right;" />
      </div>
    </header>

    <p style="text-align: center; color:#2980B9 "><u>  Ordonnance Médicale</u></p>
    <p style="text-align: center;">{{ $ordonnance->date }}</p>
    <p><strong>Nom & Prénom :</strong> {{ $ordonnance->consultation->rdv->patient->nom }} {{ $ordonnance->consultation->rdv->patient->prenom }}</p>
    <div class="table-responsive">
    <table class="table table-bordered" style="margin-top:10%; margin-bottom:30%">
      <tr>
      <th>Médicament</th>
      <th>Dosage</th>
      <th>Quantité</th>
      <th>Nbr de fois par jour</th>
    </tr>
    <tr>
      <td>{{ $ordonnance->medicament }}</td>
      <td>{{ $ordonnance->dosage }}</td>
      <td>{{ $ordonnance->qte }}</td>
      <td>{{ $ordonnance->nbr_fois }}</td>
    </tr>
  </table>
    </div>
    <p style=" margin-left:900px;color:#2980B9 ;margin-bottom:20%;"><strong>Signature:</strong></p>
    <footer style="text-align: center;">
      <hr>
      <p><strong>Email:</strong> {{ $ordonnance->consultation->rdv->medecin->email}} | <strong>Tél:</strong> {{ $ordonnance->consultation->rdv->medecin->telephone }}</p>
    </footer>
    </div>
  </div>
</div>


<div style="text-align: right;">
  <a href="{{route('export.pdf', ['ordonnance'=>$ordonnance])}}" class="btn btn-primary">Export TO PDF</a>
  <a href="/api/ordonnance" class="btn btn-info">Annuler</a>
</div>
@endsection

@push('plugin-scripts')
  {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
  {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
