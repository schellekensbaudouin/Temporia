<?php 
if (empty($_SESSION['user'])) {
    header('Location: index.php?action=login');
    exit;
}

/* requete sql select pour afficher les donner des annoces de */



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

        <!--  inclure la navbar mais faut voir avec le disign !  -->
        
        <aside class="w-72 h-[calc(100vh-80px)] border-r border-[#E5E1D8] p-10 hidden lg:block sticky top-20">
            <nav class="space-y-12">
                <div>
                    <p class="text-[10px] tracking-[0.4em] uppercase text-[#A39274] mb-6 font-bold">Mon Espace</p>
                    <ul class="space-y-4 text-sm tracking-wide">
                        <li><a href="index.php?action=dashboard" class="hover:italic hover:pl-2 transition-all block font-medium">Tableau de bord</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-black transition-colors block">Mes Achats</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-black transition-colors block">Ma Wishlist</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-black transition-colors block">Messages</a></li>
                    </ul>
                </div>
                <div>
                    <p class="text-[10px] tracking-[0.4em] uppercase text-[#A39274] mb-6 font-bold">Compte</p>
                    <ul class="space-y-4 text-sm tracking-wide">
                        <li><a href="index.php?action=profile_acheteur" class="text-gray-400 hover:text-black transition-colors block">Profil & Sécurité</a></li>
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
                <a href="index.php?action=devenir_vendeur" class="bg-[#A39274] text-white text-[10px] tracking-[0.3em] uppercase px-8 py-4 hover:bg-[#1A1A1A] transition-colors shadow-xl">
                    Devenir Vendeur
                </a>
            </div>

        <section id="#MesAchats">
            <h2 class="font-serif text-4xl italic mb-6">Mes Achats</h2>

        <?php if (empty($achats)): ?>
            <div class="bg-white border border-[#E5E1D8] p-12 text-center">
                <p class="text-gray-500 text-sm">Tu n’as encore rien acheté.</p>
            </div>
        <?php else: ?>
            <div class="bg-white border border-[#E5E1D8] shadow rounded-lg overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-[#F3F1ED]">
                        <tr>
                            <th class="p-4 text-xs tracking-[0.3em] uppercase">Produit</th>
                            <th class="p-4 text-xs tracking-[0.3em] uppercase">Prix</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($actiles as $actile): ?>
                            <tr class="border-t border-[#E5E1D8] hover:bg-[#F9F7F2] transition-colors">
                                <td class="p-4 text-sm"><?= htmlspecialchars($actile['title']) ?></td>
                                <td class="p-4 text-sm"><?= htmlspecialchars($actile['prix']) ?> </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
        </section>

            <div class="bg-white border border-[#E5E1D8] p-12 text-center mt-10">
                <h3 class="font-serif text-2xl mb-4">Vous possédez une pièce d'exception ?</h3>
                <p class="text-sm text-gray-500 max-w-lg mx-auto mb-8">
                    Rejoignez notre cercle très fermé de vendeurs certifiés et proposez vos montres de luxe à notre communauté internationale.
                </p>
                <a href="index.php?action=devenir_vendeur" class="inline-block border border-[#1A1A1A] text-[#1A1A1A] text-[10px] tracking-[0.3em] uppercase px-8 py-3 hover:bg-[#1A1A1A] hover:text-white transition-colors">
                    Commencer à vendre
                </a>
            </div>
        </main>


        <?php elseif($_SESSION['user']['role'] === 'vendeur'): ?>
        
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
                        <li><a href="index.php?action=profile_vendeur" class="text-gray-400 hover:text-black transition-colors block">Profil & Sécurité</a></li>
                        <li><a href="index.php?action=logout" class="text-red-900/60 hover:text-red-900 transition-colors block">Déconnexion</a></li>
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

                <section id="#MesAnnonces">
            <h2 class="font-serif text-4xl italic mb-6">Mes Annonces</h2>

                    <?php if (empty($annonces)): ?>
                        <div class="bg-white border border-[#E5E1D8] p-12 text-center">
                            <p class="text-gray-500 text-sm">Vous n’avez encore mis aucune annonce en ligne.</p>
                        </div>
                    <?php else: ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php foreach ($annonces as $annonce): ?>
                                <div class="bg-white border border-[#E5E1D8] rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                                    <!-- Image de l'annonce -->
                                    <img src="<?= htmlspecialchars($annonce['image_url']) ?>" alt="<?= htmlspecialchars($annonce['titre']) ?>" class="card-img w-full">

                                    <div class="p-4">
                                        <h3 class="font-serif text-lg mb-1"><?= htmlspecialchars($annonce['titre']) ?></h3>
                                        <p class="text-sm text-gray-500 mb-1">Prix: <?= htmlspecialchars($annonce['prix']) ?> €</p>
                                        <p class="text-xs text-gray-400 mb-3">Créée le: <?= htmlspecialchars($annonce['date_creation']) ?></p>
                                        <a href="index.php?action=modifier_annonce&id=<?= $annonce['id'] ?>" class="text-sm text-[#A39274] hover:text-black">Modifier</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    </section>

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
        
