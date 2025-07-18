<?php
require 'auth.php';
requireAuth();
$pdo = new PDO('mysql:host=localhost;dbname=pssfp_candidatures', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$postulants = $pdo->query("SELECT COUNT(*) FROM candidats WHERE statut = 'postulant'")->fetchColumn();
$candidats = $pdo->query("SELECT COUNT(*) FROM candidats WHERE statut = 'candidat'")->fetchColumn();
$total = $pdo->query("SELECT COUNT(*) FROM candidats")->fetchColumn();

// Liste des candidats
$stmt = $pdo->query("SELECT * FROM candidats ORDER BY date_inscription DESC");
$candidatsList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin PSSFP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #570ba6;
            --primary-gradient: linear-gradient(135deg, #570ba6 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --dark-gradient: linear-gradient(135deg, #434343 0%, #000000 100%);
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --card-shadow-hover: 0 15px 40px rgba(0, 0, 0, 0.15);
            --border-radius: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: #2d3748;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(180deg, #570ba6 0%, #3d0875 50%, #2a0555 100%);
            backdrop-filter: blur(10px);
            z-index: 1000;
            transition: var(--transition);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .sidebar-header h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .sidebar-header p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.85rem;
            margin: 0;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-section {
            margin-bottom: 2rem;
        }

        .nav-section-title {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.1em;
            padding: 0 1.5rem;
            margin-bottom: 1rem;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border: none;
            border-radius: 0;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: block;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary-gradient);
            transform: scaleY(0);
            transition: var(--transition);
        }

        .nav-link:hover,
        .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .nav-link:hover::before,
        .nav-link.active::before {
            transform: scaleY(1);
        }

        .nav-link i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
            transition: var(--transition);
        }

        .header {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #570ba6;
            margin-bottom: 0.5rem;
        }

        .header-subtitle {
            color: #718096;
            font-size: 0.95rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover);
        }

        .stat-card.postulants::before {
            background: var(--secondary-gradient);
        }

        .stat-card.candidats::before {
            background: var(--success-gradient);
        }

        .stat-card.total::before {
            background: var(--warning-gradient);
        }

        .stat-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-info h3 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #570ba6;
            margin-bottom: 0.5rem;
        }

        .stat-info p {
            color: #718096;
            font-weight: 500;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
        }

        .stat-card.postulants .stat-icon {
            background: var(--secondary-gradient);
        }

        .stat-card.candidats .stat-icon {
            background: var(--success-gradient);
        }

        .stat-card.total .stat-icon {
            background: var(--warning-gradient);
        }

        .candidates-section {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }

        .section-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #570ba6;
            margin: 0;
        }

        .section-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-modern {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }

        .btn-primary-modern {
            background: var(--primary-gradient);
            color: #fff;
        }

        .btn-primary-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(87, 11, 166, 0.4);
        }

        .table-container {
            padding: 2rem;
        }

        .modern-table {
            width: 100%;
            border-collapse: collapse;
            background: transparent;
        }

        .modern-table th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: #495057;
            font-weight: 600;
            padding: 1rem;
            text-align: left;
            border: none;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .modern-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            vertical-align: middle;
        }

        .modern-table tr {
            transition: var(--transition);
        }

        .modern-table tr:hover {
            background: rgba(87, 11, 166, 0.05);
        }

        .status-select {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.375rem 0.75rem;
            font-size: 0.85rem;
            transition: var(--transition);
            background: #fff;
        }

        .status-select:focus {
            outline: none;
            border-color: #570ba6;
            box-shadow: 0 0 0 3px rgba(87, 11, 166, 0.1);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            transition: var(--transition);
            cursor: pointer;
        }

        .btn-view {
            background: var(--primary-gradient);
            color: #fff;
        }

        .btn-download {
            background: var(--success-gradient);
            color: #fff;
        }

        .btn-delete {
            background: var(--secondary-gradient);
            color: #fff;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .modal-content {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            background: var(--primary-gradient);
            color: #fff;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .modal-title {
            font-weight: 600;
        }

        .btn-close {
            filter: brightness(0) invert(1);
        }

        .loading-spinner {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(87, 11, 166, 0.1);
            border-top: 4px solid #570ba6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4>PSSFP Admin</h4>
            <p>Système de gestion</p>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Navigation</div>
                <a class="nav-link active" href="#">
                    <i class="bi bi-grid-3x3-gap"></i>
                    Dashboard
                </a>
                <a class="nav-link" href="préinscription.php">
                    <i class="bi bi-house"></i>
                    Accueil
                </a>
                <a class="nav-link" href="formulaire.php">
                    <i class="bi bi-plus"></i>
                    Ajouter Candidats
                </a>
                <a class="nav-link" href="#">
                    <i class="bi bi-file-text"></i>
                    Rapports
                </a>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Système</div>
                <a class="nav-link" href="#">
                    <i class="bi bi-gear"></i>
                    Paramètres
                </a>
                <a class="nav-link" href="#">
                    <i class="bi bi-shield-check"></i>
                    Sécurité
                </a>

                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a class="btn btn-danger" href="logout.php">
                                <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                            </a>
                        <?php else: ?>
                            <a class="btn btn-primary" href="login.php">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Connexion
                            </a>
                        <?php endif; ?>
                    
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header fade-in">
            <h1>Tableau de bord</h1>
            <p class="header-subtitle">Vue d'ensemble de votre système de candidatures</p>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid fade-in">
            <div class="stat-card postulants">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3><?= $postulants ?></h3>
                        <p>Postulants</p>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-person-plus"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card candidats">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3><?= $candidats ?></h3>
                        <p>Candidats</p>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-person-check"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card total">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3><?= $total ?></h3>
                        <p>Total</p>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Candidates Table -->
        <div class="candidates-section fade-in">
            <div class="section-header">
                <h2 class="section-title">Liste des candidats</h2>
                <div class="section-actions">
                    <button class="btn-modern btn-primary-modern">
                        <i class="bi bi-download me-1"></i>
                        Exporter
                    </button>
                    <button class="btn-modern btn-primary-modern">
                        <i class="bi bi-printer me-1"></i>
                        Imprimer
                    </button>
                </div>
            </div>

            <div class="table-container">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>N° Candidat</th>
                            <th>Nom complet</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($candidatsList as $candidat): ?>
                            <tr>
                                <td><strong><?= $candidat['numero_candidat'] ?></strong></td>
                                <td><?= $candidat['nom'] . ' ' . $candidat['prenom'] ?></td>
                                <td><?= $candidat['email'] ?></td>
                                <td><?= $candidat['telephone1'] ?></td>
                                <td>
                                    <form class="update-status-form" data-candidate-id="<?= $candidat['id'] ?>">
                                        <select name="statut" class="status-select">
                                            <option value="postulant" <?= $candidat['statut'] == 'postulant' ? 'selected' : '' ?>>Postulant</option>
                                            <option value="candidat" <?= $candidat['statut'] == 'candidat' ? 'selected' : '' ?>>Candidat</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action btn-view view-details" data-bs-toggle="modal"
                                            data-bs-target="#candidateModal" data-candidate-id="<?= $candidat['id'] ?>">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <a href="telecharger_pdf.php?id=<?= $candidat['id'] ?>"
                                            class="btn-action btn-download">
                                            <i class="bi bi-download"></i>
                                        </a>
                                        <button class="btn-action btn-delete delete-candidate"
                                            data-candidate-id="<?= $candidat['id'] ?>">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="candidateModal" tabindex="-1" aria-labelledby="candidateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="candidateModalLabel">Détails du candidat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="candidateDetails">
                    <div class="loading-spinner">
                        <div class="spinner"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Activer les tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Gestion du changement de statut
        document.querySelectorAll('.status-select').forEach(select => {
            select.addEventListener('change', function () {
                const form = this.closest('form');
                const candidateId = form.dataset.candidateId;
                const newStatus = this.value;

                fetch('update_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${candidateId}&statut=${newStatus}`
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Mise à jour réussie - on rafraîchit simplement la page
                            window.location.reload();
                        }
                    })
                    .catch(error => {
                        // On ne fait rien en cas d'erreur, pas de console.log ni d'alerte
                        window.location.reload();
                    });
            });
        });

        // Gestion de l'affichage des détails dans le modal
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', function () {
                const candidateId = this.dataset.candidateId;
                const modalBody = document.getElementById('candidateDetails');

                // Afficher un spinner pendant le chargement
                modalBody.innerHTML = `
                    <div class="loading-spinner">
                        <div class="spinner"></div>
                    </div>
                `;

                // Charger les détails via AJAX
                fetch('get_candidate_details.php?id=' + candidateId)
                    .then(response => response.text())
                    .then(html => {
                        modalBody.innerHTML = html;
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        modalBody.innerHTML = '<div class="alert alert-danger">Erreur lors du chargement des détails</div>';
                    });
            });
        });

        // Gestion de la suppression
        // Gestion de la suppression
        document.querySelectorAll('.delete-candidate').forEach(button => {
            button.addEventListener('click', function () {
                const candidateId = this.dataset.candidateId;

                if (confirm('Êtes-vous sûr de vouloir supprimer ce candidat ?')) {
                    fetch('delete_candidate.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `id=${candidateId}`
                    })
                        .then(() => {
                            // Supprimer la ligne du tableau et recharger la page
                            this.closest('tr').remove();
                            window.location.reload();
                        })
                        .catch(() => {
                            // On ignore complètement les erreurs
                            window.location.reload();
                        });
                }
            });
        });

        // Animation au chargement
        document.addEventListener('DOMContentLoaded', function () {
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 150);
            });
        });
    </script>
</body>

</html>