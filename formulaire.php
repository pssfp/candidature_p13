<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PSSFP - Formulaire de Candidature</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f2f0f5;
    }

    header {
      background-color: #6a0dad;
      color: white;
      padding: 20px 30px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    header img {
      height: 60px;
    }

    header .title {
      flex: 1;
      text-align: center;
    }

    .step-indicator {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin: 30px 0;
    }

    .step {
      width: 30px;
      height: 30px;
      background: #d3c0e5;
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
    }

    .step.active {
      background-color: #6a0dad;
    }

    .form-navigation {
      margin-top: 20px;
      display: flex;
      justify-content: space-between;
    }

    .btn-purple {
      background-color: #6a0dad;
      color: white;
    }

    .btn-purple:hover {
      background-color: #570ba6;
      color: white;
    }

    footer {
      text-align: center;
      padding: 20px;
      color: #666;
      font-size: 0.9em;
    }

    .form-step {
      display: none;
    }

    .form-step.active {
      display: block;
    }

    .is-invalid {
      border-color: #dc3545 !important;
    }

    .invalid-feedback {
      color: #dc3545;
      font-size: 0.875em;
    }
  </style>
</head>

<body>
  <header>
    <img src="logo.png" alt="Logo PSSFP">
    <div class="title">
      <h1 class="mb-0">Appel à candidature</h1>
      <p class="mb-0">13ème promotion Master en Finances Publiques</p>
      <p class="mb-0">Année académique: 2025 - 2026</p>
    </div>
  </header>
  <div class="container py-5">
    <h3 class="text-center mb-4">Formulaire de Candidature</h3>
    <center>
      <p>Suivez chaque étapes et remplissez le formulaire étapes par étapes</p>
    </center>
    <form id="multiStepForm" method="POST" action="submit.php">
      <div class="step-indicator">
        <div class="step active">1</div>
        <div class="step">2</div>
        <div class="step">3</div>
        <div class="step">4</div>
        <div class="step">5</div>
        <div class="step">6</div>
      </div>

      <div class="form-step active">
        <h4>I - Spécialité</h4>
        <div class="mb-3">
          <label>Spécialité *</label>
          <select class="form-select" name="specialite" required>
            <option value="">--- Choisir la Spécialité ---</option>
            <option value="Economie Publique et Gestion Publique">Economie Publique et Gestion Publique</option>
            <option value="Fiscalité, Finances et Gestion Publique">Fiscalité, Finances et Gestion Publique</option>
            <option value="Gouvernance territorial et Finance Publique locale">Gouvernance territorial et Finance
              Publique locale</option>
            <option value="Marchés publics et et Partenanriats Public-Privés">Marchés publics et et Partenanriats
              Public-Privés</option>
            <option value="Audit et contrôle">Audit et contrôle</option>
          </select>
        </div>
        <div class="mb-3">
          <label>Type d'étude *</label><br>
          <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" name="type_etude" value="Présentiel" required>
            <label class="form-check-label">Présentiel</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" name="type_etude" value="Distanciel">
            <label class="form-check-label">Distanciel</label>
          </div>
        </div>
        <h4>II - Identité et Informations personnelles</h4>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Photo d'identité (4x4) *</label>
            <input type="file" class="form-control" name="photo" accept="image/*" required>
            <small class="text-muted">Format JPEG ou PNG, taille max 2MB</small>
          </div>
          <div class="col-md-6 mb-3">
            <label>Première Langue *</label>
            <select class="form-select" name="premiere_langue" required>
              <option value="Français">Français</option>
              <option value="Anglais">Anglais</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Civilité *</label>
            <select class="form-select" name="civilite" required>
              <option value="">--- Choisir Civilité ---</option>
              <option value="M.">M.</option>
              <option value="Mme">Mme</option>
              <option value="Mlle">Mlle</option>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label>Nom *</label>
            <input type="text" class="form-control" name="nom" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Prénom *</label>
            <input type="text" class="form-control" name="prenom" required>
          </div>
          <div class="col-md-6 mb-3">
            <label>Épouse</label>
            <input type="text" class="form-control" name="epouse">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Date de naissance *</label>
            <input type="date" class="form-control" name="date_naissance" required>
          </div>
          <div class="col-md-6 mb-3">
            <label>Lieu de naissance *</label>
            <input type="text" class="form-control" name="lieu_naissance" required>
          </div>
        </div>
        <!--<div class="row">
    <div class="col-md-6 mb-3">
      <label>Région *</label>
      <input type="text" class="form-control" name="region" required>
    </div>
    <div class="col-md-6 mb-3">
      <label>Département *</label>
      <input type="text" class="form-control" name="departement" required>
    </div>
  </div>-->
        <div class="row">
          <!--<div class="col-md-6 mb-3">
      <label>Nationalité *</label>
      <input type="text" class="form-control" name="nationalite" required>
    </div>-->
          <div class="col-md-6 mb-3">
            <label>Statut matrimonial *</label>
            <select class="form-select" name="statut_matrimonial" required>
              <option value="">--- Choisir ---</option>
              <option value="Célibataire">Célibataire</option>
              <option value="Marié(e)">Marié(e)</option>
              <option value="Fiancé(e)">Fiancé(e)</option>
            </select>
          </div>
        </div>
      </div>

      <div class="form-step">
        <h4>III - Contacts du candidat</h4>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Pays d'origine *</label>
            <select class="form-select" name="pays_origine" id="pays_origine" required>
              <option value="">--- Sélectionnez un pays ---</option>
              <?php
              $pdo = new PDO('mysql:host=localhost;dbname=pssfp_candidatures', 'root', '');
              $query = "SELECT code_iso, nom FROM pays ORDER BY nom";
              $stmt = $pdo->query($query);
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . $row['code_iso'] . '">' . $row['nom'] . '</option>';
              }
              ?>
            </select>
          </div>

          <div class="col-md-6 mb-3">
            <label>Pays de résidence *</label>
            <select class="form-select" name="pays_residence" id="pays_residence" required>
              <option value="">--- Sélectionnez un pays ---</option>
              <?php
              $stmt = $pdo->query($query);
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . $row['code_iso'] . '">' . $row['nom'] . '</option>';
              }
              ?>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Région *</label>
            <select class="form-select" name="region" id="region" required>
              <option value="">--- Sélectionnez d'abord le pays ---</option>
            </select>
          </div>

          <div class="col-md-6 mb-3">
            <label>Département *</label>
            <select class="form-select" name="departement" id="departement" required>
              <option value="">--- Sélectionnez d'abord la région ---</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Adresse du candidat *</label>
            <input type="text" class="form-control" name="adresse" required>
          </div>

          <div class="col-md-6 mb-3">
            <label>Ville de résidence *</label>
            <input type="text" class="form-control" name="ville_residence" required>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Téléphone (Whatsapp) *</label>
            <div class="input-group">
              <select class="form-select" name="indicatif1" id="indicatif1" style="max-width: 120px;" required>
                <option value="">Indicatif</option>
              </select>
              <input type="tel" class="form-control" name="telephone1" required>
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <label>Autre Téléphone</label>
            <div class="input-group">
              <select class="form-select" name="indicatif2" id="indicatif2" style="max-width: 120px;">
                <option value="">Indicatif</option>
              </select>
              <input type="tel" class="form-control" name="telephone2">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Email personnel *</label>
            <input type="email" class="form-control" name="email" required>
          </div>

          <div class="col-md-6 mb-3">
            <label>Confirmez votre email *</label>
            <input type="email" class="form-control" name="email_confirmation" required>
          </div>
        </div>
      </div>

      <div class="form-step">
        <h4>IV - Cursus Académique</h4>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Dernier diplôme obtenu</label>
            <input type="text" class="form-control" name="diplome_obtenu">
          </div>
          <div class="col-md-6 mb-3">
            <label>Institut d'obtention</label>
            <input type="text" class="form-control" name="institut">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Spécialité du diplôme requis</label>
            <input type="text" class="form-control" name="specialite_diplome">
          </div>
          <div class="col-md-6 mb-3">
            <label>Année d'obtention du diplôme requis</label>
            <input type="number" class="form-control" name="annee_diplome">
          </div>
        </div>

        <h4>V - Vos Coordonnées Professionnelles</h4>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Votre statut actuel *</label>
            <select class="form-select" name="statut_actuel" required>
              <option value="">--- Sélectionnez ---</option>
              <option value="Etudiant">Etudiant</option>
              <option value="Fonctionnaire">Fonctionnaire</option>
              <option value="Contractuel">Contractuel</option>
              <option value="Travailleur privé">Travailleur privé</option>
              <option value="Autre">Autre</option>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label>Employeur</label>
            <input type="text" class="form-control" name="employeur">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Adresse de l'employeur</label>
            <input type="text" class="form-control" name="adresse_employeur2">
          </div>
          <div class="col-md-6 mb-3">
            <label>Téléphone de l'employeur</label>
            <input type="tel" class="form-control" name="tel_employeur">
          </div>
        </div>
        <div class="row">
          <!--<div class="col-md-6 mb-3">
            <label>Email de l'administration</label>
            <input type="email" class="form-control" name="email_admin">
          </div>-->
        </div>
      </div>
      <div class="form-step">
        <h4>VI - Votre avis nous intéresse</h4>
        <div class="mb-3">
          <label>Comment avez-vous connu le PSSFP ? *</label>
          <select class="form-select" name="moyen_connaissance" required>
            <option value="">--- Choisir une réponse ---</option>
            <option value="Réseaux sociaux">Réseaux sociaux</option>
            <option value="Site Web">Site Web</option>
            <option value="Bouche à oreille">Bouche à oreille</option>
            <option value="Autre">Autre</option>
          </select>
        </div>
        <h4>VII - Engagement</h4>
        <div class="mb-3">
          <label>Je soussigné(e)</label>
          <input type="text" class="form-control" name="engagement_nom" required>
        </div>
        <p>Certifie sous l'honneur, l'exactitude des renseignements consignés dans cette fiche de candidature et avoir
          eu connaissance des conditions exigées pour être retenu comme candidat au programme de Master Professionnel en
          Finances Publiques.</p>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="acceptTerms" name="accept_terms" required>
          <label class="form-check-label" for="acceptTerms">J'ai lu et j'accepte les termes, conditions, et
            politiques.</label>
        </div>
      </div> <br>
      <div class="form-step">
        <h4>VI - Récapitulatif</h4>
        <div class="card mb-4">
          <div class="card-body" id="recapContent">
          </div>
        </div>
        <div class="alert alert-info">
          <p>Veuillez vérifier attentivement toutes les informations avant de procéder au paiement.</p>
          <p>Si vous devez modifier une information, utilisez le bouton "Précédent".</p>
        </div>
      </div><br>
      <div class="form-step">
        <h4>VIII - Paiement des frais de candidature</h4>
        <div class="mb-3">
          <label>Mode de paiement *</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="mode_paiement" id="paiement_om" value="OM/MoMo" required>
            <label class="form-check-label" for="paiement_om">Mobile Money (OM/MoMo)</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="mode_paiement" id="paiement_espece" value="Especes"
              required>
            <label class="form-check-label" for="paiement_espece">Espèces (paiement sur place)</label>
          </div>
        </div>

        <div class="mb-3 d-none" id="infoPaiementOM">
          <p class="alert alert-info">Veuillez effectuer un paiement de <strong>10 000 FCFA</strong> via Orange Money ou
            MoMo au numéro suivant : <strong>699 99 99 99</strong>. Ensuite, conservez la preuve de paiement.</p>
        </div>
        <div class="mb-3 d-none" id="infoPaiementEspece">
          <p class="alert alert-info">Le paiement en espèces s'effectuera sur place au moment du dépôt physique de votre
            dossier.</p>
        </div>
      </div>

      <div class="form-navigation">
        <button type="button" class="btn btn-secondary" id="prevBtn">Précédent</button>
        <button type="button" class="btn btn-purple" id="nextBtn">Suivant</button>
        <button type="submit" class="btn btn-success d-none" id="submitBtn">Soumettre</button>
        <button type="reset" class="btn btn-danger">Réinitialiser</button>
      </div>
    </form>
  </div>
  <footer>
    &copy; 2025 Programme Supérieur de Spécialisation en Finances Publiques
  </footer>
  <script>
    const steps = document.querySelectorAll('.form-step');
    const indicators = document.querySelectorAll('.step');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('multiStepForm');
    let currentStep = 0;

