<?php
require_once 'auth.php';

logout();

// Rediriger vers la page de connexion avec un message de déconnexion réussie
header('Location: login.php?logout=1');
exit();