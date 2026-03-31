<?php
// Simulation de fausses annonces en attendant le Back-end
$annonces = [
    ['titre' => 'Rolex Submariner Date', 'prix' => 12500, 'devise' => '€', 'img' => 'https://images.unsplash.com/photo-1523170335258-f5ed11844a49?auto=format&fit=crop&q=80&w=500', 'categorie' => 'Plongée'],
    ['titre' => 'Omega Speedmaster', 'prix' => 6200, 'devise' => '€', 'img' => '/Temporia/public/assets/images/omega.png', 'categorie' => 'Chronographe'],
    ['titre' => 'Patek Philippe Nautilus', 'prix' => 85000, 'devise' => '€', 'img' => 'https://images.unsplash.com/photo-1639006570490-79c0c53f1080?auto=format&fit=crop&q=80&w=500', 'categorie' => 'Luxe'],
    ['titre' => 'Audemars Piguet Royal Oak', 'prix' => 45000, 'devise' => '€', 'img' => '/Temporia/public/assets/images/ap.png', 'categorie' => 'Luxe'],
];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=Inter:wght@300;400;600&display=swap"
        rel="stylesheet">
    <title>Temporia - Notre Collection</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        /* Cacher la barre de défilement pour un look plus clean sur les filtres */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-[#F9F7F2] text-[#1A1A1A]">

    <?php include '../views/includes/navbar.php'; ?>

    <header class="text-center py-16 border-b border-[#E5E1D8] bg-white">
        <h1 class="font-serif text-4xl md:text-5xl italic mb-4">Notre Collection</h1>
        <p class="text-[10px] tracking-[0.3em] uppercase text-gray-500 max-w-xl mx-auto">
            Découvrez des garde-temps d'exception, vérifiés et certifiés par nos experts.
        </p>
    </header>

    <main class="max-w-[1440px] mx-auto px-6 py-12 flex flex-col lg:flex-row gap-12">

        <aside class="w-full lg:w-64 flex-shrink-0">
            <div class="sticky top-8 space-y-10">

                <div class="flex justify-between items-center lg:hidden mb-6 border-b border-[#E5E1D8] pb-4">
                    <span class="text-[10px] font-bold tracking-[0.2em] uppercase">Filtres</span>
                    <button class="text-[#A39274] text-sm">Afficher</button>
                </div>

                <div class="hidden lg:block">
                    <h3
                        class="text-[10px] font-bold tracking-[0.3em] uppercase text-[#A39274] mb-4 border-b border-[#E5E1D8] pb-2">
                        Marques</h3>
                    <select name="brand"
                        class="w-full bg-transparent border border-[#E5E1D8] p-3 text-sm outline-none focus:border-[#A39274] cursor-pointer text-gray-600 transition-colors">
                        <option value="">Toutes les marques</option>
                        <option value="rolex">Rolex</option>
                        <option value="patek_philippe">Patek Philippe</option>
                        <option value="audemars_piguet">Audemars Piguet</option>
                        <option value="omega">Omega</option>
                        <option value="cartier">Cartier</option>
                        <option value="richard_mille">Richard Mille</option>
                    </select>
                </div>

                <div class="hidden lg:block">
                    <h3
                        class="text-[10px] font-bold tracking-[0.3em] uppercase text-[#A39274] mb-4 border-b border-[#E5E1D8] pb-2">
                        Style</h3>
                    <ul class="space-y-4 text-sm text-gray-600">
                        <li><a href="#"
                                class="font-bold text-[#1A1A1A] flex justify-between border-l-2 border-[#A39274] pl-2 -ml-[2px]">Toutes
                                les montres <span>(42)</span></a></li>
                        <li><a href="#" class="hover:text-black transition-colors flex justify-between pl-2">Classique
                                <span>(15)</span></a></li>
                        <li><a href="#" class="hover:text-black transition-colors flex justify-between pl-2">Sport &
                                Plongée <span>(18)</span></a></li>
                        <li><a href="#" class="hover:text-black transition-colors flex justify-between pl-2">Haute
                                Horlogerie <span>(9)</span></a></li>
                    </ul>
                </div>

                <div class="hidden lg:block">
                    <h3
                        class="text-[10px] font-bold tracking-[0.3em] uppercase text-[#A39274] mb-4 border-b border-[#E5E1D8] pb-2">
                        Mouvement</h3>
                    <ul class="space-y-4 text-sm text-gray-600">
                        <li>
                            <label class="flex items-center gap-3 cursor-pointer hover:text-black transition-colors">
                                <input type="checkbox" class="w-4 h-4 accent-[#A39274] cursor-pointer"> Automatique
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-3 cursor-pointer hover:text-black transition-colors">
                                <input type="checkbox" class="w-4 h-4 accent-[#A39274] cursor-pointer"> Mécanique
                                (Manuel)
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-3 cursor-pointer hover:text-black transition-colors">
                                <input type="checkbox" class="w-4 h-4 accent-[#A39274] cursor-pointer"> Quartz
                            </label>
                        </li>
                    </ul>
                </div>

                <div class="hidden lg:block pt-4">
                    <h3
                        class="text-[10px] font-bold tracking-[0.3em] uppercase text-[#A39274] mb-6 border-b border-[#E5E1D8] pb-2">
                        Prix (€)</h3>
                    <div class="flex items-center gap-4">
                        <input type="number" placeholder="Min"
                            class="w-full border border-[#E5E1D8] bg-transparent p-2 text-xs outline-none focus:border-[#A39274]">
                        <span class="text-gray-400">-</span>
                        <input type="number" placeholder="Max"
                            class="w-full border border-[#E5E1D8] bg-transparent p-2 text-xs outline-none focus:border-[#A39274]">
                    </div>
                    <button
                        class="mt-6 w-full bg-[#1A1A1A] text-white py-4 text-[9px] tracking-[0.4em] font-bold uppercase hover:bg-[#A39274] transition-colors shadow-xl">
                        Appliquer les filtres
                    </button>
                </div>

            </div>
        </aside>

        <section class="flex-1">

            <div class="flex justify-between items-center mb-8 text-[10px] uppercase tracking-[0.2em] text-gray-500">
                <p><?php echo count($annonces); ?> annonces trouvées</p>
                <select class="bg-transparent outline-none border-b border-[#E5E1D8] pb-1 cursor-pointer">
                    <option>Trier par : Nouveautés</option>
                    <option>Prix croissant</option>
                    <option>Prix décroissant</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-x-8 gap-y-12">

                <?php foreach ($annonces as $annonce): ?>
                    <article class="group cursor-pointer">
                        <div class="relative overflow-hidden mb-4 bg-white aspect-[4/5] border border-[#E5E1D8]">
                            <img src="<?php echo $annonce['img']; ?>" alt="<?php echo $annonce['titre']; ?>"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-in-out">

                            <div
                                class="absolute top-4 left-4 bg-white/90 px-3 py-1 text-[8px] uppercase tracking-[0.2em] font-bold">
                                <?php echo $annonce['categorie']; ?>
                            </div>

                            <div
                                class="absolute inset-x-0 bottom-0 p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <a href="details_annonce.php?id=1"
                                    class="block w-full text-center bg-[#1A1A1A] text-white py-3 text-[9px] uppercase tracking-[0.3em] hover:bg-[#A39274] transition-colors">
                                    Voir l'annonce
                                </a>
                            </div>
                        </div>

                        <div class="text-center">
                            <h2
                                class="font-serif italic text-lg text-[#1A1A1A] mb-1 group-hover:text-[#A39274] transition-colors">
                                <?php echo $annonce['titre']; ?></h2>
                            <p class="text-sm font-bold tracking-wide">
                                <?php echo number_format($annonce['prix'], 0, ',', ' ') . ' ' . $annonce['devise']; ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>

            </div>

            <div class="mt-16 flex justify-center items-center gap-4">
                <button
                    class="w-10 h-10 border border-[#E5E1D8] flex items-center justify-center text-gray-400 hover:text-black hover:border-black transition-colors">&larr;</button>
                <span
                    class="w-10 h-10 border border-[#A39274] text-[#A39274] flex items-center justify-center font-bold text-sm">1</span>
                <button
                    class="w-10 h-10 border border-[#E5E1D8] flex items-center justify-center text-sm hover:border-black transition-colors">2</button>
                <button
                    class="w-10 h-10 border border-[#E5E1D8] flex items-center justify-center text-sm hover:border-black transition-colors">3</button>
                <button
                    class="w-10 h-10 border border-[#E5E1D8] flex items-center justify-center text-gray-400 hover:text-black hover:border-black transition-colors">&rarr;</button>
            </div>

        </section>

    </main>

</body>

</html>