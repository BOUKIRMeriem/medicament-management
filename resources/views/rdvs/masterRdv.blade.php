@extends('layout.master')
@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="menu-item" style="display: flex; align-items: center;">
  <i class="mdi mdi-calendar-clock" alt="Icône de médecin" style="font-size: 1.5em;"></i>
  <h3 class="menu-title" style="margin-left: 10px;">Gestion des Rendez-vous</h3>
  <div class="search-container" style="margin-left: auto;">
    <form class="search-form" method="GET" action="{{route('rdv.rechercher')}}">
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
      {{ $rdvs->links() }}
      <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 30px;background-color:#1F618D;border:#1F618D;">
          Sélectionner une action
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{route('rdv.create')}}">Ajouter</a>
          <a class="dropdown-item" href="/api/rdv?aujourdhui=true">Aujourd'hui</a>
        </div>
      </div>
   </div>
 




<div class="row">
    <div class="col">
      <div class="table-responsive"> 
      <table class="table table-bordered table-hover">
        <thead>
          <tr style="background-color: white;">
            <th scope="col">ID</th>
            <th scope="col">Patient</th>
            <th scope="col">Medecin</th>
            <th scope="col">Date</th>
            <th scope="col">Heure</th>
            <th scope="col">Durée</th>
            <th scope="col">Commentaire</th>
            <th scope="col">Actions</th>
         </tr>
        </thead>

  <tbody>
  
      @if(request()->has('aujourdhui') && request()->get('aujourdhui') == 'true')
       @if(count($rdvs) > 0)
         @foreach($rdvs as $rdv)
        <tr>
          <td>{{ $rdv->id }}</td>
          <td>{{ $rdv->patient->nom }} {{ $rdv->patient->prenom }}</td>
          <td>{{ $rdv->medecin->nom }} {{ $rdv->medecin->prenom }}</td>
          <td>{{ $rdv->date }}</td>
          <td>{{ $rdv->heure }}</td>
          <td>{{ $rdv->duree }}</td>
          <td>{{ $rdv->commentaire }}</td>
          <td>
            <a href="{{ route('rdv.edit', ['rdv'=>$rdv->id]) }}" class="btn btn-info">Editer</a>
            <a href="#" class="btn btn-danger" onclick="if(confirm('Voulez-vous vraiment supprimer cet rendez-vous ?')){document.getElementById('form-{{$rdv->id}}').submit()}">Supprimer</a>
            <form id="form-{{$rdv->id}}" action="/api/rdv/{{$rdv->id}}" method="post">
              @csrf
              @method('DELETE')
              <input type="hidden" name="_method" value="delete">
            </form>
          </td>
        </tr>
         @endforeach
        @else
        <tr>
          <td colspan="7">Aucun rendez-vous aujourd'hui</td>
        </tr>
        @endif
      @else
      @if (isset($rdvs) && count($rdvs) > 0)
       @foreach ($rdvs as $rdv)
          @if ($rdv->patient !== null)
              <tr>
                  <td>{{ $rdv->id }}</td>
                  <td>{{ $rdv->patient->nom }} {{ $rdv->patient->prenom }}</td>
                  <td>{{ $rdv->medecin->nom }} {{ $rdv->medecin->prenom }}</td>
                  <td>{{ $rdv->date }}</td>
                  <td>{{ $rdv->heure }}</td>
                  <td>{{ $rdv->duree }}</td>
                  <td>{{ $rdv->commentaire }}</td>
                  <td>
                      <a href="{{ route('rdv.edit', ['rdv' => $rdv->id]) }}" class="mdi mdi-pencil"  style="font-size: 2em; color: green ; float : left"></a>
                      <a href="#" class="mdi mdi-delete" style="font-size: 2em; color: red;" onclick="if(confirm('Voulez-vous vraiment supprimer ce rendez-vous ?')){document.getElementById('form-{{$rdv->id}}').submit()}"></a>
                      <form id="form-{{$rdv->id}}" action="/api/rdv/{{$rdv->id}}" method="post">
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
          <td colspan="7">Aucun Rendez-vous  trouvé.</td>
        </tr>
      @endif
   
 
    </tbody>
    @endif
</table>
      </div>

  

    @if(isset($aujourdhui) && $aujourdhui==true)
      <h4>Total: {{ $totalRdvs }}</h4>
    @else 
     @if($rechercher== false)
       <h4>Total: {{ \App\Models\Rdv::count() }}</h4>
     @endif
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

