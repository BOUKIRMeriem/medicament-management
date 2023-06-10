<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="shortcut icon" href="/favicon.ico">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/offcanvas-navbar.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('assets/plugins/@mdi/font/css/materialdesignicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    @stack('style')
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="my-3 p-3 bg-body rounded shadow-sm" style="width:80%;">
                    <div style="display: flex; align-items: center;">
                        <div class="menu-item" style="display: flex; align-items: center;">
                            <i class="mdi mdi-account" alt="Icône de médecin" style="font-size: 1.5em;"></i>
                            <h3 style="margin-left: 5px;">Édition d'un patient</h3>
                        </div>
                    </div>
                    

                    <form style="width: 80%; margin-left: 80px;" method="post" action="{{ route('updatePatient', ['patient' => $patient->id]) }}">
                        @csrf
                        @method('PUT')
                    
                        <div style="display: flex; flex-wrap: wrap;">
                            <div class="mb-3" style="flex: 1; margin-right: 10px; display: inline-block;">
                                <label for="exampleInputEmail1" class="form-label">CIN:</label>
                                <input type="text" class="form-control" name="cin" value="{{ $patient->cin }}">
                            </div>
                    
                            <div class="mb-3" style="flex: 1; margin-right: 10px; display: inline-block;">
                                <label for="exampleInputPassword1" class="form-label">Nom:</label>
                                <input type="text" class="form-control" name="nom" value="{{ $patient->nom }}">
                            </div>
                        </div>
                        <div style="display: flex; flex-wrap: wrap;">
                            <div class="mb-3" style="flex: 1; margin-right: 10px;">
                                <label for="exampleInputPassword1" class="form-label">Prénom:</label>
                                <input type="text" class="form-control" name="prenom" value="{{ $patient->prenom }}">
                            </div>
                        
                            <div class="mb-3" style="flex: 1; margin-right: 10px;">
                                <label for="exampleInputPassword1" class="form-label">Date de naissance:</label>
                                <input type="text" class="form-control" name="date_Naissance" value="{{ $patient->date_Naissance }}">
                            </div>
                        </div>
                        
                        <div style="display: flex; flex-wrap: wrap;">
                            <div class="mb-3" style="flex: 1; margin-right: 10px;">
                                <label for="exampleInputPassword1" class="form-label">Téléphone:</label>
                                <input type="text" class="form-control" name="telephone" value="{{ $patient->telephone }}">
                            </div>
                        
                            <div class="mb-3" style="flex: 1; margin-right: 10px;">
                                <label for="exampleInputPassword1" class="form-label">Adresse:</label>
                                <input type="text" class="form-control" name="adresse" value="{{ $patient->adresse }}">
                            </div>
                        </div>
                        
                        <div style="display: flex; flex-wrap: wrap;">
                            <div class="mb-3" style="flex: 1; margin-right: 10px;">
                                <label for="exampleInputPassword1" class="form-label">Adresse email:</label>
                                <input type="email" class="form-control" name="adresse_Email" value="{{ $patient->adresse_Email }}">
                            </div>
                        
                            <div class="mb-3" style="flex: 1; margin-right: 10px;">
                                <label for="exampleInputPassword1" class="form-label">Sexe:</label>
                                <select name="sexe" class="form-select">
                                    <option value="homme" {{ $patient->sexe === "homme" ? "selected" : "" }}>Homme</option>
                                    <option value="femme" {{ $patient->sexe === "femme" ? "selected" : "" }}>Femme</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label mb-2" style="margin-right: 10px;">Mutuelle:</label>
                            <div class="col-sm-10" style="width: 500px;margin-right: 10px;">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="mutuelle" id="cnopsRadio" value="Cnops" {{ $patient->mutuelle === "Cnops" ? "checked" : "" }}>
                                          <label class="form-check-label" for="cnopsRadio">Cnops</label>
                                        </div>
                                    </div> 
                                    <div class="col-sm-4">
                                       <div class="form-check">
                                          <input class="form-check-input" type="radio" name="mutuelle" id="cnssRadio" value="CNSS" {{ $patient->mutuelle === "CNSS" ? "checked" : "" }}>
                                          <label class="form-check-label" for="cnssRadio">CNSS</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                      <div class="form-check">
                                         <input class="form-check-input" type="radio" name="mutuelle" id="autresRadio" value="Autres" {{ $patient->mutuelle !== "Cnops" && $patient->mutuelle !== "CNSS" ? "checked" : "" }}>
                                         <label class="form-check-label" for="autresRadio">Autres</label>
                                      </div>
                                   </div>
                             
                        
                        <div style="text-align: right;">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <a href="{{ route('hello', ['id' => $patient->id]) }}" class="btn btn-danger">Annuler</a>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/offcanvas-navbar.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('node_modules/jquery/dist/jquery.min.js')}}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/js/misc.js')}}"></script>
    <script src="{{asset('assets/js/settings.js')}}"></script>
    <script src="{{asset('assets/js/todolist.js')}}"></script>
    <script src="{{asset('/assets/js/dashboard.js')}}"></script>
    <script src="{{asset('/assets/plugins/chartjs/chart.min.js')}}"></script>
    <script src="{{asset('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
    @stack('custom-scripts')
</body>
</html>
