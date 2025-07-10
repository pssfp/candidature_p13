<?php
session_start();
require 'auth.php';
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
    <style>
        :root {
            --primary-color: #570ba6;
            --secondary-color: #1cc88a;
            --warning-color: #f6c23e;
            --dark-color: #5a5c69;
        }
        
        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f8f9fc;
        }
        
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 1rem;
            font-weight: 600;
            margin: 0.2rem 0;
        }
        
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .sidebar-heading {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: 0.13em;
            padding: 0 1rem;
            margin-top: 1rem;
        }
        
        .card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            font-weight: 700;
        }
        
        .stat-card {
            border-left: 0.25rem solid;
        }
        
        .stat-card.postulants {
            border-left-color: var(--primary-color);
        }
        
        .stat-card.candidats {
            border-left-color: var(--secondary-color);
        }
        
        .stat-card.total {
            border-left-color: var(--warning-color);
        }
        
        .badge-postulant {
            background-color: var(--warning-color);
        }
        
        .badge-candidat {
            background-color: var(--secondary-color);
        }
        
        .table {
            font-size: 0.85rem;
        }
        
        .table th {
            border-top: none;
            font-weight: 700;
            color: var(--dark-color);
            text-transform: uppercase;
            font-size: 0.65rem;
            letter-spacing: 0.08em;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">PSSFP Admin</h4>
                    </div>
                    <hr class="sidebar-divider my-0">
                    <div class="sidebar-heading">Interface</div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-people me-2"></i>Candidats
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-gear me-2"></i>Paramètres
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Tableau de bord</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Exporter</button>
                        </div>
                    </div>
                </div>
                
                <!-- Stats -->
                <div class="row mb-4">
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card stat-card postulants h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-primary mb-0">Postulants</h6>
                                        <h2 class="my-2"><?= $postulants ?></h2>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-person-plus fs-1 text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card stat-card candidats h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-success mb-0">Candidats</h6>
                                        <h2 class="my-2"><?= $candidats ?></h2>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-person-check fs-1 text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card stat-card total h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-warning mb-0">Total</h6>
                                        <h2 class="my-2"><?= $total ?></h2>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-people fs-1 text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Liste des candidats -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Liste des candidats</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li><a class="dropdown-item" href="#">Exporter en Excel</a></li>
                                <li><a class="dropdown-item" href="#">Imprimer</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>N° Candidat</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($candidatsList as $candidat): ?>
                                    <tr>
                                        <td><?= $candidat['numero_candidat'] ?></td>
                                        <td><?= $candidat['prenom'] . ' ' . $candidat['nom'] ?></td>
                                        <td><?= $candidat['email'] ?></td>
                                        <td><?= $candidat['telephone1'] ?></td>
                                        <td>
                                            <span class="badge rounded-pill <?= $candidat['statut'] == 'postulant' ? 'badge-postulant' : 'badge-candidat' ?>">
                                                <?= ucfirst($candidat['statut']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="recapitulatif.php?id=<?= $candidat['id'] ?>" class="btn btn-primary" 
                                                   data-bs-toggle="tooltip" title="Voir détails">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="telecharger_pdf.php?id=<?= $candidat['id'] ?>" class="btn btn-info text-white"
                                                   data-bs-toggle="tooltip" title="Télécharger PDF">
                                                    <i class="bi bi-download"></i>
                                                </a>
                                                <button class="btn btn-danger" data-bs-toggle="tooltip" title="Supprimer">
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
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Activer les tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>
</body>
</html>