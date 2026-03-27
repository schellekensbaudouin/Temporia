<?php
// On vérifie uniquement l'ID en session
if (!isset($_SESSION['user']['id'])) {
    header("Location: index.php?action=login");
    exit();
}

// Sécurité : Vérifier que c'est bien un vendeur
if ($_SESSION['user']['role'] !== 'vendeur') {
    header("Location: index.php?action=dashboard");
    exit();
}

$user_id = $_SESSION['user']['id'];
$errors = [];
$success = false;

// --- ÉTAPE 1 : RÉCUPÉRATION DES INFOS (Jointure complète) ---
try {
    $stmt = $conn->prepare("SELECT * FROM user u LEFT JOIN profil_vendeur pv ON u.id = pv.user_id WHERE u.id = :id");
    $stmt->execute([':id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header("Location: index.php?action=logout");
        exit();
    }
} catch (PDOException $e) {
    die("Erreur de récupération des données.");
}

// --- ÉTAPE 2 : TRAITEMENT DU FORMULAIRE ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nettoyage des entrées
    $user_name = trim($_POST['user_name']);
    $bio = trim($_POST['bio'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $country = trim($_POST['country'] ?? '');
    $shop_name = trim($_POST['shop_name'] ?? '');
    $shop_description = trim($_POST['shop_description'] ?? '');
    $new_password = $_POST['new_password'];

    // --- GESTION DES FICHIERS (Avatar & Logo) ---
    $profile_picture = $user['profile_picture']; 
    $shop_logo = $user['logo_boutique']; // Assumé comme nom de colonne dans profil_vendeur

    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    $upload_dir = "public/uploads/";

    // 1. Upload Avatar
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $allowed)) {
            $profile_picture = "avatar_" . $user_id . "_" . time() . "." . $ext;
            move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_dir . "avatars/" . $profile_picture);
        }
    }

    // 2. Upload Logo Boutique
    if (isset($_FILES['shop_logo']) && $_FILES['shop_logo']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['shop_logo']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $allowed)) {
            $shop_logo = "logo_" . $user_id . "_" . time() . "." . $ext;
            move_uploaded_file($_FILES['shop_logo']['tmp_name'], $upload_dir . "logos/" . $shop_logo);
        }
    }

    if (empty($user_name)) $errors[] = "Le nom d'utilisateur est requis.";
    if (empty($shop_name)) $errors[] = "Le nom de la boutique est requis.";

    if (empty($errors)) {
        try {
            $conn->beginTransaction();

            // MAJ Table USER
            $sqlUser = "UPDATE user SET user_name = :user_name, bio = :bio, profile_picture = :pic";
            $paramsUser = [
                ':user_name' => $user_name,
                ':bio' => $bio,
                ':pic' => $profile_picture,
                ':id' => $user_id
            ];
            if (!empty($new_password)) {
                $sqlUser .= ", hash_pwd = :pwd";
                $paramsUser[':pwd'] = password_hash($new_password, PASSWORD_DEFAULT);
            }
            $sqlUser .= " WHERE id = :id";
            $conn->prepare($sqlUser)->execute($paramsUser);

            // MAJ Table PROFIL_VENDEUR
            $sqlPV = "UPDATE profil_vendeur SET 
                        telephone = :phone, 
                        adresse = :address, 
                        pays = :country, 
                        nom_boutique = :shop_name, 
                        description_boutique = :shop_desc, 
                        logo_boutique = :logo 
                      WHERE user_id = :id";
            $conn->prepare($sqlPV)->execute([
                ':phone'    => $phone,
                ':address'  => $address,
                ':country'  => $country,
                ':shop_name' => $shop_name,
                ':shop_desc' => $shop_description,
                ':logo'     => $shop_logo,
                ':id'       => $user_id
            ]);

            $conn->commit();
            $success = true;
            
            // Rafraîchir les données locales pour l'affichage
            $user = array_merge($user, $_POST, ['profile_picture' => $profile_picture, 'logo_boutique' => $shop_logo]);
            $_SESSION['user']['username'] = $user_name;

        } catch (Exception $e) {
            $conn->rollBack();
            $errors[] = "Erreur technique : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Temporia - Espace Vendeur</title>
</head>
<body class="bg-[#F9F7F2] text-[#1A1A1A] font-['Inter']">

    <?php include '../views/includes/navbar.php'; ?>

    <main class="max-w-[850px] mx-auto px-6 py-12">
        <header class="mb-12 text-center">
            <h2 class="font-['Playfair_Display'] text-4xl italic mb-4">Paramètres Vendeur</h2>
            <p class="text-[10px] tracking-[0.3em] uppercase text-[#A39274]">Gestion de votre boutique en ligne</p>
        </header>

        <?php if ($success): ?>
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 text-xs tracking-widest uppercase">
                ✓ Votre boutique et votre profil ont été mis à jour.
            </div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data" class="bg-white border border-[#E5E1D8] p-8 md:p-12 shadow-sm">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                
                <div class="space-y-8">
                    <h3 class="text-xs font-bold tracking-[0.2em] uppercase border-b border-[#E5E1D8] pb-2">Identité</h3>
                    
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 rounded-full bg-gray-100 overflow-hidden border border-[#E5E1D8]">
                            <img src="public/uploads/avatars/<?= $user['profile_picture'] ?? 'default.png' ?>" class="w-full h-full object-cover">
                        </div>
                        <input type="file" name="avatar" class="text-[9px] text-gray-400">
                    </div>

                    <div>
                        <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-1">Nom d'utilisateur</label>
                        <input type="text" name="user_name" value="<?= htmlspecialchars($user['user_name']) ?>" class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] text-sm bg-transparent">
                    </div>

                    <div>
                        <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-1">Téléphone</label>
                        <input type="text" name="phone" value="<?= htmlspecialchars($user['telephone'] ?? '') ?>" class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] text-sm bg-transparent">
                    </div>

                    <div>
                        <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-1">Pays</label>
                        <input type="text" name="country" value="<?= htmlspecialchars($user['pays'] ?? '') ?>" class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] text-sm bg-transparent">
                    </div>
                </div>

                <div class="space-y-8">
                    <h3 class="text-xs font-bold tracking-[0.2em] uppercase border-b border-[#E5E1D8] pb-2">Ma Boutique</h3>
                    
                    <div>
                        <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-1">Logo Boutique</label>
                        <input type="file" name="shop_logo" class="text-[9px] text-gray-400 mb-2">
                        <?php if(!empty($user['logo_boutique'])): ?>
                            <img src="public/uploads/logos/<?= $user['logo_boutique'] ?>" class="h-12 border border-[#E5E1D8]">
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-1">Nom du shop</label>
                        <input type="text" name="shop_name" value="<?= htmlspecialchars($user['nom_boutique'] ?? '') ?>" class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] text-sm bg-transparent">
                    </div>

                    <div>
                        <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-1">Description</label>
                        <textarea name="shop_description" rows="3" class="w-full border border-[#E5E1D8] p-3 text-xs outline-none focus:border-[#A39274] bg-[#FDFCFB]"><?= htmlspecialchars($user['description_boutique'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>

            <div class="mt-12">
                <label class="block text-[10px] tracking-[0.2em] uppercase text-gray-400 mb-1">Adresse physique</label>
                <input type="text" name="address" value="<?= htmlspecialchars($user['adresse'] ?? '') ?>" class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-[#A39274] text-sm bg-transparent">
            </div>

            <div class="mt-12 pt-8 border-t border-[#E5E1D8] flex justify-between items-center">
                <div class="w-1/2">
                    <label class="block text-[10px] tracking-[0.2em] uppercase text-red-400 mb-1">Changer le mot de passe</label>
                    <input type="password" name="new_password" placeholder="••••••••" class="w-full border-b border-[#E5E1D8] py-2 outline-none focus:border-red-400 text-sm bg-transparent">
                </div>
                <button type="submit" class="bg-[#1A1A1A] text-white py-4 px-8 text-[10px] tracking-[0.3em] uppercase font-bold hover:bg-[#A39274] transition-all">
                    Enregistrer la boutique
                </button>
            </div>
        </form>
    </main>
</body>
</html>