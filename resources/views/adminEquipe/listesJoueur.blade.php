@extends('layouts.adminEquipe')
@section("title", "Import Players")

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    body {
      font-family: 'Poppins', sans-serif;
    }
    
    .popup-overlay {
      opacity: 0;
      visibility: hidden;
      transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
      backdrop-filter: blur(5px);
    }
    
    .popup-overlay.active {
      opacity: 1;
      visibility: visible;
    }
    
    .popup-content {
      transform: translateY(-30px) scale(0.95);
      transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    .popup-overlay.active .popup-content {
      transform: translateY(0) scale(1);
    }
    
    .player-photo {
      background-size: cover;
      background-position: center;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    .close-btn {
      transition: transform 0.3s ease, color 0.3s ease;
    }
    
    .close-btn:hover {
      transform: rotate(90deg);
      color: #f8fafc;
    }
    
    .stat-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .stat-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    .header-bg {
      background: linear-gradient(120deg, #4338ca, #3b82f6, #0ea5e9);
      position: relative;
      overflow: hidden;
    }
    
    .header-bg::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.07' fill-rule='evenodd'/%3E%3C/svg%3E");
      opacity: 0.7;
    }
    
    .progress-bar {
      position: relative;
      height: 6px;
      border-radius: 3px;
      overflow: hidden;
    }
    
    .progress-bar-bg {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      transition: width 0.7s ease;
    }
  </style>
<main class="flex-1 overflow-x-hidden overflow-y-auto">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="px-4 py-4 md:px-6">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center space-y-3 md:space-y-0">
                <h2 class="text-xl font-semibold text-gray-800" id="mainTitle">Administration D'Équipe</h2>
                <div class="flex space-x-2">
                    <button id="btnExport"
                        class="bg-green-600 text-white px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-green-700 text-sm md:text-base">
                        Exporter
                    </button>
                    <button id="btnAction"
                        class="bg-blue-600 text-white px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 text-sm md:text-base">
                        Nouvelle Action
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div class="p-4 md:p-6">
        <div id="playerListsSection" class="section">
            <div class="bg-white rounded-lg shadow mb-6">
                <div class="p-4">
                    <div class="flex flex-col md:flex-row md:flex-wrap md:gap-4 space-y-3 md:space-y-0">
                        <div class="flex-1 min-w-[200px]">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Équipe</label>
                            <select class="w-full border rounded-lg px-3 py-2" id="teamFilter">
                                <option value="all">Toutes les équipes</option>
                            </select>
                        </div>
                        <div class="flex-1 min-w-[200px]">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                            <select class="w-full border rounded-lg px-3 py-2" id="statusFilter">
                                <option value="all">Tous les statuts</option>
                                <option value="pending">En attente</option>
                                <option value="validated">Validé</option>
                                <option value="rejected">Rejeté</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom Complet</th>                                <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de Naissance</th>

                                <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Numéro</th>

                                <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                                <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-4 md:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <div id="playerListsTable">
                           <tbody class="bg-white divide-y divide-gray-200" id="playerListsTableBody">
                               <!-- Data depuis JavaScript -->
                           </tbody>
                        </div>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>






 
<div class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
  
  <button id="openPopup" class=" hidden bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
    Voir le Joueur
  </button>
  
  <div id="playerPopup" class="popup-overlay fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 p-4">
    <div class="popup-content bg-white rounded-3xl shadow-2xl w-full max-w-xl overflow-hidden">
      <div class="relative header-bg p-6">
        <div class="flex justify-between items-center relative z-10">
          <div class="bg-white p-3 rounded-2xl shadow-lg transform -rotate-3">
            <img id="teamLogo" src="/api/placeholder/60/60" alt="Logo de l'équipe" class="h-12 w-12 object-contain">
          </div>
          <button id="closePopup" class="close-btn text-white hover:text-gray-200 transition duration-300 bg-white bg-opacity-20 p-2 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
      
      <div class="p-6 -mt-12">
        <div class="flex flex-col md:flex-row items-center gap-6">
          <div class="player-photo h-36 w-36 rounded-full border-4 border-white shadow-xl relative z-10" style="background-image: url('/api/placeholder/150/150')"></div>
          <div class="text-center md:text-left">
            <h2 id="playerName" class="text-3xl font-bold text-gray-800">Nom du Joueur</h2>
            <p id="playerTeam" class="text-blue-600 font-medium text-lg">Équipe du Joueur</p>
            <div class="flex items-center mt-2">
              <div id="statusIndicator" class="h-3 w-3 rounded-full bg-green-500 mr-2"></div>
              <p id="playerStatus" class="text-gray-600">Actif</p>
            </div>
          </div>
        </div>
        
        <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4">
          <div class="stat-card bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-2xl shadow">
            <p class="text-xs text-blue-600 uppercase font-semibold mb-1">Buts</p>
            <p id="playerGoals" class="text-3xl font-bold text-gray-800">24</p>
          </div>
          
          <div class="stat-card bg-gradient-to-br from-yellow-50 to-yellow-100 p-4 rounded-2xl shadow">
            <p class="text-xs text-yellow-600 uppercase font-semibold mb-1">Cartons</p>
            <div class="flex items-center space-x-2">
              <div class="flex flex-col items-center">
                <div class="w-4 h-6 bg-yellow-400 rounded-sm"></div>
                <p id="playerYellowCards" class="text-lg font-bold text-gray-800 mt-1">3</p>
              </div>
              <div class="flex flex-col items-center">
                <div class="w-4 h-6 bg-red-500 rounded-sm"></div>
                <p id="playerRedCards" class="text-lg font-bold text-gray-800 mt-1">0</p>
              </div>
            </div>
          </div>
          
          
          <div class="stat-card bg-gradient-to-br from-indigo-50 to-indigo-100 p-4 rounded-2xl shadow">
            <p class="text-xs text-indigo-600 uppercase font-semibold mb-1">Position</p>
            <p id="playerPosition" class="text-lg font-bold text-gray-800">Attaquant</p>
          </div>
          
          <div class="stat-card bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-2xl shadow">
            <p class="text-xs text-purple-600 uppercase font-semibold mb-1">Naissance</p>
            <p id="playerBirthdate" class="text-lg font-bold text-gray-800">20/12/1998</p>
          </div>
        </div>
        
        <div class="mt-8 space-y-4">
          <h3 class="text-lg font-semibold text-gray-700">Performance</h3>
          
          <div class="space-y-2">
            <div class="flex justify-between items-center">
              <p class="text-sm text-gray-600">Efficacité offensive</p>
              <p class="text-sm font-medium text-gray-800" id="offensiveEfficiency">85%</p>
            </div>
            <div class="progress-bar bg-gray-200">
              <div class="progress-bar-bg bg-blue-500" style="width: 85%"></div>
            </div>
          </div>
          
          <div class="space-y-2">
            <div class="flex justify-between items-center">
              <p class="text-sm text-gray-600">Efficacité défensive</p>
              <p class="text-sm font-medium text-gray-800" id="defensiveEfficiency">70%</p>
            </div>
            <div class="progress-bar bg-gray-200">
              <div class="progress-bar-bg bg-green-500" style="width: 70%"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-6 py-4 flex justify-between items-center">
        <span class="text-sm text-gray-500" id="playerNumber">Numéro: --</span>
        <button id="closePopupBtn" class="text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 font-medium py-2 px-4 rounded-lg transition duration-300 transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
          Fermer
        </button>
      </div>
    
    </div>
  </div>

  <script>
    

    const openBtn = document.getElementById('openPopup');
    const closeBtn = document.getElementById('closePopup');
    const popup = document.getElementById('playerPopup');

  openBtn.addEventListener('click', () => {
      loadPlayerData(playerData);
      popup.classList.add('active');
      document.body.style.overflow = 'hidden'; 
      animateProgressBars();
    });

    closeBtn.addEventListener('click', () => {
      popup.classList.remove('active');
      document.body.style.overflow = ''; 
    });

    popup.addEventListener('click', (e) => {
      if (e.target === popup) {
        popup.classList.remove('active');
        document.body.style.overflow = '';
      }
    });

    popup.classList.remove('active');
  </script>
</div>
</html>
    
</main>
<script src="{{asset("/js/adminEquipe/listeJoueur.js")}}"></script>
@endsection 