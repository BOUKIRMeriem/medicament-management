@extends('layout.master')
@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush
@section('content')
<div class="menu-item" style="display: flex; align-items: center;">
  <i class="mdi mdi-doctor" alt="Icône de médecin" style="font-size: 1.5em;"></i>
  <h3 class="menu-title" style="margin-left: 10px;">Gestion des Médecins</h3>
  <div class="search-container" style="margin-left: auto;">
    <form class="search-form" method="GET" action="/api/medecin/rechercher">
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
      {{$medecins->links()}}
      <a href="{{route('medecin.create')}}" class="btn btn-primary" style="height: 30px;background-color:#1F618D;border:#1F618D;">Ajouter</a>
      
     </div>
     <div class="mt-4">
      @if (session()->has("success"))
          <div class="alert alert-success">
              <h6>{{ session()->get('success') }}</h6>
          </div>
      @endif
  
  </div>
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
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Email</th>
            <th scope="col">Téléphone</th>
            <th scope="col">Spécialité</th>
            <th scope="col">Actions</th>
         </tr>
        </thead>
        @if(isset($medecins))
        <tbody>
          @if(count($medecins) > 0)
            @foreach ($medecins as $medecin)
              <tr>
                <td>{{$medecin->id}}</td>
                <td>{{$medecin->nom}}</td>
                <td>{{$medecin->prenom}}</td>
                <td>{{$medecin->email}}</td>
                <td>{{$medecin->telephone}}</td>
                <td>{{$medecin->specialite}}</td>
                <td>
                  <a href="{{route('medecin.edit', ['medecin'=>$medecin])}}" class="mdi mdi-pencil"  style="font-size: 2em; color: green ; float : left"></a>
                  <a href="#" class="mdi mdi-delete" style="font-size: 2em; color: red;" onclick="if(confirm('Voulez-vous vraiment supprimer cet medecin ?')){document.getElementById('form-{{$medecin->id}}').submit()}"></a>
                  <a href="/api/medecin/{{ $medecin->id }}" class="mdi mdi-eye" style="font-size: 2em; color: #A569BD;"></a>
                  <form id="form-{{$medecin->id}}" action="{{route('medecin.supprimer',['medecin'=>$medecin->id])}}"  method="post">
                    @csrf
                    @method('DELETE') 
                    <input type="hidden" name="_methode" value="delete"> 
                  </form>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="7">Aucun médecin trouvé.</td>
            </tr>
          @endif
        </tbody>
        @endif
    </table>
      </div>
    @if($rechercher== false)
       <h4>Total: {{ \App\Models\Medecin::count() }}</h4>
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
