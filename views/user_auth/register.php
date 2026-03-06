

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire - Temporia</title>
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
                <h2 class="text-3xl font-serif uppercase tracking-widest mb-2">Créer un compte</h2>
                <p class="text-temp-sand text-xs uppercase tracking-widest">Rejoignez l'élite horlogère</p>
            </header>

            <form action="inscription_user.php" method="POST" class="space-y-8">
                <div class="relative">
                    <input type="text" name="username" required placeholder=" " class="peer w-full border-b border-gray-300 py-2 outline-none focus:border-temp-gold transition-colors bg-transparent">
                    <label class="absolute left-0 top-2 text-gray-400 text-xs uppercase tracking-widest transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:top-2 peer-focus:-top-4 peer-focus:text-xs peer-focus:text-temp-gold">Nom complet</label>
                </div>
                <div class="relative">
                    <input type="email" name="email" required placeholder=" " class="peer w-full border-b border-gray-300 py-2 outline-none focus:border-temp-gold transition-colors bg-transparent">
                    <label class="absolute left-0 top-2 text-gray-400 text-xs uppercase tracking-widest transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:top-2 peer-focus:-top-4 peer-focus:text-xs peer-focus:text-temp-gold">Adresse Email</label>
                </div>
                <div class="relative">
                    <input type="password" name="password" required placeholder=" " class="peer w-full border-b border-gray-300 py-2 outline-none focus:border-temp-gold transition-colors bg-transparent">
                    <label class="absolute left-0 top-2 text-gray-400 text-xs uppercase tracking-widest transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:top-2 peer-focus:-top-4 peer-focus:text-xs peer-focus:text-temp-gold">Mot de passe</label>
                </div>
                <div class="pt-4">
                    <button type="submit" class="w-full bg-temp-dark text-white py-4 uppercase tracking-[0.2em] text-xs font-bold hover:bg-temp-gold transition-all duration-500 shadow-lg">S'inscrire</button>
                </div>
            </form>

            <footer class="mt-10 text-center">
                <p class="text-gray-400 text-xs uppercase tracking-widest">Déjà membre ? <a href="connexion.php" class="text-temp-gold hover:underline ml-1">Se connecter</a></p>
            </footer>
        </div>
    </main>

</body>
</html>