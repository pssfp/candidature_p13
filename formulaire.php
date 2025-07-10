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
        <div class="mb-3">
          <div class="mb-3">
    <label>Photo d'identité (4x4) *</label>
    <input type="file" class="form-control" name="photo" accept="image/*" required>
    <small class="text-muted">Format JPEG ou PNG, taille max 2MB</small>
</div>
          <label>Première Langue *</label>
          <select class="form-select" name="premiere_langue" required>
            <option value="Français">Français</option>
            <option value="Anglais">Anglais</option>
          </select>
        </div>
        <div class="mb-3">
          <label>Civilité *</label>
          <select class="form-select" name="civilite" required>
            <option value="">--- Choisir Civilité ---</option>
            <option value="M.">M.</option>
            <option value="Mme">Mme</option>
            <option value="Mlle">Mlle</option>
          </select>
        </div>
        <div class="mb-3"><label>Nom *</label><input type="text" class="form-control" name="nom" required></div>
        <div class="mb-3"><label>Prénom *</label><input type="text" class="form-control" name="prenom" required></div>
        <div class="mb-3"><label>Épouse</label><input type="text" class="form-control" name="epouse"></div>
        <div class="mb-3"><label>Date de naissance *</label><input type="date" class="form-control"
            name="date_naissance" required></div>
        <div class="mb-3"><label>Lieu de naissance *</label><input type="text" class="form-control"
            name="lieu_naissance" required></div>
        <div class="mb-3"><label>Région *</label><input type="text" class="form-control" name="region" required></div>
        <div class="mb-3"><label>Département *</label><input type="text" class="form-control" name="departement"
            required></div>
        <div class="mb-3"><label>Nationalité *</label><input type="text" class="form-control" name="nationalite"
            required></div>
        <div class="mb-3">
          <label>Statut matrimonial *</label>
          <select class="form-select" name="statut_matrimonial" required>
            <option value="">--- Choisir ---</option>
            <option value="Célibataire">Célibataire</option>
            <option value="Marié(e)">Marié(e)</option>
            <option value="Fiancé(e)">Fiancé(e)</option>
          </select>
        </div>
        <!--<div class="mb-3"><label>Nombre d'enfants à charge *</label><input type="number" class="form-control" name="nb_enfants" required></div>-->
      </div>

      <div class="form-step">
        <h4>III - Contacts du candidat</h4>
        <div class="mb-3"><label>Pays d'origine
            *</label><!--<input type="text" class="form-control" name="pays_origine" required>-->
          <select class="form-select" name="paysOrigine" required>
            <option value="CA">Canada</option>
            <option value="AF">Afghanistan</option>
            <option value="ZA">Afrique du sud</option>
            <option value="AX">Åland, îles</option>
            <option value="AL">Albanie</option>
            <option value="DZ">Algérie</option>
            <option value="DE">Allemagne</option>
            <option value="AD">Andorre</option>
            <option value="AO">Angola</option>
            <option value="AI">Anguilla</option>
            <option value="AQ">Antarctique</option>
            <option value="AG">Antigua et barbuda</option>
            <option value="SA">Arabie saoudite</option>
            <option value="AR">Argentine</option>
            <option value="AM">Arménie</option>
            <option value="AW">Aruba</option>
            <option value="AU">Australie</option>
            <option value="AT">Autriche</option>
            <option value="AZ">Azerbaïdjan</option>
            <option value="BS">Bahamas</option>
            <option value="BH">Bahreïn</option>
            <option value="BD">Bangladesh</option>
            <option value="BB">Barbade</option>
            <option value="BY">Bélarus</option>
            <option value="BE">Belgique</option>
            <option value="BZ">Belize</option>
            <option value="BJ">Bénin</option>
            <option value="BM">Bermudes</option>
            <option value="BT">Bhoutan</option>
            <option value="BO">Bolivie, l'état plurinational de</option>
            <option value="BQ">Bonaire, saint eustache et saba</option>
            <option value="BA">Bosnie herzégovine</option>
            <option value="BW">Botswana</option>
            <option value="BV">Bouvet, île</option>
            <option value="BR">Brésil</option>
            <option value="BN">Brunei darussalam</option>
            <option value="BG">Bulgarie</option>
            <option value="BF">Burkina faso</option>
            <option value="BI">Burundi</option>
            <option value="KY">Caïmans, îles</option>
            <option value="KH">Cambodge</option>
            <option value="CM">Cameroun</option>
            <option value="CV">Cap vert</option>
            <option value="CF">Centrafricaine, république</option>
            <option value="CL">Chili</option>
            <option value="CN">Chine</option>
            <option value="CX">Christmas, île</option>
            <option value="CY">Chypre</option>
            <option value="CC">Cocos (keeling), îles</option>
            <option value="CO">Colombie</option>
            <option value="KM">Comores</option>
            <option value="CG">Congo</option>
            <option value="CD">Congo, la république démocratique du</option>
            <option value="CK">Cook, îles</option>
            <option value="KR">Corée, république de</option>
            <option value="KP">Corée, république populaire démocratique de</option>
            <option value="CR">Costa rica</option>
            <option value="CI">Côte d'ivoire</option>
            <option value="HR">Croatie</option>
            <option value="CU">Cuba</option>
            <option value="CW">Curaçao</option>
            <option value="DK">Danemark</option>
            <option value="DJ">Djibouti</option>
            <option value="DO">Dominicaine, république</option>
            <option value="DM">Dominique</option>
            <option value="EG">Égypte</option>
            <option value="SV">El salvador</option>
            <option value="AE">Émirats arabes unis</option>
            <option value="EC">Équateur</option>
            <option value="ER">Érythrée</option>
            <option value="ES">Espagne</option>
            <option value="EE">Estonie</option>
            <option value="US">États unis</option>
            <option value="ET">Éthiopie</option>
            <option value="FK">Falkland, îles (malvinas)</option>
            <option value="FO">Féroé, îles</option>
            <option value="FJ">Fidji</option>
            <option value="FI">Finlande</option>
            <option value="FR">France</option>
            <option value="GA">Gabon</option>
            <option value="GM">Gambie</option>
            <option value="GE">Géorgie</option>
            <option value="GS">Géorgie du sud et les îles sandwich du sud</option>
            <option value="GH">Ghana</option>
            <option value="GI">Gibraltar</option>
            <option value="GR">Grèce</option>
            <option value="GD">Grenade</option>
            <option value="GL">Groenland</option>
            <option value="GP">Guadeloupe</option>
            <option value="GU">Guam</option>
            <option value="GT">Guatemala</option>
            <option value="GG">Guernesey</option>
            <option value="GN">Guinée</option>
            <option value="GW">Guinée bissau</option>
            <option value="GQ">Guinée équatoriale</option>
            <option value="GY">Guyana</option>
            <option value="GF">Guyane française</option>
            <option value="HT">Haïti</option>
            <option value="HM">Heard et îles macdonald, île</option>
            <option value="HN">Honduras</option>
            <option value="HK">Hong kong</option>
            <option value="HU">Hongrie</option>
            <option value="IM">Île de man</option>
            <option value="UM">Îles mineures éloignées des états unis</option>
            <option value="VG">Îles vierges britanniques</option>
            <option value="VI">Îles vierges des états unis</option>
            <option value="IN">Inde</option>
            <option value="ID">Indonésie</option>
            <option value="IR">Iran, république islamique d'</option>
            <option value="IQ">Iraq</option>
            <option value="IE">Irlande</option>
            <option value="IS">Islande</option>
            <option value="IL">Israël</option>
            <option value="IT">Italie</option>
            <option value="JM">Jamaïque</option>
            <option value="JP">Japon</option>
            <option value="JE">Jersey</option>
            <option value="JO">Jordanie</option>
            <option value="KZ">Kazakhstan</option>
            <option value="KE">Kenya</option>
            <option value="KG">Kirghizistan</option>
            <option value="KI">Kiribati</option>
            <option value="KW">Koweït</option>
            <option value="LA">Lao, république démocratique populaire</option>
            <option value="LS">Lesotho</option>
            <option value="LV">Lettonie</option>
            <option value="LB">Liban</option>
            <option value="LR">Libéria</option>
            <option value="LY">Libye</option>
            <option value="LI">Liechtenstein</option>
            <option value="LT">Lituanie</option>
            <option value="LU">Luxembourg</option>
            <option value="MO">Macao</option>
            <option value="MK">Macédoine, l'ex république yougoslave de</option>
            <option value="MG">Madagascar</option>
            <option value="MY">Malaisie</option>
            <option value="MW">Malawi</option>
            <option value="MV">Maldives</option>
            <option value="ML">Mali</option>
            <option value="MT">Malte</option>
            <option value="MP">Mariannes du nord, îles</option>
            <option value="MA">Maroc</option>
            <option value="MH">Marshall, îles</option>
            <option value="MQ">Martinique</option>
            <option value="MU">Maurice</option>
            <option value="MR">Mauritanie</option>
            <option value="YT">Mayotte</option>
            <option value="MX">Mexique</option>
            <option value="FM">Micronésie, états fédérés de</option>
            <option value="MD">Moldova, république de</option>
            <option value="MC">Monaco</option>
            <option value="MN">Mongolie</option>
            <option value="ME">Monténégro</option>
            <option value="MS">Montserrat</option>
            <option value="MZ">Mozambique</option>
            <option value="MM">Myanmar</option>
            <option value="NA">Namibie</option>
            <option value="NR">Nauru</option>
            <option value="NP">Népal</option>
            <option value="NI">Nicaragua</option>
            <option value="NE">Niger</option>
            <option value="NG">Nigéria</option>
            <option value="NU">Niué</option>
            <option value="NF">Norfolk, île</option>
            <option value="NO">Norvège</option>
            <option value="NC">Nouvelle calédonie</option>
            <option value="NZ">Nouvelle zélande</option>
            <option value="IO">Océan indien, territoire britannique de l'</option>
            <option value="OM">Oman</option>
            <option value="UG">Ouganda</option>
            <option value="UZ">Ouzbékistan</option>
            <option value="PK">Pakistan</option>
            <option value="PW">Palaos</option>
            <option value="PS">Palestinien occupé, territoire</option>
            <option value="PA">Panama</option>
            <option value="PG">Papouasie nouvelle guinée</option>
            <option value="PY">Paraguay</option>
            <option value="NL">Pays bas</option>
            <option value="PE">Pérou</option>
            <option value="PH">Philippines</option>
            <option value="PN">Pitcairn</option>
            <option value="PL">Pologne</option>
            <option value="PF">Polynésie française</option>
            <option value="PR">Porto rico</option>
            <option value="PT">Portugal</option>
            <option value="QA">Qatar</option>
            <option value="RE">Réunion</option>
            <option value="RO">Roumanie</option>
            <option value="GB">Royaume uni</option>
            <option value="RU">Russie, fédération de</option>
            <option value="RW">Rwanda</option>
            <option value="EH">Sahara occidental</option>
            <option value="BL">Saint barthélemy</option>
            <option value="SH">Sainte hélène, ascension et tristan da cunha</option>
            <option value="LC">Sainte lucie</option>
            <option value="KN">Saint kitts et nevis</option>
            <option value="SM">Saint marin</option>
            <option value="MF">Saint martin(partie française)</option>
            <option value="SX">Saint martin (partie néerlandaise)</option>
            <option value="PM">Saint pierre et miquelon</option>
            <option value="VA">Saint siège (état de la cité du vatican)</option>
            <option value="VC">Saint vincent et les grenadines</option>
            <option value="SB">Salomon, îles</option>
            <option value="WS">Samoa</option>
            <option value="AS">Samoa américaines</option>
            <option value="ST">Sao tomé et principe</option>
            <option value="SN">Sénégal</option>
            <option value="RS">Serbie</option>
            <option value="SC">Seychelles</option>
            <option value="SL">Sierra leone</option>
            <option value="SG">Singapour</option>
            <option value="SK">Slovaquie</option>
            <option value="SI">Slovénie</option>
            <option value="SO">Somalie</option>
            <option value="SD">Soudan</option>
            <option value="SS">Soudan du sud</option>
            <option value="LK">Sri lanka</option>
            <option value="SE">Suède</option>
            <option value="CH">Suisse</option>
            <option value="SR">Suriname</option>
            <option value="SJ">Svalbard et île jan mayen</option>
            <option value="SZ">Swaziland</option>
            <option value="SY">Syrienne, république arabe</option>
            <option value="TJ">Tadjikistan</option>
            <option value="TW">Taïwan, province de chine</option>
            <option value="TZ">Tanzanie, république unie de</option>
            <option value="TD">Tchad</option>
            <option value="CZ">Tchèque, république</option>
            <option value="TF">Terres australes françaises</option>
            <option value="TH">Thaïlande</option>
            <option value="TL">Timor leste</option>
            <option value="TG">Togo</option>
            <option value="TK">Tokelau</option>
            <option value="TO">Tonga</option>
            <option value="TT">Trinité et tobago</option>
            <option value="TN">Tunisie</option>
            <option value="TM">Turkménistan</option>
            <option value="TC">Turks et caïcos, îles</option>
            <option value="TR">Turquie</option>
            <option value="TV">Tuvalu</option>
            <option value="UA">Ukraine</option>
            <option value="UY">Uruguay</option>
            <option value="VU">Vanuatu</option>
            <option value="VE">Venezuela, république bolivarienne du</option>
            <option value="VN">Viet nam</option>
            <option value="WF">Wallis et futuna</option>
            <option value="YE">Yémen</option>
            <option value="ZM">Zambie</option>
            <option value="ZW">Zimbabwe​​​​​</option>
          </select>
        </div>
        <div class="mb-3"><label>Pays de résidence *</label><input type="text" class="form-control"
            name="pays_residence" required></div>
        <div class="mb-3"><label>Adresse du candidat *</label><input type="text" class="form-control" name="adresse"
            required></div>
        <div class="mb-3"><label>Ville de résidence *</label><input type="text" class="form-control"
            name="ville_residence" required></div>
       <div class="mb-3">
    <label>Téléphone (Whatsapp) *</label>
    <div class="input-group">
        <select class="form-select" name="indicatif1" style="max-width: 120px;" required>
            <option value="">Indicatif</option>
            <option value="+237">Cameroun (+237)</option>
            <option value="+225">Côte d'Ivoire (+225)</option>
            <!-- Ajoutez d'autres pays selon vos besoins -->
        </select>
        <input type="tel" class="form-control" name="telephone1" required>
    </div>
