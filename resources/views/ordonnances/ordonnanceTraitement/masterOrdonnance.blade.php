@extends('layout.master')
@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush
@section('content')
<div class="menu-item" style="display: flex; align-items: center;">
  <i class="mdi mdi-file-document-outline" alt="Icône de stéthoscope" style="font-size: 1.5em;"></i>
  <h3 class="menu-title" style="margin-left: 10px;">Gestion des ordonnances de traitement</h3>
  <div class="search-container" style="margin-left: auto;">
    <form class="search-form" method="GET" action="{{route('ordonnance.rechercher')}}">
      <div class="form-outline">
        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom" />
      </div>
      <div class="form-outline">
        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prénom" />
      </div>
      <button type="submit" class="search-btn">
        <i class="mdi mdi-magnify"></i>
      </button>
    </form>
  </div>
</div>
<div class="mt-4">
  <div class="d-flex justify-content-between mb-2">
    {{$ordonnances->links()}}
    <a href="{{route('ordonnance.create')}}" class="btn btn-primary" style="height: 30px;background-color:#1F618D;border:#1F618D;">Ajouter</a>
  </div>


  <div class="mt-4">
    @if (session()->has("success"))
        <div class="alert alert-success">
            <h6>{{ session()->get('success') }}</h6>
        </div>
    @endif
    @if (session()->has('successDelete'))
    <div class="alert alert-success">
       <h6>{!! session()->get('successDelete') !!}</h6>
    </div>
    @endif
<div class="row">
    <div class="col">
      <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr style="background-color: white;">
            <th scope="col">ID</th>
            <th scope="col">Patient</th>
            <th scope="col">Médecin</th>
            <th scope="col">médicament</th>
            <th scope="col">date d'ordonnance</th>
            <th scope="col">dosage</th>
            <th scope="col">nbr de fois par jour</th>
            <th scope="col">Quantité</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
    
        <tbody>
          @if (isset($ordonnances) && count($ordonnances) > 0)
          @foreach ($ordonnances as $ordonnance)
          @if ($ordonnance->consultation !== null)
    <tr>
      <td>{{$ordonnance->id}}</td>
        <td>{{$ordonnance->consultation->rdv->patient->nom}} {{$ordonnance->consultation->rdv->patient->prenom}}</td>
        <td>{{$ordonnance->consultation->rdv->medecin->nom}} {{$ordonnance->consultation->rdv->medecin->prenom}} </td>
        <td>{{$ordonnance->medicament}}</td>
        <td>{{$ordonnance->date}}</td>
        <td>{{$ordonnance->dosage}}</td>
        <td>{{$ordonnance->nbr_fois}}</td>
        <td>{{$ordonnance->qte}}</td>
        <td>
            <a href="{{route('ordonnance.show', ['ordonnance'=>$ordonnance])}}" class="mdi mdi-printer" style="font-size: 2em; color: #E67E22;"></a>
            <a href="/api/ordonnance/{{$ordonnance->id}}" class="mdi mdi-pencil"  style="font-size: 2em; color: green ; float : left"></a>
            <a href="#" class="mdi mdi-delete" style="font-size: 2em; color: red;" onclick="if(confirm('Voulez-vous vraiment supprimer cet ordonnance ?')){document.getElementById('form-{{$ordonnance->id}}').submit()}"></a>
            <form id="form-{{$ordonnance->id}}" action="/api/ordonnance/{{$ordonnance->id}}" method="post">
              @csrf
              @method('DELETE')
              <input type="hidden" name="_method" value="delete">
            </form>
        </td>
    </tr>
    @endif
@endforeach
@else
<tr>
  <td colspan="7">Aucun Ordonnance trouvé.</td>
</tr>
@endif
</tbody>

 </table>
</div>
@if($rechercher== false)
<h4>Total: {{ \App\Models\Ordonnance::count() }}</h4>
@endif
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

