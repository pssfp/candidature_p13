<?php
session_start();

// Rediriger les utilisateurs déjà connectés
if (isset($_SESSION['user_id'])) {
    $redirect = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : 
               ($_SESSION['role'] === 'admin' ? 'admin_dashboard.php' : 'dashboard.php');
    unset($_SESSION['redirect_url']);
    header("Location: $redirect");
    exit();
}

header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: strict-origin-when-cross-origin");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Erreur de sécurité : Token CSRF invalide");
    }

    try {
        $pdo = new PDO(
            'mysql:host=localhost;dbname=pssfp_candidatures;charset=utf8',
            'root',
            '',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
        
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        
        if (empty($username) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires");
        }
        
        $stmt = $pdo->prepare("SELECT id, username, password, role FROM users WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['last_login'] = time();
            
            // Redirection sécurisée
            $redirect = ($user['role'] === 'admin') ? 'admin_dashboard.php' : 'dashboard.php';
            header("Location: $redirect");
            exit();
        } else {
            sleep(2);
            throw new Exception("Identifiants incorrects");
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Génération du token CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page de connexion au système de candidature PSSFP">
    <title>Connexion - PSSFP</title>
    
    <!-- Optimisation des ressources -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #8413e0;
            --secondary-color: #6a0dad;
            --error-color: #dc3545;
            --success-color: #28a745;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .login-container {
            max-width: 500px;
            margin: auto;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .login-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 1.5rem;
        }
        
        .card-body {
            padding: 2rem;
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(132, 19, 224, 0.25);
        }
        
        .btn-login {
            background-color: var(--primary-color);
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
        
        .password-container {
            position: relative;
        }
        
        footer {
            margin-top: auto;
            padding: 1rem;
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @media (max-width: 576px) {
            .login-container {
                padding: 0 15px;
            }
            
            .card-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="login-container">
            <div class="login-card">
                <div class="card-header">
                    <h3><i class="bi bi-lock-fill me-2"></i>Connexion PSSFP</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form method="post" autocomplete="off">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        
                        <div class="mb-4">
                            <label for="username" class="form-label">Nom d'utilisateur</label>
                            <input type="text" id="username" name="username" class="form-control" 
                                   required autofocus value="<?= htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                        
                        <div class="mb-4 password-container">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                            <span class="password-toggle" id="togglePassword">
                                <i class="bi bi-eye-fill"></i>
                            </span>
                        </div>
                        
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary btn-login">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                            </button>
                        </div>
                        
                        <div class="d-grid gap-2 mb-3">
                            <a href="préinscription.php" class="btn btn-primary btn-login">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Revenir à l'acceuil
                            </a>
                        </div>
                        <div class="text-center">
                            <a href="forgot_password.php" class="text-decoration-none">Mot de passe oublié ?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <footer>
        &copy; <?= date('Y') ?> Programme supérieur de spécialisation en finances publiques
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" 
            crossorigin="anonymous"></script>
    
    <script>
        // Fonctionnalité pour afficher/masquer le mot de passe
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
            }
        });
        
        <?php if (isset($error)): ?>
            document.querySelector('input:invalid')?.focus();
        <?php endif; ?>
    </script>
</body>
</html>