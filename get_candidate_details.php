<?php
require 'auth.php';
$pdo = new PDO('mysql:host=localhost;dbname=pssfp_candidatures', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'] ?? 0;
$candidat = $pdo->query("SELECT * FROM candidats WHERE id = $id")->fetch(PDO::FETCH_ASSOC);

if ($candidat) {
    ?>
    <div class="row">
        <div class="col-md-4 text-center">
            <?php if ($candidat['photo']): ?>
                <img src="<?= $candidat['photo'] ?>" class="img-fluid rounded mb-3" style="max-height: 200px;">
            <?php else: ?>
                <div class="bg-light p-5 text-muted rounded mb-3">
                    <i class="bi bi-person" style="font-size: 5rem;"></i>
                </div>
            <?php endif; ?>
            <h4><?= $candidat['prenom'] . ' ' . $candidat['nom'] ?></h4>
            <span class="badge rounded-pill <?= $candidat['statut'] == 'postulant' ? 'bg-warning' : 'bg-success' ?>">
                <?= ucfirst($candidat['statut']) ?>
            </span>
            <p class="mt-2"><strong>N° Candidat:</strong> <?= $candidat['numero_candidat'] ?></p>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">Informations personnelles</h5>
                    <p><strong>Civilité:</strong> <?= $candidat['civilite'] ?></p>
                    <p><strong>Nom:</strong> <?= $candidat['nom'] ?></p>
                    <p><strong>Prénom:</strong> <?= $candidat['prenom'] ?></p>
                    <p><strong>Épouse:</strong> <?= $candidat['epouse'] ?: 'Non renseigné' ?></p>
                    <p><strong>Date naissance:</strong> <?= $candidat['date_naissance'] ?></p>
                    <p><strong>Lieu naissance:</strong> <?= $candidat['lieu_naissance'] ?></p>
                    <p><strong>Statut matrimonial:</strong> <?= $candidat['statut_matrimonial'] ?></p>
                    
                    <h5 class="mt-4 mb-3">Coordonnées</h5>
                    <p><strong>Email:</strong> <?= $candidat['email'] ?></p>
                    <p><strong>Téléphone 1:</strong> <?= $candidat['telephone1'] ?></p>
                    <p><strong>Téléphone 2:</strong> <?= $candidat['telephone2'] ?: 'Non renseigné' ?></p>
                    <p><strong>Adresse:</strong> <?= $candidat['adresse'] ?></p>
                    <p><strong>Ville:</strong> <?= $candidat['ville_residence'] ?></p>
                    <p><strong>Pays:</strong> <?= $candidat['pays_residence'] ?></p>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Informations académiques</h5>
                    <p><strong>Spécialité:</strong> <?= $candidat['specialite'] ?></p>
                    <p><strong>Type étude:</strong> <?= $candidat['type_etude'] ?></p>
                    <p><strong>Première langue:</strong> <?= $candidat['premiere_langue'] ?></p>
                    <p><strong>Diplôme obtenu:</strong> <?= $candidat['diplome_obtenu'] ?></p>
                    <p><strong>Institut:</strong> <?= $candidat['institut'] ?></p>
                    <p><strong>Spécialité diplôme:</strong> <?= $candidat['specialite_diplome'] ?></p>
                    <p><strong>Année diplôme:</strong> <?= $candidat['annee_diplome'] ?></p>
                    
                    <h5 class="mt-4 mb-3">Situation professionnelle</h5>
                    <p><strong>Statut actuel:</strong> <?= $candidat['statut_actuel'] ?></p>
                    <p><strong>Employeur:</strong> <?= $candidat['employeur'] ?: 'Non renseigné' ?></p>
                    <p><strong>Tél employeur:</strong> <?= $candidat['tel_employeur'] ?: 'Non renseigné' ?></p>
                    
                    <h5 class="mt-4 mb-3">Autres informations</h5>
                    <p><strong>Date inscription:</strong> <?= $candidat['date_inscription'] ?></p>
                    <p><strong>Moyen connaissance:</strong> <?= $candidat['moyen_connaissance'] ?: 'Non renseigné' ?></p>
                    <p><strong>Mode paiement:</strong> <?= $candidat['mode_paiement'] ?: 'Non renseigné' ?></p>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <h5>Informations géographiques</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Région:</strong> <?= $candidat['region'] ?></p>
                            <p><strong>Département:</strong> <?= $candidat['departement'] ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Pays origine:</strong> <?= $candidat['pays_origine'] ?></p>
                            <p><strong>Engagement nom:</strong> <?= $candidat['engagement_nom'] ?: 'Non renseigné' ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    echo '<div class="alert alert-danger">Candidat non trouvé</div>';
}