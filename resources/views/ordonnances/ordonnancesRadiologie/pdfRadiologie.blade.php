<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<style>
    img{
      float: right;
      padding: 0%;
      margin: 0%;
      width: 300px;
   }
    header div{
      float: left;
      padding: 0%;
      margin: 0%;
  }
    header div p:first-of-type {
    color: #2980B9;
  }
  section p:first-of-type {
    color: #2980B9;
    text-align: center;
    text-decoration: underline;
  }
  section p:nth-of-type(2) {
    text-align: center;
   }
  section p:nth-of-type(3) strong {
      color: #2980B9;
  }
  section p:nth-of-type(3) {
  margin-bottom: 10%;
  }
  section{
    clear: both;
  }
  #signature{
    color: #2980B9;
    margin-top: 10%;
    margin-left:70%;
  }
  footer {
    text-align: center;
    position: fixed;
    bottom: 0;
    width: 100%;
    text-align: center;
  }
 
  
  </style>
<body>
   
    <header>
        <div>
           <p><strong>{{ $radiologie->consultation->rdv->medecin->nom }} & {{ $radiologie->consultation->rdv->medecin->prenom }}</strong></p>
           <p>Médecin {{ $radiologie->consultation->rdv->medecin->specialite }}</p>
           <p>Tél: {{ $radiologie->consultation->rdv->medecin->telephone }}</p>
           <p >email: {{ $radiologie->consultation->rdv->medecin->email }}</p>
         </div>
           <img src="{{ public_path('assets/images/logo3.png') }}" alt="logo">
       </header>
      
       <section>
        <p>Ordonnance Médicale</p>
        <p>{{ $radiologie->date }}</p>
        <p><strong>Nom & Prénom :</strong> {{ $radiologie->consultation->rdv->patient->nom }} {{ $radiologie->consultation->rdv->patient->prenom }}</p>
        <h5 style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;margin-bottom:30px;">faire š'il vous plaît les radiologies suivant:</h5>
        <input type="checkbox" id="radiographie">
        <label for="radiographie">Radiographie</label><br>
        
        <input type="checkbox" id="tomodensitométrie">
        <label for="tomodensitométrie">Tomodensitométrie</label><br>
        
        <input type="checkbox" id="irm">
        <label for="irm">Imagerie par résonance magnétique</label><br>
        
        <input type="checkbox" id="echographie">
        <label for="echographie">Échographie</label><br>
        
        <input type="checkbox" id="mammographie">
        <label for="mammographie">Mammographie</label><br>
        
        <input type="checkbox" id="radiographie-dentaire">
        <label for="radiographie-dentaire">Radiographie dentaire</label><br>
        
        <input type="checkbox" id="radiographie-interventionnelle">
        <label for="radiographie-interventionnelle">Radiographie interventionnelle</label><br>
        
        <input type="checkbox" id="radiologie-nucleaire">
        <label for="radiologie-nucleaire">Radiologie nucléaire</label><br>
        
        <input type="checkbox" id="radiologie-interventionnelle-vasculaire">
        <label for="radiologie-interventionnelle-vasculaire">Radiologie interventionnelle vasculaire</label><br>
        
        <input type="checkbox" id="radiologie-interventionnelle-musculosquelettique">
        <label for="radiologie-interventionnelle-musculosquelettique">Radiologie interventionnelle musculosquelettique</label><br>
        
        <input type="checkbox" id="radiologie-interventionnelle-oncologique">
        <label for="radiologie-interventionnelle-oncologique">Radiologie interventionnelle oncologique</label><br>
        
        <input type="checkbox" id="radiologie-pediatrique">
        <label for="radiologie-pediatrique">Radiologie pédiatrique</label><br>
        
        <input type="checkbox" id="radiologie-neuroradiologique">
        <label for="radiologie-neuroradiologique">Radiologie neuroradiologique</label><br>
        
        <input type="checkbox" id="radiologie-thoracique">
        <label for="radiologie-thoracique">Radiologie thoracique</label><br>
         <p id="signature"><strong>Signature:</strong></p>
      </section>
          
      <footer>
        <hr>
        <p><strong>Email:</strong> {{ $radiologie->consultation->rdv->medecin->email}} | <strong>Tél:</strong> {{ $radiologie->consultation->rdv->medecin->telephone }}</p>
      </footer>

</body>
</html>