saveFirstStepData

    ////////////////////////////////////////////////////////////////////////:
    // Fonction pour charger les régions en fonction du pays sélectionné
    document.getElementById('pays_origine').addEventListener('change', function () {
      const paysCode = this.value;
      const regionSelect = document.getElementById('region');

      // Réinitialiser les sélecteurs dépendants
      regionSelect.innerHTML = '<option value="">--- Chargement... ---</option>';
      document.getElementById('departement').innerHTML = '<option value="">--- Sélectionnez d\'abord la région ---</option>';

      if (paysCode === 'CM') {
        // Charger les régions du Cameroun
        fetch('get_regions.php?pays=CM')
          .then(response => response.json())
          .then(data => {
            regionSelect.innerHTML = '<option value="">--- Sélectionnez une région ---</option>';
            data.forEach(region => {
              regionSelect.innerHTML += `<option value="${region.Region}">${region.Region}</option>`;
            });
          });
      } else if (paysCode) {
        // Pour les autres pays, mettre simplement "Autres"
        regionSelect.innerHTML = '<option value="AUTRES">Autres</option>';
        document.getElementById('departement').innerHTML = '<option value="AUTRES">Autres</option>';
      }
    });

    // Fonction pour charger les départements en fonction de la région sélectionnée
    document.getElementById('region').addEventListener('change', function () {
      const region = this.value;
      const departementSelect = document.getElementById('departement');

      if (region && region !== 'AUTRES') {
        // Charger les départements de la région
        fetch('get_departements.php?region=' + encodeURIComponent(region))
          .then(response => response.json())
          .then(data => {
            departementSelect.innerHTML = '<option value="">--- Sélectionnez un département ---</option>';
            data.forEach(dept => {
              departementSelect.innerHTML += `<option value="${dept.departement}">${dept.departement}</option>`;
            });
          });
      } else if (region === 'AUTRES') {
        departementSelect.innerHTML = '<option value="AUTRES">Autres</option>';
      }
    });

    // Fonction pour charger l'indicatif du pays de résidence
    document.getElementById('pays_residence').addEventListener('change', function () {
      const paysCode = this.value;
      const indicatif1 = document.getElementById('indicatif1');
      const indicatif2 = document.getElementById('indicatif2');

      if (paysCode) {
        fetch('get_indicatif.php?pays=' + paysCode)
          .then(response => response.json())
          .then(data => {
            indicatif1.innerHTML = `<option value="${data.indicatif}">${data.indicatif}</option>`;
            indicatif2.innerHTML = `<option value="${data.indicatif}">${data.indicatif}</option>`;
          });
      } else {
        indicatif1.innerHTML = '<option value="">Indicatif</option>';
        indicatif2.innerHTML = '<option value="">Indicatif</option>';
      }
    });
    ////////////////////////////////////////////////////////////////////////

    nextBtn.addEventListener('click', () => {
    const currentStepFields = steps[currentStep].querySelectorAll('[required]');
    let isValid = true;

    currentStepFields.forEach(field => {
        if (!field.reportValidity()) {
            isValid = false;
            field.classList.add('is-invalid');
        } else {
            field.classList.remove('is-invalid');
        }
    });

    if (!isValid) return;

    // Si c'est le premier step, on sauvegarde et crée le compte
    if (currentStep === 0) {
        saveFirstStepData();
        return; // On ne passe pas à l'étape suivante tout de suite
    }
    
    // Si on arrive à l'étape de récapitulatif, on génère le contenu
    if (currentStep === steps.length - 2) {
        generateRecapContent();
    }
    
    currentStep++;
    updateFormSteps();
});

