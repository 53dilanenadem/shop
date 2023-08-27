<?php 
require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\View\Helpers\TitleHelper;
use App\Controller\AuthloginController;
use Core\FlashMessages\Flash;

//(new AuthloginController())->User();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="<?= ASSETS .'style.css'?>">
</head>
<body>
    <form action="" method="POST">
        <h2>CONNEXION</h2>
        <label for="">Nom</label>
        <input type="text" name="username" required><br />

        <label for="r">Mot de passe</label>
        <input type="password" id="r" name="password" required><br />

        <label for="e">Confirmer le Mot de passe</label>
        <input type="password" id="e" name="password" required><br />

        <label for="">email</label>
        <input type="mail" name="email" required><br />

        <input class="submit-btn" type="submit" name="login" value="Valider">
    </form>
</body>

</html>