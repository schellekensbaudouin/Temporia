<?php

// 2. Vérification : Est-ce que l'utilisateur est bien connecté ?
if (!isset($_SESSION['user']['id'])) {
    // S'il n'est pas connecté, on le renvoie vers la page de connexion
    header("Location: index.php?action=login");
    exit();
}
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Temporia - Modifier le profil</title>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#F9F7F2] text-[#1A1A1A]">


<?php if ($_SERVER['REQUEST_METHOD']==='POST') {



// 4. Récupération de l'ID de l'utilisateur et des données du formulaire
$user_id = $_SESSION['user']['id'];
$user_name = trim($_POST['user_name']);
$email = trim($_POST['email']);
$bio = isset($_POST['bio']) ? trim($_POST['bio']) : null;
$new_password = $_POST['new_password'];

try {
    // 5. Préparation de la requête SQL de base (Nom et Email)
    $query = "UPDATE user SET user_name = :user_name, email = :email";
    
    // Le tableau des paramètres à envoyer à la base
    $params = [
        ':user_name' => $user_name,
        ':email' => $email,
        ':id' => $user_id
    ];

    // 6. Gestion du Rôle Vendeur (La biographie)
    // Si le champ bio a été envoyé par le formulaire (donc si c'est un vendeur), on l'ajoute à la mise à jour
    if ($bio !== null) {
        $query .= ", bio = :bio";
        $params[':bio'] = $bio;
    }

    // 7. Sécurité : Gestion du Mot de passe
    // Si l'utilisateur a tapé quelque chose dans le champ mot de passe, on le met à jour
    if (!empty($new_password)) {
        $query .= ", hash_pwd = :hash_pwd";
        // On hache le nouveau mot de passe pour la sécurité
        $params[':hash_pwd'] = password_hash($new_password, PASSWORD_BCRYPT);
    }

    // 8. On finalise la requête en précisant QUEL utilisateur on modifie
    $query .= " WHERE id = :id";

    // 9. Exécution de la requête magique
    $stmt = $conn->prepare($query);
    $stmt->execute($params);

    // 10. Succès ! On renvoie l'utilisateur vers son profil avec un message de victoire
    header("Location: index.php?action=profile&success=1");
    exit();

} catch (PDOException $e) {
    // Il faut faire des meillieurs messages d'erreurs
    echo('Erreur PDO');
}
}
?>

    <?php include '../views/includes/navbar.php'; ?>

    <main class="max-w-[800px] mx-auto px-6 py-12">
        <header class="mb-12 text-center">
            <h2 class="font-serif text-4xl italic mb-4">Paramètres du compte</h2>
            <p class="text-[10px] tracking-[0.3em] uppercase text-[#A39274]">
                Profil Actuel : <span class="font-bold underline"><?php echo $_SESSION['user']['role']; ?></span>
            </p>
        </header>

        <form action="index.php?action=profile" method="POST" class="bg-white border border-[#E5E1D8] p-8 md:p-12 shadow-sm">
            
            <div class="space-y-10">
                <div class="relative">
                    <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Nom d'utilisateur</label>
                    <input type="text" name="user_name" value="<?php echo $_SESSION['user']['username']; ?>" 
                           class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] transition-colors bg-transparent text-sm">
                </div>

                <div class="relative">
                    <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Adresse Email</label>
                    <input type="email" name="email" value="<?php echo 'user_email'; ?>" 
                           class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] transition-colors bg-transparent text-sm">
                </div>

                <div class="relative">
                    <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Changer le mot de passe (optionnel)</label>
                    <input type="password" name="new_password" placeholder="••••••••" 
                           class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] transition-colors bg-transparent text-sm">
                </div>

                <div class="pt-6 border-t border-[#E5E1D8]">
                    <?php if ($_SESSION['user']['role'] === 'vendeur'): ?>
                        <div class="relative">
                            <label class="block text-[10px] tracking-[0.2em] uppercase text-[#A39274] font-bold mb-3">Biographie de vendeur</label>
                            <textarea name="bio" rows="4" placeholder="Décrivez votre expertise en horlogerie..."
                                      class="w-full border border-[#E5E1D8] p-4 text-sm outline-none focus:border-[#A39274] transition-colors bg-[#FDFCFB]"><?php echo 'Bio'; ?></textarea>
                        </div>
                    <?php else: ?>
                        <div class="bg-[#FDFCFB] p-8 text-center border border-[#E5E1D8]">
                            <h3 class="font-serif text-xl mb-3">Vous possédez des pièces d'exception ?</h3>
                            <p class="text-[10px] text-gray-500 mb-6 uppercase tracking-widest leading-relaxed">
                                Rejoignez nos experts et commencez à vendre vos montres de collection.
                            </p>
                            <a href="index.php?action=devenir_vendeur" 
                               class="inline-block border border-[#A39274] text-[#A39274] px-8 py-3 text-[9px] tracking-[0.3em] uppercase font-bold hover:bg-[#A39274] hover:text-white transition-all duration-300">
                                Devenir Vendeur
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="pt-4 text-right">
                    <button type="submit" 
                            class="bg-[#1A1A1A] text-white py-5 px-10 text-[10px] tracking-[0.4em] uppercase font-bold hover:bg-[#A39274] transition-all duration-500 shadow-xl">
                        Enregistrer le profil
                    </button>
                </div>
            </div>
        </form>

        <div class="mt-8 text-center">
            <a href="index.php?action=dashboard" class="text-[10px] tracking-[0.2em] uppercase text-gray-400 hover:text-black transition-colors">
                ← Retour au tableau de bord
            </a>
        </div>
    </main>

</body>
</html>