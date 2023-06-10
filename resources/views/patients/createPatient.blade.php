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
                  <i class="mdi mdi-account" alt="Icône de médecin" style="font-size: 1.7em;"></i>
                  <h3 style="margin-left: 5px;">ajouter un patient</h3>
              </div>
             
    <form style="width:90%;" method="POST"  action="/api/patient/ajouter">
      @csrf
      <div style="display: flex; flex-wrap: wrap; margin-left:80px;">
       <div class="mb-3" style="flex: 1; margin-right: 10px;">
          <label for="exampleInputEmail1" class="form-label">CIN:</label>
          <input type="text" class="form-control" name="cin" >
       </div>
       <div class="mb-3" style="flex: 1; margin-left:80px;">
          <label for="exampleInputPassword1" class="form-label">Nom:</label>
          <input type="text" class="form-control" name="nom" >
       </div>
      </div>
      <div style="display: flex; flex-wrap: wrap; margin-left:80px;">
      <div class="mb-3"  style="flex: 1; margin-right: 10px;">
        <label for="exampleInputPassword1" class="form-label">Prénom:</label>
        <input type="text" class="form-control" name="prenom" >
      </div>
      <div class="mb-3" style="flex: 1; margin-left:80px;">
        <label for="exampleInputPassword1" class="form-label">Date naissance:</label>
        <input type="Date" class="form-control" name="date_Naissance" >
      </div>
      </div>
      <div style="display: flex; flex-wrap: wrap; margin-left:80px;">
        <div class="mb-3"  style="flex: 1; margin-right: 10px;">
          <label for="exampleInputPassword1" class="form-label">Adresse:</label>
          <input type="text" class="form-control" name="adresse" >
        </div>
        <div class="mb-3" style="flex: 1; margin-left:80px;">
          <label for="exampleInputPassword1" class="form-label">Téléphone:</label>
          <input type="text" class="form-control" name="telephone" >
        </div>
        </div>
        <div style="display: flex; flex-wrap: wrap; margin-left:80px;">
            <div class="mb-3"  style="flex: 1; margin-right: 10px;">
              <label for="exampleInputPassword1" class="form-label">Adresse email:</label>
              <input type="email" class="form-control" name="adresse_Email" >
            </div>
            <div class="mb-3" style="flex: 1; margin-left:80px;">
              <label for="sexe" class="form-label">Sexe:</label>
              <select class="form-select" name="sexe">
                <option value=""></option>
                  <option value="homme">Homme</option>
                  <option value="femme">Femme</option>
              </select>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label mb-2" style="margin-left: 10px;">Mutuelle:</label>
            <div class="col-sm-10" style="width: 500px;">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="mutuelle" id="cnopsRadio" value="Cnops">
                            <label class="form-check-label" for="cnopsRadio">Cnops</label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="mutuelle" id="cnssRadio" value="CNSS">
                            <label class="form-check-label" for="cnssRadio">CNSS</label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="mutuelle" id="autresRadio" value="Autres">
                            <label class="form-check-label" for="autresRadio">Autres</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
            <div style="text-align: right;">
              <button type="submit" class="btn btn-primary">Enregistrer</button>
              <a href="{{route('patient')}}" class="btn btn-danger">Annuler</a>
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
