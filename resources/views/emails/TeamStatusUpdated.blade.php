<!DOCTYPE html>
<html>
<head>
    <title>Statut de l'équipe mis à jour</title>
</head>
<body>
    <h1>Statut de l'équipe  {{$equipe->nom}} mis à jour</h1>
    <h3>Le statut de l'équipe {{ $equipe->nom }} a été mis à jour à : {{ $equipe->statut }}.</h3>
    <h3>
        Mis à jour le {{ date('d/m/Y à H:i') }}

    </h3>

</body>
</html>
