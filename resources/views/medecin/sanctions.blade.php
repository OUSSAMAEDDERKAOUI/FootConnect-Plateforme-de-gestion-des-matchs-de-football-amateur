@extends('layouts/medecin')
@section("title","Les sanctions par Equipe")
@section('content')
<style>
    body {
      background-color: #f3f4f6;
    }
    
    .popup-overlay {
      backdrop-filter: blur(5px);
      background-color: rgba(0, 0, 0, 0.6);
      transition: all 0.3s ease;
    }
    
    .popup-card {
      animation: slideIn 0.4s ease-out;
      position: relative;
    }
    
    .content-wrapper {
      background-color: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(2px);
    }
    
    @keyframes slideIn {
      0% {
        opacity: 0;
        transform: translateY(-20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .card-shadow {
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
    }
    
    .yellow-card {
      background: linear-gradient(135deg, #FFD700 0%, #FFC107 100%);
    }
    
    .red-card {
      background: linear-gradient(135deg, #FF416C 0%, #FF4B2B 100%);
    }
    
    .suspension {
      background: linear-gradient(135deg, #2C3E50 0%, #4CA1AF 100%);
    }

    .team-badge {
      width: 30px;
      height: 30px;
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
    }
    
    .soccer-field-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-image: url('/api/placeholder/800/600');
      background-size: cover;
      background-position: center;
      opacity: 0.15;
      z-index: 0;
      border-radius: 0.5rem;
      overflow: hidden;
    }
  </style>
<header class="bg-white shadow">
    <div class="px-6 py-4">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Gestion des Sanctions</h2>
        </div>
    </div>
</header>

<div class="p-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Suspensions</h3>
                    <p id="suspensions" class="text-2xl font-semibold">-</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 11c1.104 0 2-.896 2-2V7a2 2 0 00-4 0v2c0 1.104.896 2 2 2zm6 0h-1V9a5 5 0 00-10 0v2H6a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2v-7a2 2 0 00-2-2z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Cartons Rouges</h3>
                    <p id="carte_rouge" class="text-2xl font-semibold">-</p>
                   
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 11c1.104 0 2-.896 2-2V7a2 2 0 00-4 0v2c0 1.104.896 2 2 2zm6 0h-1V9a5 5 0 00-10 0v2H6a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2v-7a2 2 0 00-2-2z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Cartons Jaunes</h3>
                    <p id="carte_jaune" class="text-2xl font-semibold">-</p>
                </div>
            </div>
        </div>
     
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Avertissements</h3>
                    <p id="Avertissements" class="text-2xl font-semibold">-</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-4">
            <div class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Rechercher un joueur..." 
                               class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 text-gray-500 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <select class="w-full border rounded-lg px-3 py-2">
                        <option value="all">Type de sanction</option>
                        <option value="suspension">Suspension</option>
                        <option value="warning">Avertissement</option>
                        <option value="fine">Amende</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <select class="w-full border rounded-lg px-3 py-2">
                        <option value="all">Statut</option>
                        <option value="active">En cours</option>
                        <option value="completed">Terminée</option>
                        <option value="cancelled">Annulée</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <input type="date" class="w-full border rounded-lg px-3 py-2" placeholder="Date">
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Joueur
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type de Sanction
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Période
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Raison
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="sanctionsTableBody">
                   
                </tbody>
            </table>
        </div>
        <div id="sanctionsPaginationBody" class="px-6 py-4 border-t border-gray-200">
          
        </div>
    </div>
</div>




<div id="sanctionContent" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">

{{-- depuis js  --}}


</div>


<script src='{{asset("js/medecin/sanctions.js")}}'> </script>


@endsection