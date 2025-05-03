<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FootConnect -Arbitre @yield('title') </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @media (max-width: 768px) {
            .sidebar-mobile {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            
            .sidebar-mobile.open {
                transform: translateX(0);
            }
            
            .overlay {
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s, visibility 0.3s;
            }
            
            .overlay.active {
                opacity: 1;
                visibility: visible;
            }
            #btnExportAction{
                /* visibility: hidden; */

            }
        }
        @yield('style')

    </style>
</head>

<body class="bg-gray-100">
    <div class="overlay fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden" id="overlay"></div>

    <div class="flex flex-col h-screen">

        <header class="bg-blue-800 text-white md:hidden">
            <div class="flex justify-between items-center p-4">
                <h1 class="text-xl font-bold">FootConnect</h1>
                <button id="menuToggle" class="focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </header>
    <div class="flex flex-1 overflow-hidden">

    


           

            <main class="flex-1 overflow-x-hidden overflow-y-auto">
             @yield('content')
                </main>
                
              



    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>
    
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js/pagination.js') }}"></script>


<script>
    function logout() {
        Cookies.remove('Access-Token');
        window.location.href = '/auth/login';
    }

</script>
 </body>
</html>

                       