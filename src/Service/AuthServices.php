<?php

declare(strict_types=1);

namespace App\Service;

require_once dirname(dirname(__DIR__)) . DS . 'autoload.php';

use Core\Database\ConnectionManager;
use App\Entity\Role;
use App\Entity\User;
use Core\Auth\PwdHasher;
use Core\FlashMessages\Flash;

class AuthServices
{

    

    public function login(string $username, string $pwd): ?User
    {
        $connectionManager = new ConnectionManager();

        $hashedPwd = (new PwdHasher())->hash($pwd);

        $result = [];

        $sql = "SELECT u.id AS User_id, u.first_name AS User_first_name,
         u.last_name AS User_last_name, u.email AS User_email, 
         u.username AS User_username, u.pwd AS User_pwd, 
         u.phone AS User_phone, u.role_id AS User_role_id, 
         u.shup_id AS User_shup_id, u.adress_user AS User_adress_user,
         r.code AS Role_code, r.name AS Role_name 
            FROM user u 
            JOIN roles r ON r.id = u.role_id 
            WHERE u.username = ? AND u.pwd = ?";

        try {
            $query = $connectionManager->getConnection()->prepare($sql);

            $query->execute([$username, $hashedPwd]);

            $result = $query->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("SQL Exception: " . $e->getMessage(), 1);
        }

        if (empty($result)) {
            return null;
        }
        $role = new Role();
        $role->setId($result['Roler_id']);
        $role->setCode($result['Roler_code']);
        $role->setName($result['Roler_name']);

        $User = new User();
        $User->setId($result['User_id']);
        $User->setFirstName($result['User_first_name']);
        $User->setLastName($result['User_last_name']);
        $User->setEmail($result['User_email']);
        $User->setUsername($result['User_username']);
        $User->setPwd($result['User_pwd']);
        $User->setPhone($result['User_phone']);
        $User->setRoleId($result['User_role_id']);
        $User->setShupId($result['User_shup_id']);


        return $User;
    }





    public function register(string $username, string $pwd, string $email, $role_id)
    {
        $connectionManager = new ConnectionManager();

        $hashedPwd = (new PwdHasher())->hash($pwd);

        $sql = "INSERT INTO user (username, pwd, email, role_id) VALUES (?,?,?,?)";

        try {



            $query = $connectionManager->getConnection()->prepare($sql);
            $query->bindValue(1, $username, \PDO::PARAM_STR);
            $query->bindValue(2, $pwd, \PDO::PARAM_STR);
            $query->bindValue(3, $email, \PDO::PARAM_STR);
            $query->bindValue(4, $role_id, \PDO::PARAM_INT);

            $query->execute([$username, $hashedPwd, $email, $role_id]);

            header("Location: " . VIEWS . "Auth/login.php");
        } catch (\PDOException $e) {
            throw new \Exception("SQL Exception: " . $e->getMessage(), 1);
        }
    }
}
