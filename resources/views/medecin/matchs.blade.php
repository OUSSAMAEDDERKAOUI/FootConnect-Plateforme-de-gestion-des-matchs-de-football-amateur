
@extends('layouts/medecin')
@section("title","Gestion des Matchs")
@section('content')

<header class="bg-white shadow-sm rounded-lg mb-6">
    <div class="px-6 py-5">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Affichage des Matchs</h2>
        </div>
    </div>
</header>



<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-md mb-8 border border-gray-100">
        <div class="p-5">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Filtres</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Période</label>
                    <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                        <option value="all">Tous les matchs</option>
                        <option value="upcoming">À venir</option>
                        <option value="past">Passés</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                    <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                        <option value="all">Tous les statuts</option>
                        <option value="scheduled">Programmé</option>
                        <option value="in_progress">En cours</option>
                        <option value="completed">Terminé</option>
                        <option value="cancelled">Annulé</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lieu</label>
                    <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                        <option value="all">Tous les lieux</option>
                        <option value="home">Domicile</option>
                        <option value="away">Extérieur</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100" id="tableMatchProgrammé">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date et Heure
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Équipes
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Lieu
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Résultat
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="matchsProgrammeTable">

                    
                </tbody>
            </table>
            {{-- <div id="pagination" class="flex justify-center mt-4 space-x-2"></div> --}}

        </div>
       
        
    </div>

   
</div>


<script src="{{asset('js/medecin/matchs.js')}}"></script>

    <script>

</script>

@endsection