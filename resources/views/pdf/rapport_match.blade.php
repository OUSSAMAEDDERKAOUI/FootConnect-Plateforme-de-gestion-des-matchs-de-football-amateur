<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Rapport de match</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .header h1 {
            font-size: 20px;
            margin: 0;
            padding: 0;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .match-info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .match-info table {
            width: 100%;
            border-collapse: collapse;
        }
        .match-info td {
            padding: 5px;
        }
        .match-info td.label {
            font-weight: bold;
            width: 30%;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            font-size: 16px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .section table {
            width: 100%;
            border-collapse: collapse;
        }
        .section th, .section td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }
        .section th {
            background-color: #f5f5f5;
        }
        .observations {
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            text-align: center;
            color: #666;
            font-size: 10px;
        }
        .signature {
            margin-top: 40px;
        }
        .signature p {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>RAPPORT OFFICIEL DE MATCH</h1>
        <p>Fédération / Ligue</p>
        <p>Date: {{ $date }}</p>
    </div>
    
    <div class="match-info">
        <table>
            <tr>
                <td class="label">Match :</td>
                <td><strong>{{ $equipe_domicile->nom }} vs {{ $equipe_exterieur->nom }}</strong></td>
            </tr>
            <tr>
                <td class="label">Date du match :</td>
                <td>{{ \Carbon\Carbon::parse($game->date_time)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="label">Heure du match :</td>
                <td>{{ \Carbon\Carbon::parse($game->date_time)->format('H:i') }}</td>
            </tr>
            <tr>
                <td class="label">Lieu :</td>
                <td>{{ $game->stade ?? 'Non spécifié' }}</td>
            </tr>
            <tr>
                <td class="label">Score final :</td>
                <td><strong>{{ $game->score_domicile }} - {{ $game->score_exterieur }}</strong></td>
            </tr>
        </table>
    </div>
    
    <div class="section">
        <h2>Événements du match</h2>
        
        @if(count($buteurs) > 0)
        <h3>Buts</h3>
        <table>
            <thead>
                <tr>
                    <th>Équipe</th>
                    <th>Joueur</th>
                    <th>Minute</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buteurs as $buteur)
                <tr>
                    <td>
                        @if($buteur->joueur->equipe_id == $game->equipe_domicile_id)
                            {{ $equipe_domicile->nom }}
                        @else
                            {{ $equipe_exterieur->nom }}
                        @endif
                    </td>
                    <td>{{ $buteur->joueur->user->nom }} {{ $buteur->joueur->user->prenom }}</td>
                    <td>{{ $buteur->minute }}'</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        
        @if(count($sanctions) > 0)
        <h3>Cartons</h3>
        <table>
            <thead>
                <tr>
                    <th>Équipe</th>
                    <th>Joueur</th>
                    <th>Type</th>
                    <th>Minute</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sanctions as $sanction)
                <tr>
                    <td>
                        @if($sanction->joueur->equipe_id == $game->equipe_domicile_id)
                            {{ $equipe_domicile->nom }}
                        @else
                            {{ $equipe_exterieur->nom }}
                        @endif
                    </td>
                    <td>{{ $sanction->joueur->user->nom }} {{ $sanction->joueur->user->prenom }}</td>
                    <td>{{ $sanction->type }}</td>
                    <td>{{ $sanction->minute }}'</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        
        @if(count($changements) > 0)
        <h3>Remplacements</h3>
        <table>
            <thead>
                <tr>
                    <th>Équipe</th>
                    <th>Joueur entrant</th>
                    <th>Joueur sortant</th>
                    <th>Minute</th>
                </tr>
            </thead>
            <tbody>
                @foreach($changements as $changement)
                <tr>
                    <td>
                        @if($changement->equipe_id == $game->equipe_domicile_id)
                            {{ $equipe_domicile->nom }}
                        @else
                            {{ $equipe_exterieur->nom }}
                        @endif
                    </td>
                    <td>{{ $changement->joueurEntree->user->nom }} {{ $changement->joueurEntree->user->prenom }}</td>
                    <td>{{ $changement->joueurSortie->user->nom }} {{ $changement->joueurSortie->user->prenom }}</td>
                    <td>{{ $changement->minute }}'</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    
    <div class="observations">
        <h2>Observations</h2>
        <p>{{ $rapport->observations ?? 'Aucune observation' }}</p>
    </div>
    
    <div class="observations">
        <h2>Réserves</h2>
        <p>{{ $rapport->reserves ?? 'Aucune réserve' }}</p>
    </div>
    
    <style>
        .signatures-container {
            width: 100%;
            margin-top: 40px;
        }
        
        table.signatures-table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }
        
        table.signatures-table td {
            width: 50%;
            vertical-align: top;
            border: none;
        }
        
        .signature-title {
            font-weight: bold;
            font-size: 12px;
            margin-bottom:10px 
        }
        
      
        
        .signature-name {
            font-size: 10px;
            color: #333;
            margin-bottom:10px 

        }
        
       
    </style>
    
    <div class="signatures-container">
        <table class="signatures-table">
            <tr>
                <td>
                    <div class="signature-title">Signature de l'arbitre central</div>
                    <div class="signature-name">{{ $arbitreCentral->user->nom ?? 'N/A' }} {{ $arbitreCentral->user->prenom ?? '' }}  ..........................................</div>
                </td>
                <td>
                    <div class="signature-title">Signature du premier arbitre assistant</div>
                    <div class="signature-name">{{ $assistant1->user->nom ?? 'N/A' }} {{ $assistant1->user->prenom ?? '' }}  ..........................................</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="signature-title">Signature du deuxième arbitre assistant</div>
                    <div class="signature-name">{{ $assistant2->user->nom ?? 'N/A' }} {{ $assistant2->user->prenom ?? '' }} ..........................................</div>
                </td>
                <td>
                    <div class="signature-title">Signature du délégué</div>
                    <div class="signature-name">{{ $delegue->user->nom ?? 'N/A' }} {{ $delegue->user->prenom ?? '' }} ..........................................</div>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="footer">
        <p>Rapport généré automatiquement le {{ $date }}</p>
    </div>
</body>
</html>