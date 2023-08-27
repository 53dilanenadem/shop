<?php

declare(strict_types=1);

namespace App\Controller;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Service\AuthServices;
use Core\Auth\Auth;
use Core\FlashMessages\Flash;

/**
 * Authentication Controller
 */
class AuthController
{
	const UNAUTHORIZED_REDIRECT = VIEWS . 'Auth/login.php';
	const AUTHORIZED_REDIRECT = BASE_URL;

	public function login()
	{
		if (Auth::isConnected()) {
			header("Location: " . self::AUTHORIZED_REDIRECT);
			exit;
		}

		if (isset($_POST['login'])) {
			$username = htmlentities($_POST['username']);
			$pwd = htmlentities($_POST['pwd']);

			$user = (new AuthServices())->login($username, $pwd);

			if (empty($user)) {
				Flash::error("Le nom d'utilisateur ou le mot de passe est incorrect.");
			} else {
				

				Auth::setUser($user);

				Flash::success("Connexion reussie");

				if (isset($_GET['redirect'])) {
					header("Location: " . $_GET['redirect']);
					exit;
				}

				header("Location: " . self::AUTHORIZED_REDIRECT);
			}
		}
	}

	public static function logout()
	{
		Auth::unsetUser();

		Flash::success("A bientôt!");

		header('Location: ' . self::UNAUTHORIZED_REDIRECT);
		exit;
	}

	public function getAuthUser(){
		$GLOBALS['auth_user'] = (new Auth())->getAuthUser();
	}

	public function register()
	{
		

		if (isset($_POST['register'])) {

			$username = htmlentities($_POST['username']);
			$pwd = htmlentities($_POST['pwd']);
			$email = htmlentities($_POST['email']);
			$role_id = $_POST['role_id'];
			
			$user = (new AuthServices())->register($username, $pwd, $email, $role_id);

			if ($user) {
				Flash::success("L'inscription a été ajouté avec succès.");

			}
		}
		
	}

	public function vendor()
	{
		
	}
	
}
