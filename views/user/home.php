

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

    <?php include '../views/includes/navbar.php'; ?>

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
                <a href="index.php?action=register" class="px-12 py-5 bg-temp-gold text-white uppercase tracking-widest text-xs font-bold hover:bg-white hover:text-temp-dark transition-all duration-500 shadow-2xl">
                    Rejoindre le club
                </a>
                <a href="index.php?action=login" class="px-12 py-5 border border-white text-white uppercase tracking-widest text-xs font-bold hover:bg-white hover:text-temp-dark transition-all duration-500">
                    Se connecter
                </a>
            </div>
        </div>
    </section>

    </body>
    </html>