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
           <p><strong>{{ $analyse->consultation->rdv->medecin->nom }} & {{ $analyse->consultation->rdv->medecin->prenom }}</strong></p>
           <p>Médecin {{ $analyse->consultation->rdv->medecin->specialite }}</p>
           <p>Tél: {{ $analyse->consultation->rdv->medecin->telephone }}</p>
           <p >email: {{ $analyse->consultation->rdv->medecin->email }}</p>
         </div>
           <img src="{{ public_path('assets/images/logo3.png') }}" alt="logo">
       </header>
      
       <section>
        <p>Ordonnance Médicale</p>
        <p>{{ $analyse->date }}</p>
        <p><strong>Nom & Prénom :</strong> {{ $analyse->consultation->rdv->patient->nom }} {{ $analyse->consultation->rdv->patient->prenom }}</p>
        <h5 style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;margin-bottom:30px;">faire š'il vous plaît les radiologies suivant:</h5>
        <input type="checkbox" id="radiographie">
    <label for="radiographie">Numération formule sanguine</label><br>
    
    <input type="checkbox" id="tomodensitométrie">
    <label for="tomodensitométrie">Profil lipidique</label><br>
    
    <input type="checkbox" id="irm">
    <label for="irm">Glycémie à jeun</label><br>
    
    <input type="checkbox" id="echographie">
    <label for="echographie">Test de la fonction thyroïdienne</label><br>
    
    <input type="checkbox" id="mammographie">
    <label for="mammographie">Test de la fonction rénale</label><br>
    
    <input type="checkbox" id="radiographie-dentaire">
    <label for="radiographie-dentaire">Électrolytes sériques</label><br>
    
    <input type="checkbox" id="radiographie-interventionnelle">
    <label for="radiographie-interventionnelle">Analyse d'urine</label><br>
    
    <input type="checkbox" id="radiologie-nucleaire">
    <label for="radiologie-nucleaire">Test hépatique</label><br>
    
    <input type="checkbox" id="radiologie-interventionnelle-vasculaire">
    <label for="radiologie-interventionnelle-vasculaire">Analyse des gaz du sang</label><br>
    
    <input type="checkbox" id="radiologie-interventionnelle-musculosquelettique">
    <label for="radiologie-interventionnelle-musculosquelettique">Test de dépistage des maladies sexuellement transmissibles </label><br>
         <p id="signature"><strong>Signature:</strong></p>
      </section>
          
      <footer>
        <hr>
        <p><strong>Email:</strong> {{ $analyse->consultation->rdv->medecin->email}} | <strong>Tél:</strong> {{ $analyse->consultation->rdv->medecin->telephone }}</p>
      </footer>

</body>
</html>