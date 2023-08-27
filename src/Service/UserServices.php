<?php

declare(strict_types=1);

namespace App\Service;

require_once dirname(dirname(__DIR__)) . DS . DS . 'autoload.php';

use Core\Database\ConnectionManager;
use App\Entity\User;
use App\Entity\Role;
use Core\Auth\PasswordHasher;
use Core\FlashMessages\Flash;

/**
 * user Services
 */
class UserServices
{
	/**
	 * @var ConnectionManager $connectionManager
	 */
	private $connectionManager;

	/**
	 * Default configuration for queries
	 * @var array $query_default_config
	 */
	private $query_default_config = [
		'joinRole' => false,
		'limit' => 50,
		'offset' => 0,
		'conditions' => [],
		'order' => 'first_name',
		'order_dir' => 'DESC',
	];

	function __construct()
	{
		$this->connectionManager = new ConnectionManager();
	}

	/**
	 * Get All user
	 * @param  bool|boolean $joinRole Determines if roles should be joined
	 * @return array                  Array of user or empty array
	 * @throw \Exception When error occurs
	 */
	public function getAll(bool $joinRole = false)
	{
		$result = [];
		$user = [];
		$join = '';

		$select = "SELECT u.id AS User_id, u.first_name AS User_first_name, u.last_name AS User_last_name, u.email AS User_email, u.username AS User_username, u.pwd AS User_pwd, u.phone_number AS User_phone_number, u.role_id AS User_role_id, u.shup_id AS User_shup_id, u.adress_user AS User_adress_user";

		if ($joinRole) {
			$select .= " , r.id AS Role_id, r.code AS Role_code, r.name AS Role_name ";
			$join = " JOIN roles r ON r.id = e.role_id  ";
		}

		$sql = $select . " FROM user e ";

		try {
			$query = $this->connectionManager->getConnection()->prepare($sql);

			$query->execute([1]);

			$result = $query->fetchAll(\PDO::FETCH_ASSOC);
		} catch (\PDOException $e) {
			throw new \Exception("SQL Exception: " . $e->getMessage(), 1);
		}

		if (empty($result)) {
			return [];
		}

		foreach ($result as $row) {
			$User = new User();
			$User->setId($row['User_id']);
			$User->setFirstName($row['User_first_name']);
			$User->setLastName($row['User_last_name']);
			$User->setEmail($row['User_email']);
			$User->setUsername($row['User_username']);
			$User->setPwd($row['User_pwd']);
			$User->setPhone($row['User_phone_number']);
			$User->setRoleId($row['User_role_id']);
			$User->setShupId($row['User_shup_id']);



			if ($joinRole) {
				$role = new Role();
				$role->setId($row['Role_id']);
				$role->setCode($row['Role_code']);
				$role->setName($row['Role_name']);
			}

			$user[] = $user;
		}

		return $user;
	}

	/**
	 * Count all user
	 * 
	 * @return int Number of user
	 */
	public function countAll(): int
	{
		$count = 0;
		$join = '';

		$sql = "SELECT COUNT(*) AS count FROM user e WHERE e.etat = ?";

		try {
			$query = $this->connectionManager->getConnection()->prepare($sql);

			$query->execute([1]);

			$result = $query->fetch(\PDO::FETCH_ASSOC);

			$count = (int)$result['count'];
		} catch (\PDOException $e) {
			throw new \Exception("SQL Exception: " . $e->getMessage(), 1);
		}

		return $count;
	}

