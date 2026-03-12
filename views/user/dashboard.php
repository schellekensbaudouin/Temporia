<?php 
if (empty($_SESSION['user'])) {
    header('Location: index.php?action=login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <title>Temporia - Dashboard</title>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#F9F7F2] text-[#1A1A1A]">

    <header class="bg-white border-b border-[#E5E1D8] sticky top-0 z-50">
        <div class="max-w-[1440px] mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <span class="text-[10px] tracking-[0.3em] uppercase font-medium cursor-pointer">Contact</span>
            </div>
            <h1 class="font-serif text-3xl tracking-[0.2em] uppercase">Temporia</h1>
            <div class="flex items-center space-x-6">
                <svg class="w-5 h-5 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
        </div>
    </header>

    <div class="flex max-w-[1440px] mx-auto">
        
        <?php if($_SESSION['user']['role'] === "acheteur"): ?>
        
        <aside class="w-72 h-[calc(100vh-80px)] border-r border-[#E5E1D8] p-10 hidden lg:block sticky top-20">
            <nav class="space-y-12">
                <div>
                    <p class="text-[10px] tracking-[0.4em] uppercase text-[#A39274] mb-6 font-bold">Mon Espace</p>
                    <ul class="space-y-4 text-sm tracking-wide">
                        <li><a href="#" class="hover:italic hover:pl-2 transition-all block font-medium">Tableau de bord</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-black transition-colors block">Mes Achats</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-black transition-colors block">Ma Wishlist</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-black transition-colors block">Messages</a></li>
                    </ul>
                </div>
                <div>
                    <p class="text-[10px] tracking-[0.4em] uppercase text-[#A39274] mb-6 font-bold">Compte</p>
                    <ul class="space-y-4 text-sm tracking-wide">
                        <li><a href="#" class="text-gray-400 hover:text-black transition-colors block">Profil & Sécurité</a></li>
                        <li><a href="index.php?action=logout" class="text-red-900/60 hover:text-red-900 transition-colors block">Déconnexion</a></li>
                    </ul>
                </div>
            </nav>
        </aside>

        <main class="flex-1 p-8 lg:p-14">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="font-serif text-4xl italic mb-2">Bienvenue <?php echo $_SESSION['user']['username'] ?> dans l'élite</h2>
                    <p class="text-xs tracking-widest uppercase text-gray-500">Votre profil acheteur est actif.</p>
                </div>
                <a href="devenir_vendeur.php" class="bg-[#A39274] text-white text-[10px] tracking-[0.3em] uppercase px-8 py-4 hover:bg-[#1A1A1A] transition-colors shadow-xl">
                    Devenir Vendeur
                </a>
            </div>

            <div class="bg-white border border-[#E5E1D8] p-12 text-center mt-10">
                <h3 class="font-serif text-2xl mb-4">Vous possédez une pièce d'exception ?</h3>
                <p class="text-sm text-gray-500 max-w-lg mx-auto mb-8">
                    Rejoignez notre cercle très fermé de vendeurs certifiés et proposez vos montres de luxe à notre communauté internationale.
                </p>
                <a href="devenir_vendeur.php" class="inline-block border border-[#1A1A1A] text-[#1A1A1A] text-[10px] tracking-[0.3em] uppercase px-8 py-3 hover:bg-[#1A1A1A] hover:text-white transition-colors">
                    Commencer à vendre
                </a>
            </div>
        </main>


        <?php elseif($_SESSION['user']['roles'] === 'vendeur'): ?>
        
        <aside class="w-72 h-[calc(100vh-80px)] border-r border-[#E5E1D8] p-10 hidden lg:block sticky top-20">
            <nav class="space-y-12">
                <div>
                    <p class="text-[10px] tracking-[0.4em] uppercase text-[#A39274] mb-6 font-bold">Ma Collection</p>
                    <ul class="space-y-4 text-sm tracking-wide">
                        <li><a href="#" class="hover:italic hover:pl-2 transition-all block font-medium">Vue d'ensemble</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-black transition-colors block">Mes Annonces</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-black transition-colors block">Messages</a></li>
                    </ul>
                </div>
                <div>
                    <p class="text-[10px] tracking-[0.4em] uppercase text-[#A39274] mb-6 font-bold">Compte</p>
                    <ul class="space-y-4 text-sm tracking-wide">
                        <li><a href="#" class="text-gray-400 hover:text-black transition-colors block">Profil & Sécurité</a></li>
                        <li><a href="#" class="text-red-900/60 hover:text-red-900 transition-colors block">Déconnexion</a></li>
                    </ul>
                </div>
            </nav>
        </aside>

        <main class="flex-1 p-8 lg:p-14">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="font-serif text-4xl italic mb-2">Bienvenue, Monsieur</h2>
                    <p class="text-xs tracking-widest uppercase text-gray-500">Ravi de vous revoir parmi nous.</p>
                </div>
                <button class="bg-[#1A1A1A] text-white text-[10px] tracking-[0.3em] uppercase px-8 py-4 hover:bg-[#A39274] transition-colors shadow-xl">
                    Ajouter une pièce
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div class="bg-white border border-[#E5E1D8] p-10 text-center group hover:border-[#A39274] transition-colors">
                    <p class="text-[9px] tracking-[0.3em] uppercase text-[#A39274] mb-4">Annonces en ligne</p>
                    <span class="font-serif text-5xl">04</span>
                </div>
                <div class="bg-white border border-[#E5E1D8] p-10 text-center group hover:border-[#A39274] transition-colors">
                    <p class="text-[9px] tracking-[0.3em] uppercase text-[#A39274] mb-4">Messages non lus</p>
                    <span class="font-serif text-5xl text-[#A39274]">02</span>
                </div>
                <div class="bg-white border border-[#E5E1D8] p-10 text-center group hover:border-[#A39274] transition-colors">
                    <p class="text-[9px] tracking-[0.3em] uppercase text-[#A39274] mb-4">Ventes conclues</p>
                    <span class="font-serif text-5xl">12</span>
                </div>
            </div>

            <div class="bg-white border border-[#E5E1D8] p-8 text-center">
                 <h3 class="font-serif text-2xl italic mb-4">Espace de gestion de vos montres (Tableau)</h3>
                 <p class="text-xs text-gray-400">Le tableau complet de ton collègue va ici.</p>
            </div>
        </main>
        
        <?php endif; ?>
        </div>
</body>
</html>