@extends('layout.master')
@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush
@section('content')
<div class="menu-item" style="display: flex; align-items: center;">
  <i class="mdi mdi-account-group" alt="Icône de médecin" style="font-size: 1.5em;"></i>
  <h3 class="menu-title" style="margin-left: 10px;">Gestion des Patients</h3>
  <div class="search-container" style="margin-left: auto;">
    <form class="search-form" method="GET" action="/api/patient/rechercher">
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
      {{$patients->links()}}
      <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 30px;background-color:#1F618D;border:#1F618D;">
          Sélectionner une action
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/api/patient/create">Ajouter</a>
          <a class="dropdown-item" href="{{ route('patient', ['archive' => true]) }}">Les patients Archivés</a>

        </div>
      </div>
    </div> 
     
     @if (session()->has('successDelete'))
     <div class="alert alert-success">
         <h6>{{ session()->get('successDelete') }}</h6>
     </div>
 @endif
 <div class="mt-4">
  @if (session()->has("success"))
      <div class="alert alert-success">
        <h6>{{session()->get('success')}}</h6>
      </div>
      @endif
  
      <div class="row">
        <div class="col">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr style="background-color: white;">
                        <th scope="col">CIN</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Sexe</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                @isset($patients)
                <tbody>
                    @if(count($patients) > 0)
                        @foreach ($patients as $patient)
                        <tr>
                            <td>{{$patient->cin}}</td>
                            <td>{{$patient->nom}}</td>
                            <td>{{$patient->prenom}}</td>
                            <td>{{$patient->telephone}}</td>
                            <td>{{$patient->sexe}}</td>
                            <td>
                                <a href="{{route('patient.edit', ['patient'=>$patient])}}" class="mdi mdi-pencil"  style="font-size: 2em; color: green ; float : left"></a>
                                <a href="#" class="mdi mdi-delete" style="font-size: 2em; color: red;" onclick="if(confirm('Voulez-vous vraiment supprimer cet patient ?')){document.getElementById('form-{{$patient->id}}').submit()}"></a>
                                <a href="{{ route('afficherPatient',['patient'=>$patient])}}"class="mdi mdi-eye" style="font-size: 2em; color: #A569BD;"></a>
                                @if (!isset($archive) || $archive == false)
                                   <a href="{{ route('patient.archive', ['id' => $patient->id]) }}"class="mdi mdi-archive" style="font-size: 2em; color: #F4D03F;"></a>
                                   @else 
                                   <a href="{{ route('patient.desarchive', ['id' => $patient->id]) }}" class="mdi mdi-folder-open" style="font-size: 2em; color: #F4D03F;"></a>
                                @endif
    
                                <form id="form-{{$patient->id}}" action="{{route('patient.supprimer',['patient'=>$patient->id])}}"  method="post">
                                    @csrf
                                    @method('DELETE') 
                                    <input type="hidden" name="_method" value="delete"> 
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">Aucun patient trouvé.</td>
                        </tr>
                    @endif
                </tbody>
                @endisset
            </table>
          </div>
            @if(!isset($rechercher) || $rechercher == false)
                @if (!isset($archive) || $archive == false)
                    <h4>Total: {{ \App\Models\Patient::where('archiver', false)->count() }}</h4>
                @else  
                    <h4>Total: {{ \App\Models\Patient::where('archiver', true)->count() }}</h4>
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
