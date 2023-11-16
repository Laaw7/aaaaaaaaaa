<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'connexion.php'; // Mettez le chemin vers votre fichier de connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['motdepasse']) ? $_POST['motdepasse'] : '';


    // Valider les informations de connexion
    $pdo = new PDO("mysql:host=localhost;dbname=monoshop;charset=utf8", "root", "root");
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user['email'] == $email && $user['motdepasse'] == $password) {
        // Connexion réussie
        $_SESSION['user'] = $user; // Stocker les informations de l'utilisateur dans la session
        header("Location: indexadmin.php"); // Rediriger vers le tableau de bord de l'administrateur
        exit;
    } else {
        // Connexion échouée
        echo "<p>Identifiants incorrects.</p>";
    }
}
?>