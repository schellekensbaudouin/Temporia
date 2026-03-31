<?php
// Redirection si l'utilisateur n'est pas connecté
if (!$_SESSION['user']['role']==='vendeur') {
    header("Location: index.php?action=login");
    exit();
}

$errors = [];
$success = false;

$user_id = $_SESSION['user']['id'];
// Récupérer les infos du vendeur 
try {
    // On précise pv.id (pour profil_vendeur) ou u.id (pour user)
    $stmt = $conn->prepare("SELECT pv.id FROM profil_vendeur pv LEFT JOIN user u ON pv.user_id = u.id WHERE u.id = :id");
    
    // Note : J'ai ajouté le "WHERE u.id = :id" car sinon ta requête 
    // récupérera le premier vendeur de la base sans tenir compte de ton paramètre.
    $stmt->execute([':id' => $user_id]);
    $profil_vendeur = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    $errors[] = "Erreur lors de la requête : " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Récupération et nettoyage (Noms alignés sur le HTML)
    $title = htmlspecialchars(trim($_POST['title']));
    $image_url = htmlspecialchars(trim($_POST['url_photo'])); // Corrigé ici
    $description = htmlspecialchars(trim($_POST['description']));
    $price = floatval($_POST['price']);
    $currency = htmlspecialchars(trim($_POST['currency']));
    
    // 2. On récupère le tableau 'category' (Aligné sur le name="category[]" du HTML)
    $selected_categories = isset($_POST['category']) ? $_POST['category'] : [];

    // Validation
    if (empty($title)) $errors[] = "L'annonce doit avoir un titre.";
    if (empty($image_url) || !filter_var($image_url, FILTER_VALIDATE_URL)) $errors[] = "URL d'image invalide.";
    if ($price <= 0) $errors[] = "Le prix doit être positif.";
    if (empty($selected_categories)) $errors[] = "Veuillez choisir au moins une catégorie.";

    if (empty($errors)) {
        try {
            $conn->beginTransaction();

            // Insertion Article
            $queryArticle = "INSERT INTO article (profil_vendeur_id, title, description, price, currency) 
                             VALUES (:profil_vendeur_id, :title, :description, :price, :currency)";
            
            $stmt = $conn->prepare($queryArticle);
            $stmt->execute([
                ':profil_vendeur_id' => $profil_vendeur['id'],
                ':title'             => $title,
                ':description'       => $description,
                ':price'             => $price,
                ':currency'          => $currency
            ]);

            $article_id = $conn->lastInsertId();

            // 3. Insertion Table de liaison (Vérifie bien si c'est 'article_categorie' ou 'article_category')
            $queryLink = "INSERT INTO article_category (article_id, category_id) VALUES (:article_id, :cat_id)";
            $stmtLink = $conn->prepare($queryLink);

            foreach ($selected_categories as $cat_id) {
                $stmtLink->execute([
                    ':article_id' => $article_id,
                    ':cat_id'     => intval($cat_id)
                ]);
            }

            // Insertion Photo
            $queryPhoto = "INSERT INTO photo_article (article_id, url_photo) VALUES (:article_id, :url_photo)";
            $stmtPhoto = $conn->prepare($queryPhoto);
            $stmtPhoto->execute([
                ':article_id' => $article_id,
                ':url_photo'  => $image_url
            ]);

            $conn->commit();
            $success = true;
            $_POST = array(); 

        } catch (PDOException $e) {
            $conn->rollBack();
            $errors[] = "Erreur lors de la création : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <title>Temporia - Créer une Annonce</title>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#F9F7F2] text-[#1A1A1A]">

    <?php include '../views/includes/navbar.php'; ?>

    <main class="max-w-[800px] mx-auto px-6 py-16">
        
        <header class="text-center mb-16">
            <h1 class="font-serif text-4xl md:text-5xl italic mb-4">Nouvelle Pièce</h1>
            <p class="text-xs tracking-[0.2em] uppercase text-gray-500 max-w-xl mx-auto leading-relaxed">
                Présentez votre objet d'exception à notre communauté de collectionneurs.
            </p>
        </header>

        <?php if($success): ?>
            <div class="mb-10 p-6 bg-white border-l-4 border-[#A39274] shadow-md transition-all">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-[#A39274] mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <div>
                        <h3 class="font-serif text-xl italic text-[#1A1A1A]">Annonce publiée</h3>
                        <p class="text-[10px] uppercase tracking-[0.2em] font-bold text-[#A39274]">Votre objet est désormais visible sur la marketplace.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(!empty($errors)): ?>
            <div class="mb-10 p-6 bg-red-50 border-l-4 border-red-800 shadow-md">
                <ul class="list-disc list-inside text-[10px] uppercase tracking-[0.2em] font-bold text-red-800 space-y-1">
                    <?php foreach($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-12">
            
            <section class="bg-white p-10 border border-[#E5E1D8] shadow-sm">
                <h2 class="text-[10px] tracking-[0.4em] uppercase text-[#A39274] font-bold mb-8 border-b border-[#E5E1D8] pb-4">1. Informations de base</h2>
                
                <div class="space-y-8">
                    <div>
                        <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Titre de l'annonce</label>
                        <input type="text" name="title" required placeholder="Ex: Rolex Submariner 1967 - État Concours" 
                               value="<?php echo $_POST['title'] ?? ''; ?>"
                               class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] transition-colors bg-transparent font-serif text-lg">
                    </div>

                    <div>
                        <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">URL de l'image (Lien direct)</label>
                        <input type="url" name="url_photo" required placeholder="https://mon-image.com/photo.jpg" 
                               value="<?php echo $_POST['image_url'] ?? ''; ?>"
                               class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] transition-colors bg-transparent text-sm">
                    </div>
                </div>
            </section>

            <section class="bg-white p-10 border border-[#E5E1D8] shadow-sm">
                <h2 class="text-[10px] tracking-[0.4em] uppercase text-[#A39274] font-bold mb-8 border-b border-[#E5E1D8] pb-4">2. Classification & Prix</h2>
                
                    <div>
                <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Catégories (Plusieurs choix possibles)</label>
                    <select name="category[]" multiple class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] bg-transparent text-sm cursor-pointer h-32">
                        <option value="1" class="py-1">Horlogerie</option>
                        <option value="2" class="py-1">Bijouterie</option>
                        <option value="3" class="py-1">Accessoires de luxe</option>
                        <option value="4" class="py-1">Art & Collection</option>
                        </select>
                <p class="text-[10px] text-gray-500 mt-1 italic">Maintenez Ctrl/Cmd pour sélectionner plusieurs catégories.</p>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-grow">
                            <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Prix</label>
                            <input type="number" step="0.01" name="price" required placeholder="0.00"
                                   value="<?php echo $_POST['price'] ?? ''; ?>"
                                   class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] bg-transparent">
                        </div>
                        <div class="w-24">
                            <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Unité</label>
                            <select name="currency" class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] bg-transparent text-sm">
                                <option value="EUR">€ (EUR)</option>
                                <option value="USD">$ (USD)</option>
                                <option value="CHF">CHF</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Description détaillée</label>
                    <textarea name="description" rows="6" required placeholder="Décrivez l'histoire, l'état et les caractéristiques techniques..." 
                              class="w-full border border-[#E5E1D8] p-4 outline-none focus:border-[#A39274] transition-colors bg-[#FDFCFB] text-sm leading-relaxed"><?php echo $_POST['description'] ?? ''; ?></textarea>
                </div>
            </section>

            <div class="text-center pt-8">
                <button type="submit" class="bg-[#1A1A1A] text-white px-16 py-5 text-[10px] tracking-[0.4em] uppercase font-bold hover:bg-[#A39274] transition-all duration-500 shadow-xl">
                    Publier l'annonce
                </button>
                <p class="mt-6 text-[9px] text-gray-400 uppercase tracking-widest">
                    Votre annonce sera soumise à une modération avant publication.
                </p>
            </div>

        </form>
    </main>

</body>
</html>