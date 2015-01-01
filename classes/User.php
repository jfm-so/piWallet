<?php if (!defined("IN_WALLET")) { die("u can't touch this."); } ?>
<?php
class User {
	private $mysqli;

	function __construct($mysqli)
	{
		$this->mysqli = $mysqli;
	}

	function logIn($username, $password)
	{
		if (empty($username) || empty($password))
		{
			return false;
		} else {
			$username	= $this->mysqli->real_escape_string(	strip_tags(							$username	));
        	$password	= md5(									addslashes(				strip_tags(	$password	)));
        	$result		= $this->mysqli->query("SELECT * FROM users WHERE username='" . 			$username . "'");

        	$user = $result->fetch_assoc();
        	if (($user) && ($user['password'] == $password) && ($user['locked'] == 0))
        	{
        		return $user;
        	} elseif (($user) && ($user['locked'] == 1)) {
        		return "Account is locked. Contact support for more information.";
        	} else {
        		return "Username or password is incorrect";
        	}
		}
	}

	function add($username, $password, $confirmPassword)
	{
		if (empty($username) || empty($password) || empty($confirmPassword))
		{
			return "Please, fill all the fields";
		} elseif ($password != $confirmPassword)
		{
			return "Passwords did not match";
		} elseif ((strlen($username) < 3) || (strlen($username) > 30))
		{
			return "Username must be between 3 and 30 characters";
		} elseif (strlen($password) < 3)
		{
			return "Password must be longer than 3 characters";
		} else {
			//Let's do a database check
			$username	= $this->mysqli->real_escape_string(	strip_tags(				$username	));
        	$password	= md5(									addslashes(	strip_tags(	$password	)));
			$user = $this->mysqli->query("SELECT * FROM users WHERE username='" . $username . "'");
			if ($user->num_rows > 0)
			{
				return "Username already taken";
			} else {
				$query = $this->mysqli->query("INSERT INTO users (`date`, `ip`, `username`, `password`) VALUES (\"" . date("n/j/Y g:i a") . "\", \"". $_SERVER['REMOTE_ADDR'] . "\", \"" . $username ."\", \"" . $password . "\");");
				if ($query)
				{
					return true;
				} else {
					return "System error";
				}
			}
		}
	}

	function updatePassword($user_session, $oldPassword, $newPassword, $confirmPassword)
	{
		global $hide_ids;
		if ($newPassword != $confirmPassword)
		{
			return "Passwords did not match.";
		} else {
			//Get old password
			$result = $this->mysqli->query("SELECT * FROM users WHERE username='" . $user_session . "'");
			if ($result->num_rows > 0)
			{
				$user = $result->fetch_assoc();
				$oldPassword = md5(addslashes(strip_tags(		$oldPassword		)));
				$newPassword = md5(addslashes(strip_tags(		$newPassword		)));
				if ($user['password'] != $oldPassword)
				{
					return "Password is incorrect.";
				} else {
					$result = $this->mysqli->query("UPDATE users SET password='" . $newPassword . "' WHERE id=" . $user['id']);
					if ($result)
					{
						return true;
					} else {
						return "Some sort of error occured.";
					}
				}
			} else {
				return "Some sort of error occured.";
			}
		}
	}

	function adminGetUserList()
	{
		global $hide_ids;
		$users = $this->mysqli->query("SELECT * FROM users");
		$return = array();
		while ($user = $users->fetch_assoc())
		{
			if (!in_array($user['id'], $hide_ids))
			{
				$return[] = $user;
			}
		}
		return $return;
	}

	function adminGetUserInfo($id)
	{
		global $hide_ids;
		if (is_numeric($id) && !in_array($id, $hide_ids))
		{
			$users = $this->mysqli->query("SELECT * FROM users WHERE id=" . $id);
			if ($users->num_rows > 0)
			{
				return $users->fetch_assoc();
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function adminUpdatePassword($id, $newPassword)
	{
		global $hide_ids;
        $password	= md5(									addslashes(	strip_tags(	$newPassword	)));
		if (is_numeric($id) && !in_array($id, $hide_ids))
		{
			$result = $this->mysqli->query("UPDATE users SET password='" . $password . "' WHERE id=" . $id . ";");
			if ($result)
			{
				return true;
			} else {
				return "Error.";
			}
		} else {
			return "User does not exist";
		}
	}

	function adminDeleteAccount($id)
	{
		global $hide_ids;
		if (is_numeric($id) && !in_array($id, $hide_ids))
		{
			$this->mysqli->query("DELETE FROM users WHERE id=" . $id);
		}
	}

	function adminLockAccount($id)
	{
		global $hide_ids;
		if (is_numeric($id) && !in_array($id, $hide_ids))
		{
			$users = $this->mysqli->query("UPDATE users SET locked=1 WHERE id=" . $id);
		}
	}

	function adminUnlockAccount($id)
	{
		global $hide_ids;
		if (is_numeric($id) && !in_array($id, $hide_ids))
		{
			$users = $this->mysqli->query("UPDATE users SET locked=0 WHERE id=" . $id);
		}
	}

	function adminPrivilegeAccount($id)
	{
		global $hide_ids;
		if (is_numeric($id) && !in_array($id, $hide_ids))
		{
			$users = $this->mysqli->query("UPDATE users SET admin=1 WHERE id=" . $id);
		}
	}

	function adminDeprivilegeAccount($id)
	{
		global $hide_ids;
		if (is_numeric($id) && !in_array($id, $hide_ids))
		{
			$users = $this->mysqli->query("UPDATE users SET admin=0 WHERE id=" . $id);
		}
	}

}
?>