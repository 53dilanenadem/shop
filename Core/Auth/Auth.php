<?php
declare(strict_types=1);

namespace Core\Auth;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use Core\Configure;
use Core\Auth\AuthSession;

/**
 * Auth Class
 */
class Auth
{
	public static function setUser($user): bool
	{
		$auth = new AuthSession();

		$auth->setConnected(true);

		$auth->setAuthUser($user);

		$auth->setExpirationDate(time() + $auth->getSessionLifeTime());

		$auth->setConnectedAt(time());

		$_SESSION['__auth__'] = serialize($auth);

        return true;
	}

	public static function setShops($shops): bool
	{


		$_SESSION['__shops__'] = serialize($shops);


		return  true;
	}

	public static function unsetUser(): void
	{
		$_SESSION['__auth__'] = null;
	}

	public static function checkExpiration(): void
	{
		if (isset($_SESSION['__auth__']) && !empty($_SESSION['__auth__'])) {
			$auth = unserialize($_SESSION['__auth__'], ['allowed_classes' => true]);

			if ($auth->getExpirationDate() < time()) {
				self::unsetUser();
			}
		}
	}

    /**
     * @return bool
     */
    public static function isConnected(): bool
    {
    	self::checkExpiration();

    	if (!isset($_SESSION['__auth__']) || empty($_SESSION['__auth__'])) {
    		return false;
    	}

    	$auth = unserialize($_SESSION['__auth__'], ['allowed_classes' => true]);

        return $auth->getConnected();
    }

    /**
     * @return mixed
     */
    public static function getAuthUser()
    {
        if (isset($_SESSION['__auth__']) && !empty($_SESSION['__auth__'])) {
            $auth = unserialize($_SESSION['__auth__'], ['allowed_classes' => true]);

            return $auth->getAuthUser();
        }

        return null;
    }

	public static function  getAuthShops()
	{
		if (isset($_SESSION['__shops__']) && !empty($_SESSION['__shops__'])) {
			$shops = unserialize($_SESSION['__shops__'], ['allowed_classes' => true]);

			return $shops->getAuthShops();
		}

		return null;
	}
}


