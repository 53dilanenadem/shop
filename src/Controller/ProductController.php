<?php

namespace App\Controller;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use Core\Database\ConnectionManager;

class  ProductController
{

    public function Select()
    {
        $connectionManager = new ConnectionManager();

        $sql = "SELECT * FROM products";


        try {
            $data = $connectionManager->getConnection()->prepare($sql);

            $data->execute();

            $GLOBALS['products'] = $data->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("SQL Exception: " . $e->getMessage(), 1);
        }
    }


    //l'ajout d'un produit
    public function Add()
    {

        $connectionManager = new ConnectionManager();

        if (!empty($_POST['name']) && !empty($_POST['image']) && !empty($_POST['price']) && !empty($_POST['description']) && !empty($_POST['shop_id']) && !empty($_POST['user_id'])) {
            //valide les informations
            //strig_tags pour supprimer les baliser html et php d'une chaine
            $name = htmlspecialchars($_POST['name']);
            $image = htmlspecialchars($_POST['image']);
            $price = htmlspecialchars($_POST['price']);
            $description = htmlspecialchars($_POST['description']);
            $shop_id = htmlspecialchars($_POST['shop_id']);
            $user_id = htmlspecialchars($_POST['user_id']);

            // il faut maintenant parser la requette pour l'insertion à la base de donnée
            $sql = "INSERT INTO products(name,image,price,description,shop_id,user_id) VALUES(?,?,?,?,?,?)";


            try {
                $data = $connectionManager->getConnection()->prepare($sql);

                $data->bindValue(1, $name, \PDO::PARAM_STR);
                $data->bindValue(2, $image, \PDO::PARAM_STR);
                $data->bindValue(3, $price, \PDO::PARAM_STR);
                $data->bindValue(4, $description, \PDO::PARAM_STR);
                $data->bindValue(5, $shop_id, \PDO::PARAM_INT);
                $data->bindValue(6, $user_id, \PDO::PARAM_INT);

                $data->execute();

                $GLOBALS['products'] = $data->fetchAll(\PDO::FETCH_ASSOC);
            } catch (\PDOException $e) {
            }
        } else {
            //verification du formulaire et l'envoie du mail a l'utilisateur  concernant les champs
        
        }
    }


    public function  Delete()
    {
        
    }

    public function Edite(){
        $connectionManager = new ConnectionManager();

    }
}
