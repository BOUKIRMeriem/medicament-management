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
  margin-top: 30%;
  margin-left:70%;
}
footer {
  text-align: center;
  position: fixed;
  bottom: 0;
  width: 100%;
  text-align: center;
}
table{
  width: 100%;
  border-collapse: collapse;

}
td{
  text-align: center;
}

</style>
<body>
 
        <header>
         <div>
            <p><strong>{{ $ordonnance->consultation->rdv->medecin->nom }} & {{ $ordonnance->consultation->rdv->medecin->prenom }}</strong></p>
            <p>Médecin {{ $ordonnance->consultation->rdv->medecin->specialite }}</p>
            <p>Tél: {{ $ordonnance->consultation->rdv->medecin->telephone }}</p>
            <p >email: {{ $ordonnance->consultation->rdv->medecin->email }}</p>
          </div>
            <img src="{{ public_path('assets/images/logo3.png') }}" alt="logo">
        </header>
      
        <section>
          <p>Ordonnance Médicale</p>
          <p>{{ $ordonnance->date }}</p>
          <p><strong>Nom & Prénom :</strong> {{ $ordonnance->consultation->rdv->patient->nom }} {{ $ordonnance->consultation->rdv->patient->prenom }}</p>
          <table border="1" cellpadding="10">
            <tr>
              <th>Médicament</th>
              <th>Dosage</th>
              <th>Quantité</th>
              <th>Nbr de fois par jour</th>
            </tr>
            <tr>
              <td>{{ $ordonnance->medicament }}</td>
              <td>{{ $ordonnance->dosage }}</td>
              <td>{{ $ordonnance->qte }}</td>
              <td>{{ $ordonnance->nbr_fois }}</td>
            </tr>
          </table>
           <p id="signature"><strong>Signature:</strong></p>
        </section>
        <footer>
          <hr>
          <p><strong>Email:</strong> {{ $ordonnance->consultation->rdv->medecin->email}} | <strong>Tél:</strong> {{ $ordonnance->consultation->rdv->medecin->telephone }}</p>
        </footer>


</body>
</html>