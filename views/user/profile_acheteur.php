<?php
// On vérifie uniquement l'ID en session
if (!isset($_SESSION['user']['id'])) {
    header("Location: index.php?action=login");
    exit();
}

$user_id = $_SESSION['user']['id'];
$errors = [];
$success = false;

// --- ÉTAPE 1 : RÉCUPÉRATION DES INFOS FRAÎCHES ---
try {
    $stmt = $conn->prepare("SELECT * FROM user WHERE id = :id");
    $stmt->execute([':id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header("Location: index.php?action=logout");
        exit();
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données.");
}

// --- ÉTAPE 2 : TRAITEMENT DU FORMULAIRE (POST) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = trim($_POST['user_name']);
    $bio = isset($_POST['bio']) ? trim($_POST['bio']) : null;
    $new_password = $_POST['new_password'];
    
    // Gestion de l'image (profile_picture)
    $profile_picture = $user['profile_picture']; // On garde l'actuelle par défaut
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $new_filename = "profile_" . $user_id . "_" . time() . "." . $ext;
            if(move_uploaded_file($_FILES['profile_picture']['tmp_name'], "../public/uploads/" . $new_filename)) {
                $profile_picture = $new_filename;
            }
        } else {
            $errors[] = "Format d'image non supporté.";
        }
    }

    if (empty($user_name)) $errors[] = "Le nom d'utilisateur est requis.";

    if (empty($errors)) {
        try {
            // Requête SANS l'email
            $sql = "UPDATE user SET user_name = :user_name, bio = :bio, profile_picture = :profile_picture";
            $params = [
                ':user_name' => $user_name,
                ':bio' => $bio,
                ':profile_picture' => $profile_picture,
                ':id' => $user_id
            ];

            if (!empty($new_password)) {
                $sql .= ", hash_pwd = :hash_pwd";
                $params[':hash_pwd'] = password_hash($new_password, PASSWORD_DEFAULT);
            }

            $sql .= " WHERE id = :id";
            $conn->prepare($sql)->execute($params);

            // OPTIONNEL : Mettre à jour le nom en session uniquement pour la barre de nav
            $_SESSION['user']['username'] = $user_name;

            $success = true;
            // On recharge les infos pour que le formulaire affiche les nouvelles valeurs
            $user['user_name'] = $user_name;
            $user['bio'] = $bio;
            $user['profile_picture'] = $profile_picture;

        } catch (PDOException $e) {
            $errors[] = "Erreur lors de la mise à jour.";
        }
    }
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

    <?php include '../views/includes/navbar.php'; ?>

    <main class="max-w-[800px] mx-auto px-6 py-12">
        <header class="mb-12 text-center">
            <h2 class="font-serif text-4xl italic mb-4">Paramètres du compte</h2>
            <p class="text-[10px] tracking-[0.3em] uppercase text-[#A39274]">
                Profil Actuel : <span class="font-bold underline"><?php echo $_SESSION['user']['role']; ?></span>
            </p>
        </header>

        <form action="index.php?action=profile" method="POST" class="bg-white border border-[#E5E1D8] p-8 md:p-12 shadow-sm">

            <div class="mb-8">
                <?php if ($success): ?>
                    <div class="p-4 bg-green-50 border-l-4 border-green-500 text-green-700 text-xs tracking-widest uppercase shadow-sm">
                        ✓ Profil mis à jour avec succès.
                    </div>
                <?php endif; ?>

                <?php if (!empty($errors)): ?>
                    <div class="p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-xs tracking-widest uppercase shadow-sm">
                        <p class="font-bold mb-2">Veuillez corriger les points suivants :</p>
                        <ul class="list-disc list-inside">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="space-y-10">
        <div class="flex items-center space-x-6">
            <div class="w-20 h-20 rounded-full border border-[#E5E1D8] overflow-hidden bg-gray-50">
                <?php if(!empty($user['profile_picture'])): ?>
                    <img src="../public/uploads/<?php echo $user['profile_picture']; ?>" class="w-full h-full object-cover">
                <?php else: ?>
                    <div class="flex items-center justify-center h-full text-[10px] text-gray-400 uppercase">No Pic</div>
                <?php endif; ?>
            </div>
            <div class="flex-1">
                <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Changer la photo</label>
                <input type="file" name="profile_picture" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-[10px] file:uppercase file:bg-[#A39274] file:text-white hover:file:bg-black transition-all">
            </div>
        </div>

        <div class="relative">
            <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Nom d'utilisateur</label>
            <input type="text" name="user_name" value="<?php echo htmlspecialchars($user['user_name']); ?>" 
                   class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] transition-colors bg-transparent text-sm">
        </div>

        <div class="relative">
            <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">
                Nouveau mot de passe (laisser vide pour ne pas modifier)
            </label>
            <input type="password" name="new_password" placeholder="••••••••" 
                class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] transition-colors bg-transparent text-sm">
            <p class="text-[9px] text-gray-400 mt-2 italic">Minimum 8 caractères si vous décidez de le changer.</p>
        </div>

        <div class="relative">
            <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-2">Adresse Email (Identifiant permanent)</label>
            <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" 
                   readonly class="w-full border-b border-[#E5E1D8] py-2 bg-gray-50 text-gray-400 text-sm cursor-not-allowed">
        </div>

        <div class="relative">
            <label class="block text-[10px] tracking-[0.2em] uppercase text-[#A39274] font-bold mb-3">Biographie</label>
            <textarea name="bio" rows="4" placeholder="Votre passion pour l'horlogerie..."
                      class="w-full border border-[#E5E1D8] p-4 text-sm outline-none focus:border-[#A39274] transition-colors bg-[#FDFCFB]"><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea>
        </div>

        </div>

                <div class="pt-4 text-right">
                    <button type="submit" 
                            class="bg-[#1A1A1A] text-white py-5 px-10 text-[10px] tracking-[0.4em] uppercase font-bold hover:bg-[#A39274] transition-all duration-500 shadow-xl">
                        Mettre à jour le profil
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