function saveFirstStepData() {
    const formData = new FormData();
    const firstStepFields = steps[0].querySelectorAll('input, select, textarea');
    
    firstStepFields.forEach(field => {
        if (field.type === 'file') {
            if (field.files[0]) {
                formData.append(field.name, field.files[0]);
            }
        } else {
            formData.append(field.name, field.value);
        }
    });

    fetch('save_first_step.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Stocker l'ID et le numéro de candidat dans le formulaire
            form.dataset.candidateId = data.candidateId;
            form.dataset.numeroCandidat = data.numeroCandidat;
            
            alert(`Votre numéro de candidat est: ${data.numeroCandidat}. Veuillez le noter car il vous servira d'identifiant.`);
            
        } else {
            alert('Erreur: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Une erreur est survenue');
    });
}

// Dans le gestionnaire de soumission du formulaire
form.addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(form);
    formData.append('candidate_id', form.dataset.candidateId);

    fetch('update_candidate.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
    if (data.success) {
        if (data.redirect_url) {
            window.location.href = data.redirect_url;
        } else {
            window.location.href = 'recapitulatif.php?id=' + form.dataset.candidateId;
        }
    } else {
        alert("Erreur: " + data.message);
    }
})
    .catch(error => {
        console.error('Erreur:', error);
        alert("Une erreur s'est produite");
    });
});


