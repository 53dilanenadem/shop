<?php
declare(strict_types=1);

namespace Core\Auth;

/**
 * Password Hasher Class
 */
class PwdHasher
{
	/**
	 * Hash password
	 * 
	 * @param string $password Password to hash
	 * @return string Hashed password
	 */
	public function hash($pwd): string
	{
		return hash('sha256', '$@LVM' . $pwd . '@#');
	}

	/**
	 * Check if password string matches hashed password
	 *
	 * @param string $password Password string
	 * @param string $hashedPassword Hashed password
	 * @return bool Returns true if password string matches hashed password, false otherwise.
	 */
	public function check($pwd, $hashedPwd): bool
	{
		return $this->hash($pwd) === $hashedPwd;
	}
}