
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profil de l'employé</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        .header {
            text-align: left;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table, .table th, .table td {
            border: 1px solid black;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
        img {
            width: 50px;
            border-radius: 50%;
            height: 50px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Profil de {{ $employe->Nom }} {{ $employe->Prenom }}</h2>
    </div>
    <table class="table">
        <tr>
            <th>Nom</th>
            <td>{{ $employe->Nom }}</td>
        </tr>
        <tr>
            <th>Prenom</th>
            <td>{{ $employe->Prenom }}</td>
        </tr>
        <tr>
            <th>Sexe</th>
            <td>{{ $employe->Sexe }}</td>
        </tr>
        <tr>
            <th>Naissance</th>
            <td>{{ $employe->Naissance }}</td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td>{{ $employe->Adresse }}</td>
        </tr>
        <tr>
            <th>Numero</th>
            <td>{{ $employe->Numero }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $employe->Email }}</td>
        </tr>
        <tr>
            <th>Image</th>
            <td>
                <img src="{{ $employe->images }}" alt="Image de {{ $employe->Nom }} {{ $employe->Prenom }}">
            </td>
        </tr>
        <tr>
            <th>Poste</th>
            <td>{{ $employe->Poste }}</td>
        </tr>
    </table>
</body>
</html>