form.addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(form);
    formData.append('candidate_id', form.dataset.candidateId);

    fetch('update_candidate.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'recapitulatif.php?id=' + form.dataset.candidateId;
        } else {
            alert("Erreur: " + data.message);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert("Une erreur s'est produite");
    });
});


    ///////////////////////////////////////////////////////////////////////
    function generateRecapContent() {
      const formData = new FormData(document.getElementById('multiStepForm'));
      let recapHTML = '<div class="row">';

      const fieldGroups = {
        'Informations personnelles': ['civilite', 'nom', 'prenom', 'epouse', 'date_naissance', 'lieu_naissance', 'region', 'departement', 'nationalite', 'statut_matrimonial', 'nb_enfants'],
        'Coordonnées': ['pays_origine', 'pays_residence', 'adresse', 'ville_residence', 'telephone1', 'telephone2', 'email'],
        'Formation': ['diplome_obtenu', 'institut', 'specialite_diplome', 'annee_diplome'],
        'Profession': ['statut_actuel', 'employeur', 'adresse_employeur2', 'tel_employeur', 'email_admin'],
        'Autres': ['specialite', 'type_etude', 'moyen_connaissance', 'engagement_nom']
      };

      for (const [groupName, fields] of Object.entries(fieldGroups)) {
        recapHTML += `<div class="col-md-6 mb-4">
            <h5 class="text-purple">${groupName}</h5>
            <dl class="row">`;

        fields.forEach(field => {
          const value = formData.get(field) || 'Non renseigné';
          recapHTML += `<dt class="col-sm-5">${getFieldLabel(field)}</dt>
                          <dd class="col-sm-7">${value}</dd>`;
        });

        recapHTML += `</dl></div>`;
      }

      const photoFile = formData.get('photo');
      if (photoFile && photoFile.name) {
        recapHTML += `<div class="col-12">
            <h5 class="text-purple">Photo</h5>
            <img src="${URL.createObjectURL(photoFile)}" alt="Photo d'identité" class="img-thumbnail" style="max-height: 200px;">
        </div>`;
      }

      recapHTML += '</div>';
      document.getElementById('recapContent').innerHTML = recapHTML;
    }

    function getFieldLabel(fieldName) {
      const labels = {
        'civilite': 'Civilité',
        'nom': 'Nom',
        'prenom': 'Prénom',
        'epouse': 'Nom d\'épouse',
        'date_naissance': 'Date de naissance',
        'lieu_naissance': 'Lieu de naissance',
        'region': 'Région',
        'departement': 'Département',
        'nationalite': 'Nationalité',
        'statut_matrimonial': 'Statut matrimonial',
        'nb_enfants': 'Nombre d\'enfants',
        'pays_origine': 'Pays d\'origine',
        'pays_residence': 'Pays de résidence',
        'adresse': 'Adresse',
        'ville_residence': 'Ville de résidence',
        'telephone1': 'Téléphone principal',
        'telephone2': 'Autre téléphone',
        'email': 'Email',
        'diplome_obtenu': 'Dernier diplôme obtenu',
        'institut': 'Institut',
        'specialite_diplome': 'Spécialité du diplôme',
        'annee_diplome': 'Année d\'obtention',
        'statut_actuel': 'Statut actuel',
        'employeur': 'Employeur',
        'adresse_employeur2': 'Adresse employeur',
        'tel_employeur': 'Téléphone employeur',
        'email_admin': 'Email administratif',
        'specialite': 'Spécialité choisie',
        'type_etude': 'Type d\'étude',
        'moyen_connaissance': 'Comment avez-vous connu le PSSFP?',
        'engagement_nom': 'Nom pour engagement'
      };

      return labels[fieldName] || fieldName;
    }

    // Modifiez la fonction nextBtn.addEventListener pour générer le récapitulatif avant d'afficher l'étape
    /*nextBtn.addEventListener('click', () => {
      const currentStepFields = steps[currentStep].querySelectorAll('[required]');
      let isValid = true;

      currentStepFields.forEach(field => {
        if (!field.reportValidity()) {
          isValid = false;
          field.classList.add('is-invalid');
        } else {
          field.classList.remove('is-invalid');
        }
      });

      if (isValid && currentStep < steps.length - 1) {
        // Si on passe à l'étape de récapitulatif (étape 4), générer le contenu
        if (currentStep === 3) { // L'index commence à 0, donc étape 4 est index 3
          generateRecapContent();
        }
        currentStep++;
        updateFormSteps();
      }
    });*/

    function updateFormSteps() {
      steps.forEach((step, i) => {
        step.classList.toggle('active', i === currentStep);
        indicators[i].classList.toggle('active', i === currentStep);
      });
      prevBtn.style.display = currentStep === 0 ? 'none' : 'inline-block';
      nextBtn.classList.toggle('d-none', currentStep === steps.length - 1);
      submitBtn.classList.toggle('d-none', currentStep !== steps.length - 1);
    }

    nextBtn.addEventListener('click', () => {
      // Validation avant de passer à l'étape suivante
      const currentStepFields = steps[currentStep].querySelectorAll('[required]');
      let isValid = true;

      currentStepFields.forEach(field => {
        if (!field.reportValidity()) {
          isValid = false;
          field.classList.add('is-invalid');
        } else {
          field.classList.remove('is-invalid');
        }
      });

      if (isValid && currentStep < steps.length - 1) {
        currentStep++;
        updateFormSteps();
      }
    });

    prevBtn.addEventListener('click', () => {
      if (currentStep > 0) currentStep--;
      updateFormSteps();
    });

    // Gestion de la soumission du formulaire
    /*form.addEventListener('submit', function (e) {
      e.preventDefault();

      if (validateForm()) {
        // Soumission via Fetch API
        fetch(form.action, {
          method: 'POST',
          body: new FormData(form)
        })
          .then(response => {
            if (response.redirected) {
              window.location.href = response.url;
            } else if (response.ok) {
              return response.text();
            }
            throw new Error('Erreur réseau');
          })
          .then(data => {
            if (data) {
              console.log(data); // Pour le débogage
              window.location.href = 'recapitulatif.php?email=' + encodeURIComponent(form.email.value);
            }
          })
          .catch(error => {
            console.error('Erreur:', error);
            alert("Une erreur s'est produite lors de la soumission.");
          });
      }
    });*/

