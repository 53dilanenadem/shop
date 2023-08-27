<?php 

declare(strict_types=1);

namespace App\Entity;

/**
 * User entity class
 */
class User
{
	private $id;
	private $first_name;
	private $last_name;
	private $email;
	private $username;
	private $pwd;
	private $phone;
	private $role_id;
	private $shup_id;
	private $adress_user;
	//preparons un tableau pour la validation
    public function validation(): array
    {
        $errors = [];

        if (empty($this->first_name)) {
            $errors[] = "Le nom de l'utilisateur est requis";
        }

        if (empty($this->last_name)) {
            $errors[] = "Le prénom de l'utilisateur est requis";
        }

        if (empty($this->email)) {
            $errors[] = "L'adresse email de l'utilisateur est requise";
        }

        if (empty($this->username)) {
            $errors[] = "Le nom d'utilisateur de l'utilisateur est requis";
        }

        if (empty($this->pwd)) {
            $errors[] = "Le mot de passe de l'utilisateur est requis";
        }

        if (empty($this->phone)) {
            $errors[] = "Le numéro de téléphon de l'utilisateur est requis";
        }
        
        if (empty($this->role_id)) {
            $errors[] = "Le role de l'utilisateur est requis";
        }

        if (empty($this->shup_id)) {
            $errors[] = "L'identifiant de la boutique est requis";
        }

        if (empty($this->adress_user)) {
            $errors[] = "Le mot de passe de l'utilisateur est requis";
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
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     *
     * @return self
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     *
     * @return self
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;

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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * @param mixed $pwd
     *
     * @return self
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     *
     * @return self
     */
    public function setPhone($phone)
    {
        $this->phone= $phone;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * @param mixed $role_id
     *
     * @return self
     */
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;

        return $this;
    }

    public function getShupId()
    {
        return $this->shup_id;
    }

    /**
     * @param mixed $shup_id
     *
     * @return self
     */
    public function setShupId($shup_id)
    {
        $this->shup_id = $shup_id;

        return $this;
    }

}