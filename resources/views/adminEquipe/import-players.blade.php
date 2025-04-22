
@extends('layouts.adminEquipe')
@section("title", "Import Players")

@section('content')
<div class="min-h-screen bg-cover bg-center bg-no-repeat relative"
     style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/f/f2/Stade_Prince_Moulay_Abdellah.jpg/1920px-Stade_Prince_Moulay_Abdellah.jpg');">
    
    <div class="absolute inset-0 bg-gradient-to-br from-black/80 via-black/60 to-gray-800/80"></div>

    <div class="relative z-10 flex items-center justify-center py-16 px-4">

        <div class="w-full max-w-3xl bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl overflow-hidden border border-white/20 relative"
     style="background-image: url('https://fr.alyaoum24.com/content/uploads/2022/06/Raja-710x500-1.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;">
          
    

            <div class="bg-gradient-to-r from-blue-500 to-indigo-700 px-6 py-6 text-white flex flex-col items-center">
                <h2 class="text-2xl font-bold">⚽ Importation des joueurs</h2>
                <p class="text-sm text-blue-100">Ajoutez vos joueurs via un fichier Excel</p>
            </div>

            <div class="p-8 space-y-6 text-white">
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded shadow">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 text-red-800 px-4 py-2 rounded shadow">{{ session('error') }}</div>
                @endif

                <form action="{{ route('players.import') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm mb-1">Équipe :</label>
                        <div class="font-semibold text-lg text-white">{{ $equipes->nom }}</div>
                        <input type="hidden" name="equipe_id" value="{{ $equipes->id }}">
                        @error('equipe_id')
                            <p class="text-red-300 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="file" class="block text-sm mb-1">Fichier Excel</label>
                        <input type="file" name="file" id="file" required
                            class="block w-full px-4 py-2 rounded-md   text-white font-semibold shadow focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <p class="text-xs text-gray-300 mt-1 font-bold text-2xl ">Formats acceptés : .xlsx, .xls, .csv</p>
                        @error('file')
                            <p class="text-red-300 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap gap-4 items-center">
                        <a href="{{ route('players.template.download') }}"
                            class="px-4 py-2 bg-white text-gray-800 rounded-md shadow hover:bg-gray-100 transition">
                            <i class="fa fa-download mr-2"></i> Télécharger le modèle
                        </a>

                        <button type="submit"
                            class="px-5 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md font-medium shadow transition">
                            <i class="fa fa-upload mr-2"></i> Importer
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white/10 border-t border-white/20 px-8 py-5 text-sm text-white">
                <h5 class="font-semibold mb-2">📋 Instructions :</h5>
                <ul class="list-disc list-inside space-y-1">
                    <li>Téléchargez le fichier modèle</li>
                    <li>Remplissez les infos des joueurs</li>
                    <li>Sélectionnez l’équipe concernée</li>
                    <li>Importez le fichier ici</li>
                </ul>
                <p class="mt-2 text-xs text-gray-300">
                    ⚠️ Les photos doivent être ajoutées <strong>sous forme d’URL</strong> dans le fichier Excel, ou manuellement après l'importation.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
