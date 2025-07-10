<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pré-inscription - Master Finances Publiques</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6a0dad;
            --secondary-color: #1cc88a;
            --dark-color: #343a40;
            --light-color: #f8f9fa;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, #4a148c 100%);
            color: white;
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNwYXR0ZXJuKSIvPjwvc3ZnPg==');
        }
        
        .step-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
            border-top: 4px solid var(--primary-color);
            background-color: white;
        }
        
        .step-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .step-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .step-number {
            display: inline-block;
            width: 30px;
            height: 30px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            margin-right: 10px;
            font-weight: bold;
        }
        
        .cta-btn {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s;
        }
        
        .cta-btn:hover {
            background-color: #570ba6;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 13, 173, 0.3);
        }
        
        .feature-list li {
            margin-bottom: 10px;
            position: relative;
            padding-left: 25px;
        }
        
        .feature-list li::before {
            content: "\f00c";
            font-family: "bootstrap-icons";
            position: absolute;
            left: 0;
            color: var(--secondary-color);
        }
        
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 3rem 0;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="Logo PSSFP" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Programme</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-primary" href="login.php">Connexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center position-relative">
            <h1 class="display-4 fw-bold mb-4">Master Professionnel en Finances Publiques</h1>
            <p class="lead mb-5">13ème promotion - Année académique 2025-2026</p>
            <a href="formulaire.php" class="btn btn-light btn-lg px-5 py-3 fw-bold">Commencer l'inscription</a>
        </div>
    </section>

    <!-- Process Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Processus d'inscription en 3 étapes</h2>
                <p class="text-muted">Suivez ces étapes simples pour postuler à notre programme</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="step-card p-4">
                        <div class="text-center mb-4">
                            <i class="bi bi-file-earmark-text step-icon"></i>
                        </div>
                        <h4 class="mb-3"><span class="step-number">1</span> Pré-requis</h4>
                        <ul class="feature-list list-unstyled">
                            <li>Diplôme Bac+3 minimum</li>
                            <li>Expérience professionnelle</li>
                            <li>CV et copies des diplômes</li>
                            <li>Photo d'identité 4x4</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="step-card p-4">
                        <div class="text-center mb-4">
                            <i class="bi bi-laptop step-icon"></i>
                        </div>
                        <h4 class="mb-3"><span class="step-number">2</span> Formulaire en ligne</h4>
                        <ul class="feature-list list-unstyled">
                            <li>Remplissage du formulaire</li>
                            <li>Upload des documents</li>
                            <li>Paiement des frais (10 000 FCFA)</li>
                            <li>Validation des informations</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="step-card p-4">
                        <div class="text-center mb-4">
                            <i class="bi bi-check-circle step-icon"></i>
                        </div>
                        <h4 class="mb-3"><span class="step-number">3</span> Validation finale</h4>
                        <ul class="feature-list list-unstyled">
                            <li>Examen du dossier</li>
                            <li>Entretien éventuel</li>
                            <li>Notification des résultats</li>
                            <li>Dépôt physique du dossier</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Prêt à commencer votre inscription ?</h2>
            <p class="lead mb-5">Rejoignez notre programme d'excellence en Finances Publiques</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="formulaire.php" class="cta-btn">
                    <i class="bi bi-pencil-fill me-2"></i> Commencer l'inscription
                </a>
                <a href="login.php" class="btn btn-outline-primary px-4">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Espace candidat
                </a>
            </div>
            <p class="mt-4 text-muted">
                Vous avez des questions ? <a href="#" class="text-decoration-none">Contactez-nous</a>
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <img src="logo-white.png" alt="Logo PSSFP" height="50" class="mb-3">
                    <p>Programme Supérieur de Spécialisation en Finances Publiques</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Liens utiles</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">Accueil</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Programme</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Inscription</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-geo-alt-fill me-2"></i> Yaoundé, Cameroun</li>
                        <li><i class="bi bi-telephone-fill me-2"></i> (+237) 699 99 99 99</li>
                        <li><i class="bi bi-envelope-fill me-2"></i> contact@pssfp.cm</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 PSSFP - Tous droits réservés</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>