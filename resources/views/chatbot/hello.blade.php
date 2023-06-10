<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />



</head>
<body>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css" type="text/css">
    <div class="container-fluid" style="background-color: white; width: 400px; height: 350px; padding-left: 70px;padding-right: 70px;padding-top: 20px; padding-buttom: 20px;border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="my-3 p-3 bg-body rounded shadow-sm" style="width:100%;">
                    <div style="display: flex; align-items: center;">
                        <h3 style="margin-left: 5px; color: #1F618D;margin-right:50px;">Les informations du patient</h3>
                    </div>
    
                   
                      <p style="margin-bottom: 10px; margin-right:100px;"><strong><i class="fa fa-id-card" style="width: 20px;"></i></strong> {{$patient->cin}} </p>
                      <p style="margin-bottom: 10px;"><strong><i class="fa fa-user" style="width: 20px;"></i> </strong> {{$patient->nom}} {{$patient->prenom}}</p>

                      <p style="margin-bottom: 10px;"><strong><i class="fa fa-venus-mars" style="width: 20px;"></i> </strong> {{$patient->sexe}}</p>
                      <p style="margin-bottom: 10px;"><strong><i class="fa fa-map-marker" style="width: 20px;"></i> </strong> {{$patient->adresse}}</p>
                      <p style="margin-bottom: 10px;"><strong><i class="fa fa-phone" style="width: 20px;"></i> </strong> {{$patient->telephone}}</p>
                      <p style="margin-bottom: 10px;"><strong><i class="fa fa-calendar" style="width: 20px;"></i> </strong> {{$patient->date_Naissance}}</p>
                      <p style="margin-bottom: 10px;"><strong><i class="fa fa-envelope" style="width: 20px;"></i></strong> {{$patient->adresse_Email}}</p>
                      <p style="margin-bottom: 10px;">
                        <strong>
                          @if($patient->mutuelle == 'CNSS')
                            <i class="fa fa-building" style="font-size: 20px;"></i>
                          @elseif($patient->mutuelle ==='Cnops')
                            <i class="fa fa-university" style="font-size: 20px;"></i>
                          @else
                            <i class="fa fa-star" style="font-size: 20px;"></i>
                          @endif
                        </strong>
                        {{$patient->mutuelle}}
                      </p>
                      

                      <a href="{{ route('editPatient', ['patient' => $patient->id]) }}" class="btn btn-primary" style="background-color: #1F618D; color: white; width: 100px; text-decoration: none; float: right;">Modifier</a>

                </div>
            </div>
        </div>
    </div>
    
    
    
    
    




    <script>
       
        
        var botmanWidget = {
            aboutText: "Bienvenue",
            introMessage: "Bonjour, Comment puis-je vous aider aujourd'hui ?"
        };
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js"></script>
</body>
</html>
