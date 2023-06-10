@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="my-3 p-3 bg-body rounded shadow-sm" style="width:100%;">
              <div style="display: flex; align-items: center;">
                  <i class="mdi mdi-doctor" alt="Icône de médecin" style="font-size: 1.7em;"></i>
                  <h3 style="margin-left: 5px;">Ajouter d'un médecin</h3>
              </div>
              
    <form style="width:90%;" method="POST"  action="{{route('medecin.ajouter')}}">
      @csrf
      <div style="display: flex; flex-wrap: wrap; margin-left:80px;">
       <div class="mb-3" style="flex: 1; margin-right: 10px;">
          <label for="exampleInputEmail1" class="form-label">Nom:</label>
          <input type="text" class="form-control" name="nom" >
       </div>
       <div class="mb-3" style="flex: 1; margin-left:80px;">
          <label for="exampleInputPassword1" class="form-label">Prenom:</label>
          <input type="text" class="form-control" name="prenom" >
       </div>
      </div>
      <div style="display: flex; flex-wrap: wrap; margin-left:80px;">
      <div class="mb-3"  style="flex: 1; margin-right: 10px;">
        <label for="exampleInputPassword1" class="form-label">Email:</label>
        <input type="email" class="form-control" name="email" >
      </div>
      <div class="mb-3" style="flex: 1; margin-left:80px;">
        <label for="exampleInputPassword1" class="form-label">Téléphone:</label>
        <input type="text" class="form-control" name="telephone" >
      </div>
      </div>
      <div class="mb-3" style="flex-wrap: wrap; margin-left: 80px;">
        <label for="exampleInputPassword1" class="form-label">Spécialité:</label>
           <select class="form-select" name="specialite">
            <option value=""></option>
            <option value="Pédiatrie">Pédiatrie</option>
            <option value="Chirurgie">Chirurgie</option>
            <option value="Radiologie">Radiologie</option>
          </select>
      </div>
      <div style="text-align: right;">
      <button type="submit" class="btn btn-primary">Enregistrer</button>
      <a href="{{route('medecin')}}" class="btn btn-danger">Annuler</a>
    </div>
    </form>
      
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
