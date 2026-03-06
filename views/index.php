<html lang="fr">
    
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temporia - Marketplace de Luxe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              'temp-dark': '#261e14',
              'temp-gold': '#D4AF37',
              'temp-sand': '#a68c76',
            }
          }
        }
      }
    </script>
      <style>
        /* L'animation de zoom lent qui manquait */
        @keyframes slowZoom {
            0% { transform: scale(1); }
            100% { transform: scale(1.15); }
        }
        .animate-slow-zoom {
            animation: slowZoom 15s infinite alternate ease-in-out;
        }
    </style>
</head>

    <body>
    <body class="bg-[#fdfcf0] overflow-x-hidden">

    <nav class="flex items-center justify-between px-8 py-6 bg-white border-b border-gray-100 relative z-30">
        <div class="flex items-center space-x-6">
            <a href="#" class="text-xs uppercase tracking-widest font-medium text-temp-dark">Contact</a>
            <button class="text-temp-dark"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"></path></svg></button>
        </div>
        <div class="text-3xl font-serif tracking-tighter uppercase font-bold text-temp-dark">Temporia</div>
        <div class="flex items-center space-x-5 text-temp-dark">
            <a href="connexion.php" class="hover:text-temp-gold transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></a>
            <a href="#" class="hover:text-temp-gold transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg></a>
        </div>
    </nav>

    <section class="relative h-[85vh] flex items-center justify-center overflow-hidden">
        
        <div class="absolute inset-0 z-0 bg-black">
            <img src="https://images.unsplash.com/photo-1542496658-e33a6d0d50f6?q=80&w=1920" 
                 class="w-full h-full object-cover opacity-50 animate-slow-zoom" 
                 alt="Montre de luxe sobre">
        </div>

        <div class="absolute inset-0 bg-gradient-to-b from-black/20 to-black/60 z-10"></div>

        <div class="relative z-20 text-center px-6">
            <h1 class="text-white text-6xl md:text-8xl font-serif uppercase tracking-[0.4em] mb-4 drop-shadow-2xl">
                Temporia
            </h1>
            <p class="text-temp-sand text-sm md:text-lg uppercase tracking-[0.3em] mb-12 font-medium drop-shadow-md">
                L'excellence horlogère, d'une main à l'autre
            </p>

            <div class="flex flex-col md:flex-row gap-6 justify-center">
                <a href="inscription.php" class="px-12 py-5 bg-temp-gold text-white uppercase tracking-widest text-xs font-bold hover:bg-white hover:text-temp-dark transition-all duration-500 shadow-2xl">
                    Rejoindre le club
                </a>
                <a href="connexion.php" class="px-12 py-5 border border-white text-white uppercase tracking-widest text-xs font-bold hover:bg-white hover:text-temp-dark transition-all duration-500">
                    Se connecter
                </a>
            </div>
        </div>
    </section>

    </body>
    </html>