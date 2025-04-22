

@extends('layouts.adminLigue')
@section("title", "Importation des listes des joueurs")

@section('content')
<div class="min-h-screen bg-cover bg-center bg-no-repeat relative" style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/f/f2/Stade_Prince_Moulay_Abdellah.jpg/1920px-Stade_Prince_Moulay_Abdellah.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-80 "></div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 py-12">
        <div class="bg-white/80 backdrop-blur-md shadow-2xl rounded-xl overflow-hidden">
            <div class="bg-gray-100 px-6 py-4 border-b border-gray-300 text-xl font-semibold text-gray-800">
                ⚽ Importer des matchs
            </div>

            <div class="p-6 space-y-6">
                @if (session('success'))
                    <div class="p-4 bg-green-100 text-green-800 border border-green-300 rounded-lg shadow">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-4 bg-red-100 text-red-800 border border-red-300 rounded-lg shadow">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('games.import') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    
                    <div>
                        <div class="block text-sm font-medium text-gray-700 mb-1">
                            Ligue : <span class="font-bold text-lg"> {{ $ligue->nom_ligue }}</span>
                        </div>
                        <input value="{{ $ligue->id }}" id="ligue_id" name="ligue_id" type="hidden">
                        @error('ligue_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-1">Fichier Excel</label>
                        <input type="file" id="file" name="file" required 
                            class="block w-full border border-gray-300 text-gray-900 text-sm rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('file') border-red-500 @enderror">
                        @error('file')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-xs mt-1">Formats acceptés : xlsx, xls, csv</p>
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('games.template.download') }}" 
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-100 transition">
                            <i class="fa fa-download mr-2"></i> Télécharger le modèle
                        </a>

                        <button type="submit" 
                            class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 shadow-lg transition">
                            <i class="fa fa-upload mr-2"></i> Importer
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-gray-50 px-6 py-5 border-t border-gray-200">
                <div class="bg-blue-50 p-4 rounded-lg text-blue-800">
                    <h5 class="font-semibold mb-2">📝 Instructions :</h5>
                    <ol class="list-decimal list-inside space-y-1 text-sm mb-2">
                        <li>Téléchargez le modèle Excel</li>
                        <li>Remplissez les informations des matchs (une ligne par match)</li>
                        <li>Sélectionnez la ligue concernée</li>
                        <li>Importez le fichier complété</li>
                    </ol>
                    <p class="text-xs"><strong>Note :</strong> Pour chaque match, vous devez spécifier au minimum le numéro de journée et les IDs des équipes à domicile et à l'extérieur. Les autres informations (date, heure, stade, statut) sont optionnelles.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

