<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FootConnect -Administration Fédération @yield('title') </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <aside class="w-64 bg-blue-800 text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold mb-8">FootConnect</h1>
                <nav class="space-y-2">
                    <a href="index.html" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700">
                        Tableau de bord
                    </a>
                    <a href="#"
                        class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 active bg-blue-700"
                        id="playerListsTab">
                        Listes des Joueurs
                    </a>
                    <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700"
                        id="injuriesTab">
                        Blessures
                    </a>
                    <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700"
                        id="sanctionsTab">
                        Sanctions
                    </a>
                    <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700"
                        id="matchesTab">
                        Matchs
                    </a>
                    <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700"
                        id="statisticsTab">
                        Statistiques
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Header -->
            <header class="bg-white shadow">
                <div class="px-6 py-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800" id="mainTitle">Administration Fédération</h2>
                        <div class="space-x-2">
                            <button id="btnExport"
                                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                                Exporter
                            </button>
                            <button id="btnAction"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                Nouvelle Action
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto">
             @yield('content')
                </main>
                
              
                        </body>
                        </html>