@extends('layouts/adminLigue')
@section("title","listes des joueurs")
@section('content')

<header class="bg-white shadow">
    <div class="px-6 py-4">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800" id="mainTitle">Administration Fédération</h2>
            <div class="space-x-2 hidden sm:block " id="btnExportAction">
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

<div class="p-4 md:p-6">
    <!-- Player Lists Section -->
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
                <table class="min-w-full  divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Équipe</th>
                            <th
                                class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date</th>
                            <th
                                class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Joueurs</th>
                            <th
                                class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut</th>
                            <th
                                class="px-4 md:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="playerListsTableBody">
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap">test of the test</td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap">test of the test</td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap">test of the test</td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">
                                accepte
                            </span>
                        </td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-blue-600 hover:text-blue-900 mr-2">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</main>
</div>
</div>



@endsection