</div>

<div class="mb-3">
    <label>Autre Téléphone</label>
    <div class="input-group">
        <select class="form-select" name="indicatif2" style="max-width: 120px;">
            <option value="">Indicatif</option>
            <option value="+237">Cameroun (+237)</option>
            <option value="+225">Côte d'Ivoire (+225)</option>
            <!-- Ajoutez d'autres pays selon vos besoins -->
        </select>
        <input type="tel" class="form-control" name="telephone2">
    </div>
</div>
        <div class="mb-3"><label>Email personnel *</label><input type="email" class="form-control" name="email"
            required></div>
        <div class="mb-3"><label>Confirmez votre email *</label><input type="email" class="form-control"
            name="email_confirmation" required></div>
      </div>

      <div class="form-step">
        <h4>IV - Cursus Académique</h4>
        <div class="mb-3"><label>Dernier diplôme obtenu</label><input type="text" class="form-control"
            name="diplome_obtenu"></div>
        <div class="mb-3"><label>Institut d'obtention</label><input type="text" class="form-control"
            name="institut"></div>
        <div class="mb-3"><label>Spécialité du diplôme requis</label><input type="text" class="form-control"
            name="specialite_diplome"></div>
        <div class="mb-3">
          <label>Année d'obtention du diplôme requis</label>
          <input type="number" class="form-control" name="annee_diplome">
        </div>
        <h4>V - Vos Coordonnées Professionnelles</h4>
        <div class="mb-3">
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
        <div class="mb-3"><label>Employeur</label><input type="text" class="form-control" name="employeur"></div>
        <div class="mb-3"><label>Adresse de l'employeur</label><input type="text" class="form-control"
            name="adresse_employeur2"></div>
        <div class="mb-3"><label>Téléphone de l'employeur</label><input type="tel" class="form-control"
            name="tel_employeur"></div>
        <div class="mb-3"><label>Email de l'administration</label><input type="email" class="form-control"
            name="email_admin"></div>
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
    form.addEventListener('submit', function (e) {
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
    });

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
        // Aller à la première étape avec erreur
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
    const paiementOM = document.getElementById('paiement_om');
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
    paiementEspece.addEventListener('change', updatePaymentInfo);

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