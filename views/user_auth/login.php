<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'];

    $errors = [];
    if (empty($email)) {
        $errors['email'] = "L'email est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Le format de l'email est invalide.";
    }

    if (empty($password)) {
        $errors['password'] = "Le mot de passe est obligatoire.";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Le mot de passe doit contenir plus de 8 caractères";
    }

    if (empty($errors)) {
        $sql = "SELECT * FROM user WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);
        $user = $stmt->fetch();
        if (!$user) {
            $errors['user'] = "Utilisateur introuvable";
        }

        if ($user && password_verify($password, $user['hash_pwd'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['user_name'],
                'role' => $user['roles']
            ];
            header('Location: index.php?action=dashboard');
            exit;
        } else {
            $errors['password'] = "Identifiants incorrects";
        }
    }
}
?>

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

    <?php include '../views/includes/navbar.php'; ?>

    <main class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="bg-white p-8 md:p-12 shadow-2xl w-full max-w-md border border-gray-100">
            
            <header class="text-center mb-10">
                <h2 class="text-3xl font-serif uppercase tracking-widest mb-2">Connexion</h2>
                <p class="text-temp-sand text-xs uppercase tracking-widest">Ravi de vous revoir</p>
            </header>

            <?php if (!empty($errors)): ?>
    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
        <div class="flex">
            <div class="ml-3">
                <p class="text-xs text-red-700 uppercase tracking-widest font-bold">
                    Erreurs détectées :
                </p>
                <ul class="text-xs text-red-600 list-disc list-inside mt-1">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
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