<?php elseif ($_SESSION['user']['role'] === 'admin'): ?>

            <aside class="w-72 h-[calc(100vh-80px)] border-r border-[#E5E1D8] p-10 hidden lg:block sticky top-20">
                <nav class="space-y-12">
                    <div>
                        <p class="text-[10px] tracking-[0.4em] uppercase text-[#A39274] mb-6 font-bold">Back-Office</p>
                        <ul class="space-y-4 text-sm tracking-wide">
                            <li><a href="#" class="hover:italic hover:pl-2 transition-all block font-medium">Vue
                                    d'ensemble</a></li>
                            <li><a href="#" class="text-[#A39274] font-bold block">Dossiers Vendeurs</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-black transition-colors block">Gestion
                                    Utilisateurs</a></li>
                        </ul>
                    </div>
                    <div>
                        <p class="text-[10px] tracking-[0.4em] uppercase text-[#A39274] mb-6 font-bold">Compte</p>
                        <ul class="space-y-4 text-sm tracking-wide">
                            <li><a href="index.php?action=logout"
                                    class="text-red-900/60 hover:text-red-900 transition-colors block">Déconnexion</a></li>
                        </ul>
                    </div>
                </nav>
            </aside>

            <main class="flex-1 p-8 lg:p-14">
                <header class="mb-12 border-b border-[#E5E1D8] pb-6">
                    <h2 class="font-serif text-4xl italic mb-2">Panel d'Administration</h2>
                    <p class="text-xs tracking-widest uppercase text-gray-500">Contrôle et validation</p>
                </header>

                <section class="bg-white border border-[#E5E1D8] p-8 shadow-sm">
                    <h3 class="text-[10px] tracking-[0.3em] uppercase font-bold text-[#A39274] mb-6">Demandes Vendeurs en
                        attente</h3>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="border-b border-[#E5E1D8] text-gray-400 uppercase tracking-widest text-[9px]">
                                <tr>
                                    <th class="pb-3 font-medium">Candidat</th>
                                    <th class="pb-3 font-medium">Boutique</th>
                                    <th class="pb-3 font-medium">Statut</th>
                                    <th class="pb-3 font-medium text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#E5E1D8]">
                                <tr class="hover:bg-[#F9F7F2] transition-colors">
                                    <td class="py-4 font-bold">Jean Dupont</td>
                                    <td class="py-4 italic text-gray-600">Vintage Watches</td>
                                    <td class="py-4"><span
                                            class="bg-yellow-100 text-yellow-800 text-[9px] font-bold uppercase px-2 py-1">En
                                            attente</span></td>
                                    <td class="py-4 text-right">
                                        <a href="index.php?action=examiner_vendeur&id=1"
                                            class="bg-[#1A1A1A] text-white px-4 py-2 text-[9px] uppercase tracking-widest hover:bg-[#A39274] transition-colors">Examiner</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </main>

        <?php endif; ?>

        </div>
</body>
</html>