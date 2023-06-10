<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
  
    <link rel="shortcut icon" href="/favicon.ico">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/offcanvas-navbar.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('assets/plugins/@mdi/font/css/materialdesignicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-... votre code de hachage ... " crossorigin="anonymous" />

    @stack('style')
    
   <style>
    .error-message {
    display: block;
    font-size: 12px; /* Ajustez cette valeur selon vos besoins */
}

   </style>

   
</head>
<body style="padding: 0;background-color:#F4F6F7;">
    <nav style="background-color: #1F618D; height: 50px; display: flex; align-items: center; justify-content: space-between;">
        <img src="{{ url('assets/images/logo.png') }}" alt="erreur" style="width: 200px;">
        <h6 style="color: white; margin-right: 30px;margin-top:10px;font-family:Georgia, 'Times New Roman', Times, serif;">BIENVENUE</h6>
    </nav>
    <img src="{{ url('assets/images/logofst.png') }}" alt="" style="width: 100px; float: left; margin-left: 20px; margin-bottom: -25px;">
    <img src="{{ url('assets/images/societe.jpg') }}" alt="" style="width: 60px; float: right; margin-right: 20px; margin-top: 10px;">
    <h6 style="float: right; margin-right: 12px; margin-top: 0; margin-bottom: 0; clear: both; font-family:'Times New Roman', Times, serif;color:blue;">MediaCaris</h6>



     <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="my-5 p-0 bg-body rounded shadow-sm">
                    <div class="row d-flex align-items-center justify-content-center">
                        <div class="col-md-0 col-lg-0 col-xl-6" style="margin-left: 0; padding-left: 0;">
                            <img src="{{ url('assets/images/ss.png') }}" class="img-fluid" alt="Phone image">
                        </div>
                        <div class="col-md-6 col-lg-5 col-xl-5 offset-xl-1">
                            <h3 style="color: #1F618D; padding-left:40px; margin-bottom:50px;font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">CONNEXION</h3>
                            <form action="{{ route('check') }}" method="POST" class="form-container">
                                @csrf
                                <div>
                                    @if(Session::get('fail'))
                                    <div class="alert alert-danger d-block">
                                        {{ Session::get('fail') }}
                                    </div>
                                    @endif
                                    @if(Session::get('success'))
                                    <div class="alert alert-success d-block">
                                        {{ Session::get('success') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="form-outline mb-5">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user"></i>
                                        @csrf
                                        <input type="text" class="form-control custom-input" name="username" placeholder="Entrer votre nom d'utilisateur" value="{{ old('username') }}">
                                    </div>
                                    <span class="text-danger error-message">@error('username'){{ $message }}@enderror</span>
                                </div>
                                
                                <div class="form-outline mb-5">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-lock"></i>
                                        @csrf
                                        <input type="password" class="form-control" name="mot_de_passe" placeholder="Entrer votre mot de passe">
                                    </div>
                                    <span class="text-danger error-message">@error('mot_de_passe'){{ $message }}@enderror</span>
                                </div>
                                
                                <button type="submit" class="btn btn-block btn-primary" style="width: 150px; background-color: #1F618D; margin-left:50px;">Login</button>
                            
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


   
 </body>
</html>
