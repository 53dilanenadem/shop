<?php

declare(strict_types=1);

namespace App\Service;

require_once dirname(dirname(__DIR__)) . DS . DS . 'autoload.php';

use Core\Database\ConnectionManager;

use App\Entity\Shops;
use Core\FlashMessages\Flash;
use Core\Utils\Session;

/**
 * Comapny Services
 */
class shopsServices
{


    /**
     * Get company infos
     * 
     * @return Shops|null Return the company or null if not found
     */
    public function getShops(): ?Shops
    {

        $connectionManager = new ConnectionManager();

        $sql = "SELECT *  FROM shops";

        try {
            $query = $connectionManager->getConnection()->prepare($sql);

            $query->execute();

            $result = $query->fetch(\PDO::FETCH_ASSOC);

            if (empty($result)) {
                return new shops();
            }

            $shops = new shops();
            $shops->setId($result['id']);
            $shops->setName($result['name']);
            $shops->setPhoneShop($result['phone_sohp']);
            $shops->setEmail($result['email']);
            $shops->setLocalizationShop($result['localization_shop']);
            $shops->setLogoShop($result['logo_shop']);
            $shops->setCreated($result['created']);
            $shops->setModified($result['modified']);
            $shops->setModifiedBy($result['modified_by']);


            return $shops;
        } catch (\PDOException $e) {
            throw new \Exception("SQL Exception: " . $e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * Add or update company informations
     *
     * @param array|shops $company shops informations
     * @return boolean Return true if success, false otherwise.
     */
    public function shop(array|shops $shops): bool
    {
        $connectionManager = new ConnectionManager();

        if (is_array($shops)) {
            $shops = $this->toEntity($shops);
        }

        $existedShops = $this->getShops();

        if (empty($existedShops->getId())) {
            $shops->setCreated(date('Y-m-d H:i:s'));
        }

        $shops->setModified(date('Y-m-d H:i:s'));

        $errors = $shops->validation();

        if (!empty($errors)) {
            foreach ($errors as $error) {
                Flash::error($error);
            }

            Session::write('__formdata__', json_encode($_POST));

            return false;
        }

        if (empty($existedShops->getId())) {
            $sql = "INSERT INTO shops(name, phone_shop,email,localization_shop,logo_shop, created,modified,modified_by) VALUES(?,?,?,?,?,?,?,?)";
        } else {
            $sql = "UPDATE shops SET name = ?, phone_shop = ?, email = ?,localization_shop = ? ,logo_shop = ?,created = ?,modified = ?, modified_by = ? WHERE id = ?";
        }

        try {
            $query = $connectionManager->getConnection()->prepare($sql);

            if (empty($existedShops->getId())) {
                $query->bindValue(1, $shops->getName(), \PDO::PARAM_STR);
                $query->bindValue(2, $shops->getPhoneShop(), \PDO::PARAM_STR);
                $query->bindValue(3, $shops->getEmail(), \PDO::PARAM_STR);
                $query->bindValue(4, $shops->getLocalizationShops(), \PDO::PARAM_STR);
                $query->bindValue(5, $shops->getLogoShop(), \PDO::PARAM_STR);
                $query->bindValue(6, $shops->getCreated(), \PDO::PARAM_STR);
                $query->bindValue(7, $shops->getModified(), \PDO::PARAM_STR);
                $query->bindValue(8, $shops->getModifiedBy(), \PDO::PARAM_STR);
            } else {
                $query->bindValue(1, $shops->getName(), \PDO::PARAM_STR);
                $query->bindValue(2, $shops->getPhoneShop(), \PDO::PARAM_STR);
                $query->bindValue(3, $shops->getEmail(), \PDO::PARAM_STR);
                $query->bindValue(4, $shops->getLocalizationShops(), \PDO::PARAM_STR);
                $query->bindValue(5, $shops->getLogoShop(), \PDO::PARAM_STR);
                $query->bindValue(6, $shops->getModified(), \PDO::PARAM_STR);
                $query->bindValue(7, $shops->getModifiedBy(), \PDO::PARAM_STR);
                $query->bindValue(8, $existedShops->getId(), \PDO::PARAM_INT);
            }


            $executed = $query->execute();

            return $executed;
        } catch (\PDOException $e) {
            throw new \Exception("SQL Exception: " . $e->getMessage(), 1);
        }
    }

    /**
     * Parse array to shops object
     *
     * @param array $data Data to parse
     * @return shops|null Returns parsed object or null
     */
    public function toEntity(array $data): ?Shops
    {
        $id = !empty($data['id']) ? (int)$data['id'] : null;
        $name = !empty($data['name']) ? $data['name'] : null;
        $phone_shop= !empty($data['phone_shop']) ? $data['phone_shop'] : null;
        $email= !empty($data['email']) ? $data['email'] : null;
        $localization_shop = !empty($data['localization_shop']) ? $data['localization_shop'] : null;
        $logo_shop = !empty($data['logo_shop']) ? $data['logo_shop'] : null;
        $modified_by = !empty($data['modified_by']) ? $data['modified_by'] : null;
        $created = !empty($data['created']) ? $data['created'] : null;
        $modified = !empty($data['modified']) ? $data['modified'] : null;

        $shops = new shops();
        $shops->setId($id);
        $shops->setName($name);
        $shops->setPhoneShop($phone_shop);
        $shops->setEmail($email);
        $shops->setLocalizationShop($localization_shop);
        $shops->setLogoShop($logo_shop);
        $shops->setCreated($created);
        $shops->setModified($modified);
        $shops->setModifiedBy($modified_by);

        return $shops;
    }
}
