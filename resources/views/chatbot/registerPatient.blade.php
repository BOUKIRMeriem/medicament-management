<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
          <title>register</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <link href="{{asset('css/offcanvas-navbar.css')}}" rel="stylesheet">

</head>
<body style="padding: 0;">

    <nav style="background-color: #1F618D; height: 50px; display: flex; align-items: center; justify-content: space-between;">
      
        <img src="{{ url('assets/images/logo.png') }}" alt="erreur" style="width: 200px;">
   
        <h6 style="color: white; margin-right: 30px;margin-top:10px;font-family:Georgia, 'Times New Roman', Times, serif;">BIENVENUE</h6>
    </nav>
    
      <div class="row mt-5">
        <div class="col-md-6 offset-md-3 mx-auto text-center" style="width: 650px;">
                <div class="card" style="border-radius: 1rem">
                    <div class="card-header">
            <h4 class="text-center" style="color: #1F618D;">Inscription de patient</h4>
                    </div>
                    <div class="card-body">
           <form action="{{ route('createPatient') }}" method="post">

               @csrf
                     
                 </div>
              
                 <input type="hidden" name="patient_id" value="{{ $patientId }}">
                 <div class="form-group row mt-4">
                    <label for="login" class="col-sm-2 col-form-label mb-2" style="font-weight: bold;margin-left:10px;">CIN:</label>
                    <div class="col-sm-10" style="width: 500px;">
                        <input type="text" class="form-control" name="cin" placeholder="Entrez votre CIN" value="{{ old('cin')}}">
                     
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label mb-2" style="font-weight: bold;margin-left:10px;">Nom:</label>
                    <div class="col-sm-10" style="width: 500px;">
                        <input type="text" class="form-control" name="nom" placeholder="Entrez votre nom "value="{{old('nom')}}" >
                      
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label mb-2" style="font-weight: bold;margin-left:10px;">Prénom:</label>
                    <div class="col-sm-10" style="width: 500px;">
                        <input type="text" class="form-control" name="prenom" placeholder="Entrez votre prénom "value="{{old('prenom')}}" >
                      
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label mb-2"  style="font-weight: bold;margin-left:10px;">Sexe:</label>
                    <div class="col-sm-10" style="width: 500px;">
                        <input type="text" class="form-control" name="sexe" placeholder="Entrez votre sexe" value="{{old('sexe')}}">
                                 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role" class="col-sm-2 col-form-label mb-2" style="font-weight: bold;margin-left:10px;">Adresse:</label>
                    <div class="col-sm-10" style="width: 500px;">
                        <input type="text" class="form-control" name="adresse" placeholder="Entrez votre adresse" value="{{ old('adresse') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label mb-2"  style="font-weight: bold;margin-left:10px;">Téléphone:</label>
                    <div class="col-sm-10" style="width: 500px;">
                        <input type="text" class="form-control" name="telephone" placeholder="Entrez votre numéro de téléphone" value="{{old('telephone')}}">
                                 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="login" class="col-sm-2 col-form-label mt-2"  style="font-weight: bold;margin-left:10px;">Date Naissance:</label>
                    <div class="col-sm-10" style="width: 500px;">
                        <input type="date" class="form-control" name="date_Naissance" placeholder="Entrez votre date de naissance" value="{{ old('date_Naissance') }}">
                    </div>
                </div>
               
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label mb-2"  style="font-weight: bold;margin-left:10px;">Adresse email:</label>
                    <div class="col-sm-10" style="width: 500px;">
                        <input type="email" class="form-control" name="adresse_Email" placeholder="Entrez votre adresse email" value="{{old('adresse_Email')}}">
                                 
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label mb-2" style="font-weight: bold; margin-left: 10px;">Mutuelle:</label>
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
                
                
                
                
                
                <div class="form-group text-center">
                    <br>
                    <button type="submit" class="btn btn-block btn-primary" style="width: 150px; background-color: #1F618D;" id="boton">Enregistrer</button>
                </div>
             <br>
            

    </form>
        </div>
    </div>
</div>
</div>
</div>
<br><br>

      <script  src="{{asset('js/offcanvas-navbar.js')}}"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<body>
</html>