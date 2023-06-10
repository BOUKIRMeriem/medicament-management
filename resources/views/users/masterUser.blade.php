@extends('layout.master')
@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush
@section('content')
<div class="menu-item" style="display: flex; align-items: center;">
  <i class="mdi mdi-account" alt="Icône de médecin" style="font-size: 1.5em;"></i>
  <h3 class="menu-title" style="margin-left: 10px;">Gestion des Users</h3>
  <div class="search-container" style="margin-left: auto;">
    <form class="search-form" method="GET" action="/api/user/rechercher">
      <div class="form-outline">
        <input type="text" id="login" name="login" class="form-control" placeholder="Search..." />
      </div>
      <button type="submit" class="search-btn">
        <i class="mdi mdi-magnify"></i>
      </button>
    </form>
  </div>
</div>
<div class="mt-4">
    <div class="d-flex justify-content-between mb-2">
    
        <a href="/api/user/create" class="btn btn-primary" style="height: 30px;background-color:#1F618D;border:#1F618D;">Ajouter</a>
    </div>
   
</div>
<div class="row">
    <div class="col">
      <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr style="background-color: white;">
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Téléphone</th>
            <th scope="col">Rôle</th>
            <th scope="col">Actions</th>
         </tr>
        </thead>
        @if(isset($users))
        <tbody>
          @if(count($users) > 0)
            @foreach ($users as $user)
              <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->telephone}}</td>
                <td>{{$user->role}}</td>
             
                <td>
                  <a href="{{route('user.edit', ['user'=>$user])}}" class="mdi mdi-pencil"  style="font-size: 2em; color: green ; float : left"></a>
                  <a href="#" class="mdi mdi-delete" style="font-size: 2em; color: red;" onclick="if(confirm('Voulez-vous vraiment supprimer cet user ?')){document.getElementById('form-{{$user->id}}').submit()}"></a>
                  <form id="form-{{$user->id}}" action="{{route('user.supprimer',['user'=>$user->id])}}"  method="post">
                    @csrf
                    @method('DELETE') 
                    <input type="hidden" name="_methode" value="delete"> 
                  </form>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="7">Aucun user trouvé.</td>
            </tr>
          @endif
        </tbody>
        @endif
    </table>
  </div>
    @if(isset($rechercher) && $rechercher == false)
    <h4>Total: {{ \App\Models\User::count() }}</h4>
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