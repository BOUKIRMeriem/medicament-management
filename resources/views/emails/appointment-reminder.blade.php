<!DOCTYPE html>
<html>
<head>
    <title>Rappel de rendez-vous</title>
</head>
<body>
    <h3>Rappel de rendez-vous</h3>
    <p>Bonjour {{ $rdv->patient->nom }},</p>
    <p>Ceci est un rappel pour votre rendez-vous avec le Dr. {{ $rdv->medecin->nom }} demain à {{ $rdv->heure }}.</p>
    <p>N'oubliez pas d'être à l'heure pour votre rendez-vous.</p>
    <p>Salutations,</p>
    <p>Votre cabinet médical</p>
</body>
</html>