	public function getById($id, bool $bypass = false): ?User
	{
		$result = [];

		$sql = "SELECT u.id AS User_id, u.first_name AS User_first_name, u.last_name AS User_last_name, u.email AS User_email, u.username AS User_username, u.pwd AS User_pwd,u.phone_number AS User_phone_number,u.roler_id AS User_roler_id,u.shup_id AS User_shup_id, u.adress_user AS User_adress_user,  r.id AS Roler_id, r.code AS Roler_code, r.name AS Roler_name
			FROM user u 
			JOIN roler r ON r.id = u.role_id 
			WHERE u.id = ?";

		
		try {
			$query = $this->connectionManager->getConnection()->prepare($sql);
			$query->bindValue(1, $id, \PDO::PARAM_INT);
			if (!$bypass) {
				$query->bindValue(2, true, \PDO::PARAM_BOOL);
			}
			$query->execute();

			$result = $query->fetch(\PDO::FETCH_ASSOC);
		} catch (\PDOException $e) {
			throw new \Exception("SQL Exception: " . $e->getMessage(), 1);
		}

		if (empty($result)) {
			return null;
		}

		$role = new Role();
		$role->setId($result['Role_id']);
		$role->setCode($result['Role_code']);
		$role->setName($result['Role_name']);

		$user = new User();
		$user->setId($result['User_id']);
		$user->setFirstName($result['User_first_name']);
		$user->setLastName($result['User_last_name']);
		$user->setEmail($result['User_email']);
		$user->setUsername($result['User_username']);
		$user->setPwd($result['User_pwd']);
		$user->setPhone($result['User_phone_number']);
		$user->setRoleId($result['User_role_id']);
		$user->setShupId($result['User_shup_id']);


		return $user;
	}

	/**
	 * l'ajout d'un utilisateur
	 */
	public function add(array|User $user): bool|int

	{

		if ($this->checkUser($user)) {
			Flash::error("Un utlisateur avec les mêmes informations existe déjà.");


			return false;
		}

		$errors = $user->validation();
		if (!empty($errors)) {
			foreach ($errors as $error) {
				Flash::error($error);
			}



			return false;
		}

		$sql = "INSERT INTO user (first_name, last_name, email, username, pwd, role_id) VALUES (?,?,?,?,?,?)";

		try {

			$this->connectionManager->getConnection()->beginTransaction();

			$query = $this->connectionManager->getConnection()->prepare($sql);
			$query->bindValue(1, $user->getFirstName(), \PDO::PARAM_STR);
			$query->bindValue(2, $user->getLastName(), \PDO::PARAM_STR);
			$query->bindValue(3, $user->getEmail(), \PDO::PARAM_STR);
			$query->bindValue(4, $user->getUsername(), \PDO::PARAM_STR);
			$query->bindValue(5, $user->getPwd(), \PDO::PARAM_STR);
			$query->bindValue(6, $user->getRoleId(), \PDO::PARAM_INT);
			$query->execute();
			$userId = $this->connectionManager->getConnection()->lastInsertId();

			$this->connectionManager->getConnection()->commit();

			return (int)$userId;
		} catch (\PDOException $e) {
			throw new \Exception("SQL Exception: " . $e->getMessage(), 1);
		}
	}

	/**
	 * Update user
	 *
	 * @param array|User $user  data
	 * @return bool Returns true if the user was updated, false otherwise
	 */
	public function update(array|User $user): bool
	{
		if (is_array($user)) {
			$user = $this->toEntity($user);
		}

		$existedUser = $this->getById($user->getId());

		if (empty($existedUser)) {
			Flash::error("Aucun employé trouvé avec l'id " . $user->getId());

			return false;
		}

		$sql = "UPDATE employees SET first_name = ?, last_name = ?, email = ?, username = ?, pwd = ?, roler_id = ?, shup_id = ? WHERE id = ?";

		try {

			$this->connectionManager->getConnection()->beginTransaction();

			$query = $this->connectionManager->getConnection()->prepare($sql);

			if (empty($user->getFirstName())) {
				$query->bindValue(1, $existedUser->getFirstName(), \PDO::PARAM_STR);
			} else {
				$query->bindValue(1, $user->getFirstName(), \PDO::PARAM_STR);
			}

			if (empty($user->getLastName())) {
				$query->bindValue(2, $existedUser->getLastName(), \PDO::PARAM_STR);
			} else {
				$query->bindValue(2, $user->getLastName(), \PDO::PARAM_STR);
			}

			if (empty($user->getEmail())) {
				$query->bindValue(3, $existedUser->getEmail(), \PDO::PARAM_STR);
			} else {
				$query->bindValue(3, $user->getEmail(), \PDO::PARAM_STR);
			}

			if (empty($user->getUsername())) {
				$query->bindValue(4, $existedUser->getUsername(), \PDO::PARAM_STR);
			} else {
				$query->bindValue(4, $user->getUsername(), \PDO::PARAM_STR);
			}

			if (empty($user->getPwd())) {
				$query->bindValue(5, $existedUser->getPwd(), \PDO::PARAM_STR);
			} else {
				$query->bindValue(5, $user->getPwd(), \PDO::PARAM_STR);
			}

			if (empty($user->getRoleId())) {
				$query->bindValue(6, $existedUser->getRoleId(), \PDO::PARAM_STR);
			} else {
				$query->bindValue(6, $user->getRoleId(), \PDO::PARAM_STR);
			}

			$query->bindValue(7, $user->getId(), \PDO::PARAM_INT);

			$updated = $query->execute();

			$this->connectionManager->getConnection()->commit();

			return $updated;
		} catch (\PDOException $e) {
			throw new \Exception("SQL Exception: " . $e->getMessage(), 1);
		}
	}

