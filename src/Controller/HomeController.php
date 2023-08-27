<?php

namespace App\Controller;
use Core\Database\ConnectionManager;


require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use Core\FlashMessages\Flash;
use App\Service\AuthServices;
use App\Service\HomeServices;
use Core\Auth\Auth;


class HomeController
{

    public function index()
    {
    }

   
    public function createshop(){

        if (isset($_POST['valider'])) {
            
            //print_r($_POST); die();
            $name = htmlentities($_POST['name']);
            $phone_shop= htmlentities($_POST['phone_shop']);
            $email = htmlentities($_POST['email']);
            $localization_shop = htmlentities($_POST['localization_shop']);
            $logo_shop = htmlentities($_POST['logo_shop']);
            
            $shops = (new HomeServices())->createshop($name, $phone_shop, $email, $localization_shop, $logo_shop);
            if ($shops) {
                Flash::success("La boutique  a été ajouté avec succès.");
            }
        }

    }

    public function editershop(){

        

    }


    public function Select()
    {
        $connectionManager = new ConnectionManager();

        $sql = "SELECT * FROM shops";


        try {
            $data = $connectionManager->getConnection()->prepare($sql);

            $data->execute();

            $GLOBALS['shops'] = $data->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("SQL Exception: " . $e->getMessage(), 1);
        }
    }
}
