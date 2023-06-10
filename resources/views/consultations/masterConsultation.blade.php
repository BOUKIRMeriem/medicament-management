@extends('layout.master')
@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush
@section('content')
<div class="menu-item" style="display: flex; align-items: center;">
  <i class="mdi mdi-stethoscope" alt="Icône de stéthoscope" style="font-size: 1.5em;"></i>
  <h3 class="menu-title" style="margin-left: 10px;">Gestion des Consultations</h3>
  <div class="search-container" style="margin-left: auto;">
    <form class="search-form" method="GET" action="{{route('consultation.rechercher')}}">
      <div class="form-outline">
        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom"  required/>
      </div>
      <div class="form-outline">
        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prénom" required />
      </div>
      <button type="submit" class="search-btn">
        <i class="mdi mdi-magnify"></i>
      </button>
    </form>
  </div>
</div>
<div class="mt-4">
  <div class="d-flex justify-content-between mb-2">
    {{$consultations->links()}}
    <a href="{{route('consultation.create')}}" class="btn btn-primary" style="height: 30px;background-color:#1F618D;border:#1F618D;">Ajouter</a>
    
  </div>
     
  @if (session()->has('successDelete'))
    <div class="alert alert-success">
      <h6>{{ session()->get('successDelete') }}</h6>
    </div>
  @endif
  <div class="mt-4">
    @if (session()->has("success"))
        <div class="alert alert-success">
            <h6>{{ session()->get('success') }}</h6>
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
            <th scope="col">Date de Consultation</th>
            <th scope="col">Type de Consultation</th>
            <th scope="col">Diagnostic </th>
            <th scope="col">Action</th>
          </tr>
        </thead>
      
        <tbody>
          @if (isset($consultations) && count($consultations) > 0)
          @foreach ($consultations as $consultation)
          @if ($consultation->rdv->patient !== null  && $consultation->rdv->medecin !== null) 
          <tr>
            <td>{{$consultation->id}}</td>
              <td>{{ $consultation->rdv->patient->nom }} {{ $consultation->rdv->patient->prenom }}</td>
              <td>{{ $consultation->rdv->medecin->nom }} {{ $consultation->rdv->medecin->prenom }}</td>
              <td>{{$consultation->date_consultation}}</td>
              <td>{{$consultation->type_consultation}}</td>
              <td>{{$consultation->diagnostic}}</td>
              <td>
                <a href="{{route('consultation.edit', ['consultation'=>$consultation])}}" class="mdi mdi-pencil"  style="font-size: 2em; color: green ; float : left"></a>
                <a href="#" class="mdi mdi-delete" style="font-size: 2em; color: red;" onclick="if(confirm('Voulez-vous vraiment supprimer cette consultation ?')){document.getElementById('form-{{$consultation->id}}').submit()}"></a>

                <form id="form-{{$consultation->id}}" action="/api/consultation/{{$consultation->id}}"  method="post">
                  @csrf
                  @method('DELETE') 
                  <input type="hidden" name="_methode" value="delete"> 
                </form>
              </td>
            </tr>
            @endif
          @endforeach
          @else
          <tr>
            <td colspan="7">Aucun Consultation trouvé.</td>
          </tr>
        @endif
      </tbody>
     
  </table>
  </div>
  @if($rechercher== false)
  <h4>Total: {{ \App\Models\Consultation::count() }}</h4>
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