	/**
	 * Delete user method
	 *
	 * @param integer $id USER id
	 * @return boolean Returns true if user was deleted, false otherwise.
	 */
	public function delete(int $id): bool
	{
		$existedEmployee = $this->getById($id);
		if (empty($existedEmployee)) {
			Flash::error("Aucun employé trouvé avec l'id " . $id);

			return false;
		}

		$sql = "UPDATE user WHERE id = ?";

		try {
			$query = $this->connectionManager->getConnection()->prepare($sql);

			$query->bindValue(1, 0, \PDO::PARAM_BOOL);
			$query->bindValue(2, 'deleted', \PDO::PARAM_STR);
			$query->bindValue(3, $id, \PDO::PARAM_INT);

			$deleted = $query->execute();

			return $deleted;
		} catch (\PDOException $e) {
			throw new \Exception("SQL Exception: " . $e->getMessage(), 1);
		}
	}

	//check user
	public function checkUser(USER $user): bool
	{
		$exist = true;

		$sql = "SELECT * FROM user WHERE first_name = ? AND last_name = ? AND email = ?";
		if (!is_null($user->getId())) {
			$sql .= " AND id != ?";
		}

		$sql .= " LIMIT 0,1";

		try {
			$query = $this->connectionManager->getConnection()->prepare($sql);
			$query->bindValue(1, $user->getFirstName());
			$query->bindValue(2, $user->getLastName());
			$query->bindValue(3, $user->getEmail());
			$query->bindValue(4, true, \PDO::PARAM_BOOL);
			if (!is_null($user->getId())) {
				$query->bindValue(5, $user->getId(), \PDO::PARAM_INT);
			}

			$query->execute();

			$result = $query->fetch(\PDO::FETCH_ASSOC);

			if (empty($result)) {
				$exist = false;
			} else {
				$exist = true;
			}
		} catch (\PDOException $e) {
			throw new \Exception("SQL Exception: " . $e->getMessage(), 1);
		}

		return $exist;
	}

	/**
	 * Parse user data to entity
	 */
	public function toEntity(array $data): ?User
	{
		$id = $data['id'] ? (int)$data['id'] : null;
		$first_name = !empty($data['first_name']) ? htmlentities($data['first_name']) : null;
		$last_name = !empty($data['last_name']) ? htmlentities($data['last_name']) : null;
		$username = !empty($data['username']) ? htmlentities($data['username']) : null;
		$email = !empty($data['email']) ? htmlentities($data['email']) : null;
		$password = !empty($data['password']) ? (new PasswordHasher())->hash(htmlentities($data['password'])) : null;
		$role_id = !empty($data['role_id']) ? htmlentities($data['role_id']) : null;

		$user = new User();
		$user->setId($id);
		$user->setFirstName($first_name);
		$user->setLastName($last_name);
		$user->setEmail($email);
		$user->setUsername($username);
		$user->setRoleId($role_id);
		$user->setPwd($password);

		return $user;
	}
}