form.addEventListener('submit', function (e) {
    e.preventDefault();

    if (!validateForm()) return;

    const formData = new FormData(form);
    formData.append('candidate_id', form.dataset.candidateId);

    fetch('update_candidate.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'recapitulatif.php?id=' + form.dataset.candidateId;
        } else {
            alert("Erreur lors de la mise à jour: " + data.message);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert("Une erreur s'est produite lors de la soumission.");
    });
});

//////////////////////////////////////////////
/////////////////////////////////////////////
    // Validation globale du formulaire
    function validateForm() {
      // Validation des emails
      const email = document.querySelector('[name="email"]').value;
      const emailConfirm = document.querySelector('[name="email_confirmation"]').value;

      if (email !== emailConfirm) {
        alert("Les emails ne correspondent pas");
        document.querySelector('[name="email_confirmation"]').classList.add('is-invalid');
        return false;
      }

      // Vérification finale de tous les champs requis
      const requiredFields = document.querySelectorAll('[required]');
      let isValid = true;

      requiredFields.forEach(field => {
        if (!field.value.trim()) {
          isValid = false;
          field.classList.add('is-invalid');
        } else {
          field.classList.remove('is-invalid');
        }
      });
      if (!isValid) {
        alert("Veuillez remplir tous les champs obligatoires");
        for (let i = 0; i < steps.length; i++) {
          const invalidFields = steps[i].querySelectorAll('.is-invalid');
          if (invalidFields.length > 0) {
            currentStep = i;
            updateFormSteps();
            break;
          }
        }
        return false;
      }

      return true;
    }

    // Gestion des informations de paiement
    /*const paiementOM = document.getElementById('paiement_om');
    const paiementEspece = document.getElementById('paiement_espece');
    const infoOM = document.getElementById('infoPaiementOM');
    const infoEspece = document.getElementById('infoPaiementEspece');

    function updatePaymentInfo() {
      if (paiementOM.checked) {
        infoOM.classList.remove('d-none');
        infoEspece.classList.add('d-none');
      } else if (paiementEspece.checked) {
        infoOM.classList.add('d-none');
        infoEspece.classList.remove('d-none');
      }
    }

    paiementOM.addEventListener('change', updatePaymentInfo);
    paiementEspece.addEventListener('change', updatePaymentInfo);*/

    // Validation en temps réel de l'email
    const emailInput = document.querySelector('input[name="email"]');
    const emailConfirmInput = document.querySelector('input[name="email_confirmation"]');

    function validateEmail() {
      if (emailInput.value !== emailConfirmInput.value) {
        emailConfirmInput.setCustomValidity("Les emails ne correspondent pas");
        emailConfirmInput.classList.add('is-invalid');
      } else {
        emailConfirmInput.setCustomValidity("");
        emailConfirmInput.classList.remove('is-invalid');
      }
    }

    emailInput.addEventListener('input', validateEmail);
    emailConfirmInput.addEventListener('input', validateEmail);

    updateFormSteps();
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>