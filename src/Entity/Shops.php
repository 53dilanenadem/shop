<?php 

declare(strict_types=1);

namespace App\Entity;

/**
 * User entity class
 */
class Shops
{
	private $id;
	private $name;
	private $phone_shop;
	private $email;
	private $localization_shops;
	private $logo_shop;
	private $created;
	private $modified;
	private $modified_by;
	//preparons un tableau pour la validation
    public function validation(): array
    {
        $errors = [];

        if (empty($this->name)) {
            $errors[] = "Le nom de la boutique est requis";
        }

        if (empty($this->phone_shop)) {
            $errors[] = "Le numéro de la boutique est requis";
        }

        if (empty($this->email)) {
            $errors[] = "L'adresse email de la boutique est requise";
        }

        if (empty($this->localization_shops)) {
            $errors[] = "Localisation de la boutique est requis";
        }

        return $errors;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoneShop()
    {
        return $this->phone_shop;
    }

    /**
     * @param mixed $phone_number_shop
     *
     * @return self
     */
    public function setPhoneShop($phone_shop)
    {
        $this->phone_shop = $phone_shop;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocalizationShops()
    {
        return $this->localization_shops;
    }

    /**
     * @param mixed $localization
     *
     * @return self
     */
    public function setLocalizationShop($localization_shops)
    {
        $this->localization_shops= $localization_shops;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogoShop()
    {
        return $this->logo_shop;
    }

    /**
     * @param mixed $logo_shop
     *
     * @return self
     */
    public function setLogoShop($logo_shop)
    {
        $this->logo_shop = $logo_shop;

        return $this;
    }

    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     *
     * @return self
     */
    public function setCreated($created)
    {
        $this->created= $created;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param mixed $modified
     *
     * @return self
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    public function getModifiedBy()
    {
        return $this->modified_by;
    }

    /**
     * @param mixed $modified_by
     *
     * @return self
     */
    public function setModifiedBy($modified_by)
    {
        $this->modified_by = $modified_by;

        return $this;
    }

}