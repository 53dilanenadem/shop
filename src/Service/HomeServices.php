<?php

declare(strict_types=1);

namespace App\Service;

require_once dirname(dirname(__DIR__)) . DS . 'autoload.php';

use Core\Database\ConnectionManager;
use App\Entity\Role;
use App\Entity\User;
use Core\Auth\PwdHasher;
use Core\FlashMessages\Flash;

class HomeServices{

    public function createshop(  $name, $phone_shop, $email,  $localization_shop,  $logo_shop)
    {
        
        $connectionManager = new ConnectionManager();

       
        $name = htmlentities($_POST['name']);
        $phone_sohp = htmlspecialchars($_POST['phone_sohp']);
        $email = htmlentities($_POST['email']);
        $localization_shop = htmlentities($_POST['localization_shop']);
        $logo_shop = htmlentities($_POST['logo_shop']);

         // il faut maintenant parser la requette pour l'insertion à la base de donnée
            $sql = "INSERT INTO shops(name,phone_sohp,email,localization_shop,logo_shop ) VALUES(?,?,?,?,?)";


            try {
                $data = $connectionManager->getConnection()->prepare($sql);

                $data->bindValue(1, $name, \PDO::PARAM_STR);
                $data->bindValue(2, $phone_sohp, \PDO::PARAM_STR);
                $data->bindValue(3, $email, \PDO::PARAM_STR);
                $data->bindValue(4, $localization_shop, \PDO::PARAM_STR);
                $data->bindValue(5, $logo_shop, \PDO::PARAM_STR);
              
                $data->execute([$name,$phone_shop,$email,$localization_shop,$logo_shop]);

                $GLOBALS['shops'] = $data->fetchAll(\PDO::FETCH_ASSOC);
                
                header("Location: " . VIEWS . "Shop/shop.php");
            } catch (\PDOException $e) {
                throw new \Exception("SQL Exception: " . $e->getMessage(), 1);
            }
    }


}

