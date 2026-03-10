<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Temporia</title>
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
</head>
<body class="bg-[#fdfcf0] text-temp-dark min-h-screen flex flex-col">

    <nav class="flex items-center justify-between px-8 py-6 bg-white border-b border-gray-100">
        <a href="index.php" class="text-xs uppercase tracking-widest font-medium">Retour</a>
        <div class="text-2xl font-serif tracking-tighter uppercase font-bold">Temporia</div>
        <div class="w-10"></div>
    </nav>

    <main class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="bg-white p-8 md:p-12 shadow-2xl w-full max-w-md border border-gray-100">
            
            <header class="text-center mb-10">
                <h2 class="text-3xl font-serif uppercase tracking-widest mb-2">Connexion</h2>
                <p class="text-temp-sand text-xs uppercase tracking-widest">Ravi de vous revoir</p>
            </header>

            <?php if(isset($_GET['error'])): ?>
            <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 flex items-center space-x-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <p class="text-xs uppercase tracking-widest font-bold">Identifiants incorrects</p>
            </div>
            <?php endif; ?>

            <form action="index.php?action=login" method="POST" class="space-y-8">
                
                <div class="relative">
                    <input type="email" name="email" required placeholder=" " 
                           class="peer w-full border-b border-gray-300 py-2 outline-none focus:border-temp-gold transition-colors bg-transparent">
                    <label class="absolute left-0 top-2 text-gray-400 text-xs uppercase tracking-widest transition-all 
                                  peer-placeholder-shown:text-sm peer-placeholder-shown:top-2 
                                  peer-focus:-top-4 peer-focus:text-xs peer-focus:text-temp-gold">
                        Adresse Email
                    </label>
                </div>

                <div class="relative">
                    <input type="password" name="password" required placeholder=" "
                           class="peer w-full border-b border-gray-300 py-2 outline-none focus:border-temp-gold transition-colors bg-transparent">
                    <label class="absolute left-0 top-2 text-gray-400 text-xs uppercase tracking-widest transition-all 
                                  peer-placeholder-shown:text-sm peer-placeholder-shown:top-2 
                                  peer-focus:-top-4 peer-focus:text-xs peer-focus:text-temp-gold">
                        Mot de passe
                    </label>
                </div>

                <div class="pt-4">
                    <button type="submit" 
                            class="w-full bg-temp-dark text-white py-4 uppercase tracking-[0.2em] text-xs font-bold 
                                   hover:bg-temp-gold transition-all duration-500 shadow-lg">
                        Se connecter
                    </button>
                </div>
            </form>

            <footer class="mt-10 text-center">
                <p class="text-gray-400 text-xs uppercase tracking-widest">
                    Pas encore membre ? 
                    <a href="index.php?action=register" class="text-temp-gold hover:underline ml-1">Créer un compte</a>
                </p>
            </footer>
        </div>
    </main>

</body>
</html>