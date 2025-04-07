<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion de Ligue de Football</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .football-bg {
            background-image: linear-gradient(rgba(0, 0, 0, 0.10), rgba(0, 0, 0, 0.7)), url({{asset('images/login/unnamed.jpg')}});
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="football-bg min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white bg-opacity-90 backdrop-blur-sm rounded-xl shadow-2xl overflow-hidden">

        <div class="bg-gradient-to-r from-blue-700 to-blue-500 p-2 text-center">
            <div class="flex justify-center ">
                <div class="bg-white p-3  rounded-full shadow-md">
                    <img src="{{asset('/images/login/logo-Lcdf.png')}}" class="h-16">
                </div>
            </div>
            <h1 class="text-2xl font-bold text-white">FootConnect</h1>
            <p class="text-blue-100">Bienvenue sur votre espace, veuillez vous identifier</p>
        </div>

        <div class="p-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Connexion</h2>
            
            <form>

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" id="email" name="email" class="pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="votre@email.com" required>
                    </div>
                </div>
                
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800 transition-colors">Mot de passe oublié?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" class="pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="••••••••" required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" id="togglePassword" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                           
                
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-500 text-white font-medium py-3 px-4 rounded-lg shadow hover:from-blue-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all flex items-center justify-center">
                    <span>Connexion</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
            
        </div>
        
        
    </div>


</body>
</html>