<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <title>Temporia - Devenir Vendeur</title>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#F9F7F2] text-[#1A1A1A]">

    <?php include '../views/includes/navbar.php'; ?>

    <main class="max-w-[900px] mx-auto px-6 py-16">
        
        <header class="text-center mb-16">
            <h1 class="font-serif text-4xl md:text-5xl italic mb-4">Rejoignez l'élite</h1>
            <p class="text-xs tracking-[0.2em] uppercase text-gray-500 max-w-xl mx-auto leading-relaxed">
                Pour garantir l'authenticité de notre marketplace, nous vérifions méticuleusement chaque vendeur. Remplissez ce dossier pour ouvrir votre boutique.
            </p>
        </header>

        <?php if(isset($_GET['error'])): ?>
        <div class="mb-10 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
            <p class="text-[10px] uppercase tracking-widest font-bold">Erreur : Veuillez vérifier vos informations ou le format de vos images.</p>
        </div>
        <?php endif; ?>

        <form action="index.php?action=devenir_vendeur" method="POST" enctype="multipart/form-data" class="space-y-16">

            <section class="bg-white p-10 border border-[#E5E1D8] shadow-sm">
                <h2 class="text-[10px] tracking-[0.4em] uppercase text-[#A39274] font-bold mb-8 border-b border-[#E5E1D8] pb-4">1. Identité & Contact</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Prénom</label>
                        <input type="text" name="first_name" required class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] transition-colors bg-transparent">
                    </div>
                    <div>
                        <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Nom</label>
                        <input type="text" name="last_name" required class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] transition-colors bg-transparent">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Date de naissance</label>
                        <input type="date" name="birth_date" required class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] transition-colors bg-transparent text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Numéro de téléphone</label>
                        <input type="tel" name="phone" required placeholder="+33 6 00 00 00 00" class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] transition-colors bg-transparent">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="md:col-span-2">
                        <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Adresse postale complète</label>
                        <textarea name="address" rows="2" required class="w-full border border-[#E5E1D8] p-3 outline-none focus:border-[#A39274] transition-colors bg-[#FDFCFB]"></textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Pays de résidence</label>
                        <input type="text" name="country" required class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] transition-colors bg-transparent">
                    </div>
                </div>
            </section>

            <section class="bg-white p-10 border border-[#E5E1D8] shadow-sm">
                <h2 class="text-[10px] tracking-[0.4em] uppercase text-[#A39274] font-bold mb-8 border-b border-[#E5E1D8] pb-4">2. Vérification de sécurité</h2>
                
                <div class="mb-8">
                    <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Numéro de carte d'identité ou Passeport</label>
                    <input type="text" name="national_id" required class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] transition-colors bg-transparent max-w-md">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="border border-dashed border-[#A39274] p-6 text-center hover:bg-[#F9F7F2] transition-colors cursor-pointer relative">
                        <span class="block text-xs uppercase tracking-widest font-bold mb-2">Photo de la pièce (Recto)</span>
                        <span class="block text-[9px] text-gray-400 uppercase mb-4">Format JPG ou PNG</span>
                        <input type="file" name="id_front" required class="text-xs w-full cursor-pointer">
                    </div>
                    <div class="border border-dashed border-[#A39274] p-6 text-center hover:bg-[#F9F7F2] transition-colors cursor-pointer relative">
                        <span class="block text-xs uppercase tracking-widest font-bold mb-2">Photo de la pièce (Verso)</span>
                        <span class="block text-[9px] text-gray-400 uppercase mb-4">Format JPG ou PNG</span>
                        <input type="file" name="id_back" required class="text-xs w-full cursor-pointer">
                    </div>
                </div>
            </section>

            <section class="bg-[#FDFCFB] p-10 border border-[#1A1A1A] shadow-xl">
                <h2 class="text-[10px] tracking-[0.4em] uppercase text-[#1A1A1A] font-bold mb-8 border-b border-gray-200 pb-4">3. Votre Boutique Temporia</h2>
                
                <div class="mb-8">
                    <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-500 mb-2">Nom de votre boutique</label>
                    <input type="text" name="shop_name" required placeholder="Ex: Horlogerie Royale" class="w-full border-b border-gray-300 py-3 outline-none focus:border-[#A39274] transition-colors bg-transparent font-serif text-xl italic">
                </div>

                <div class="mb-8">
                    <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-500 mb-2">Description de la boutique</label>
                    <textarea name="shop_description" rows="4" required placeholder="Racontez votre passion, votre expertise..." class="w-full border border-gray-200 p-4 outline-none focus:border-[#A39274] transition-colors bg-white"></textarea>
                </div>

                <div class="mb-8">
                    <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-500 mb-2">Logo de la boutique (Optionnel)</label>
                    <input type="file" name="shop_logo" class="text-xs w-full max-w-sm">
                </div>
            </section>

            <div class="text-center pt-8">
                <p class="text-[10px] text-gray-500 uppercase tracking-widest mb-6 max-w-lg mx-auto">
                    En soumettant ce formulaire, votre profil passera en statut "En attente". Un administrateur validera vos documents avant l'ouverture officielle.
                </p>
                <button type="submit" class="bg-[#1A1A1A] text-white px-14 py-6 text-[10px] tracking-[0.4em] uppercase font-bold hover:bg-[#A39274] transition-all duration-500 shadow-2xl">
                    Soumettre mon dossier de vendeur
                </button>
            </div>

        </form>
    </main>

</body>
</html>