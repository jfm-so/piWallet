<?php if (!defined("IN_WALLET")) { die("Auth Error!"); } ?>

<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 'On');
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
		} 
		else {
			$auth=$_POST['auth'];
			$username = $this->mysqli->real_escape_string(strip_tags($username));
      		  	$password = md5(addslashes(strip_tags($password	))); 
			$auth = $this->mysqli->real_escape_string(	strip_tags(	$auth));
        		$result	= $this->mysqli->query("SELECT * FROM users WHERE username='" . $username . "'");
                 	$user = $result->fetch_assoc();
                        $secret = $user['secret'];
                        $oneCode = $this->getCode($secret);

        	if (($user) && ($user['password'] == $password) && ($user['locked'] == 0) && ($user['authused'] == 0))
        	{
        		return $user;
        	} 
		elseif (($user) && ($user['password'] == $password) && ($user['locked'] == 1)) {
			$pin = $user['supportpin'];
        		return "Account is locked. Contact support for more information. $pin";
}

 		elseif (($user) && ($user['password'] == $password) && ($user['locked'] == 0) && ($user['authused'] == 1 && ($oneCode == $_POST['auth'])))  {
			return $user;

        	} else {

        		return "Username, password or 2 factor is incorrect";

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

			$username = $this->mysqli->real_escape_string(strip_tags($username));

        	$password = md5(addslashes(strip_tags($password)));

			$user = $this->mysqli->query("SELECT * FROM users WHERE username='" . $username . "'");

			if ($user->num_rows > 0)

			{

				return "Username already taken";

			} else {

				$query = $this->mysqli->query("INSERT INTO users (`date`, `ip`, `username`, `password`, `supportpin`) VALUES (\"" . date("n/j/Y g:i a") . "\", \"". $_SERVER['REMOTE_ADDR'] . "\", \"" . $username ."\", \"" . $password . "\", \"". rand(10000,99999) . "\");");				

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
				$oldPassword = md5(addslashes(strip_tags($oldPassword)));
				$newPassword = md5(addslashes(strip_tags($newPassword)));
				if ($user['password'] != $oldPassword)

				{

					return "Password is incorrect.";

				} else {

					$result = $this->mysqli->query("UPDATE users SET password='" . $newPassword . "', supportpin='" . rand(10000,99999) . "' WHERE id=" . $user['id']);

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
        	$password = md5(addslashes(strip_tags($newPassword)));
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

	function enableauth()

	{
		
		                

	//	global $hide_ids;
                include 'settings.php';
                $id=$_SESSION['user_id'];
                $secret=$this->createSecret();
                $qrcode=$this->getQRCodeGoogleUrl(urlencode(''.$fullname.' Wallet'), $secret);
                $oneCode = $this->getCode($secret);

		if (($id)) 
		{  
			$msg = "Secret Key: $secret *Please write this down and keep in a secure area*<br><img src='$qrcode'<br>Please scan this with the Google Authenticator app on your mobile phone. This page will clear on refresh, please be careful.";
			$this->mysqli->query("UPDATE users SET authused=1, secret='" . $secret . "' WHERE id=" . $id); return "$msg";
		}
	}

      function disauth()
              {
     		 $id=$_SESSION['user_id'];
    		  if (($id))
     		 {
			$msg = "Two Factor Auth has been disabled for your account and will no longer be required when you sign in.";
			$this->mysqli->query("UPDATE users SET authused=0, secret='' WHERE id=" . $id); return "$msg";
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

//GoogleAuthenticator 
//Created by PHPGangsta

protected $_codeLength = 6;
    /**
     * Create new secret.
     * 16 characters, randomly chosen from the allowed base32 characters.
     *
     * @param int $secretLength
     * @return string
     */
    public function createSecret($secretLength = 16)
    {
        $validChars = $this->_getBase32LookupTable();
        unset($validChars[32]);
        $secret = '';
        for ($i = 0; $i < $secretLength; $i++) {
            $secret .= $validChars[array_rand($validChars)];
        }
        return $secret;
    }
    /**
     * Calculate the code, with given secret and point in time
     *
     * @param string $secret
     * @param int|null $timeSlice
     * @return string
     */
    public function getCode($secret, $timeSlice = null)
    {
        if ($timeSlice === null) {
            $timeSlice = floor(time() / 30);
        }
        $secretkey = $this->_base32Decode($secret);
        // Pack time into binary string
        $time = chr(0).chr(0).chr(0).chr(0).pack('N*', $timeSlice);
        // Hash it with users secret key
        $hm = hash_hmac('SHA1', $time, $secretkey, true);
        // Use last nipple of result as index/offset
        $offset = ord(substr($hm, -1)) & 0x0F;
        // grab 4 bytes of the result
        $hashpart = substr($hm, $offset, 4);
        // Unpak binary value
        $value = unpack('N', $hashpart);
        $value = $value[1];
        // Only 32 bits
        $value = $value & 0x7FFFFFFF;
        $modulo = pow(10, $this->_codeLength);
        return str_pad($value % $modulo, $this->_codeLength, '0', STR_PAD_LEFT);
    }
    /**
     * Get QR-Code URL for image, from google charts
     *
     * @param string $name
     * @param string $secret
     * @param string $title
     * @return string
     */
    public function getQRCodeGoogleUrl($name, $secret, $title = null) {
        $urlencoded = urlencode('otpauth://totp/'.$name.'?secret='.$secret.'');
	if(isset($title)) {
                $urlencoded .= urlencode('&issuer='.urlencode($title));
        }
        return 'https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl='.$urlencoded.'';
    }
    /**
     * Check if the code is correct. This will accept codes starting from $discrepancy*30sec ago to $discrepancy*30sec from now
     *
     * @param string $secret
     * @param string $code
     * @param int $discrepancy This is the allowed time drift in 30 second units (8 means 4 minutes before or after)
     * @param int|null $currentTimeSlice time slice if we want use other that time()
     * @return bool
     */
    public function verifyCode($secret, $code, $discrepancy = 1, $currentTimeSlice = null)
    {
        if ($currentTimeSlice === null) {
            $currentTimeSlice = floor(time() / 30);
        }
        for ($i = -$discrepancy; $i <= $discrepancy; $i++) {
            $calculatedCode = $this->getCode($secret, $currentTimeSlice + $i);
            if ($calculatedCode == $code ) {
                return true;
            }
        }
        return false;
    }
    /**
     * Set the code length, should be >=6
     *
     * @param int $length
     * @return PHPGangsta_GoogleAuthenticator
     */
    public function setCodeLength($length)
    {
        $this->_codeLength = $length;
        return $this;
    }
    /**
     * Helper class to decode base32
     *
     * @param $secret
     * @return bool|string
     */
    protected function _base32Decode($secret)
    {
        if (empty($secret)) return '';
        $base32chars = $this->_getBase32LookupTable();
        $base32charsFlipped = array_flip($base32chars);
        $paddingCharCount = substr_count($secret, $base32chars[32]);
        $allowedValues = array(6, 4, 3, 1, 0);
        if (!in_array($paddingCharCount, $allowedValues)) return false;
        for ($i = 0; $i < 4; $i++){
            if ($paddingCharCount == $allowedValues[$i] &&
                substr($secret, -($allowedValues[$i])) != str_repeat($base32chars[32], $allowedValues[$i])) return false;
        }
        $secret = str_replace('=','', $secret);
        $secret = str_split($secret);
        $binaryString = "";
        for ($i = 0; $i < count($secret); $i = $i+8) {
            $x = "";
            if (!in_array($secret[$i], $base32chars)) return false;
            for ($j = 0; $j < 8; $j++) {
                $x .= str_pad(base_convert(@$base32charsFlipped[@$secret[$i + $j]], 10, 2), 5, '0', STR_PAD_LEFT);
            }
            $eightBits = str_split($x, 8);
            for ($z = 0; $z < count($eightBits); $z++) {
                $binaryString .= ( ($y = chr(base_convert($eightBits[$z], 2, 10))) || ord($y) == 48 ) ? $y:"";
            }
        }
        return $binaryString;
    }
    /**
     * Helper class to encode base32
     *
     * @param string $secret
     * @param bool $padding
     * @return string
     */
    protected function _base32Encode($secret, $padding = true)
    {
        if (empty($secret)) return '';
        $base32chars = $this->_getBase32LookupTable();
        $secret = str_split($secret);
        $binaryString = "";
        for ($i = 0; $i < count($secret); $i++) {
            $binaryString .= str_pad(base_convert(ord($secret[$i]), 10, 2), 8, '0', STR_PAD_LEFT);
        }
        $fiveBitBinaryArray = str_split($binaryString, 5);
        $base32 = "";
        $i = 0;
        while ($i < count($fiveBitBinaryArray)) {
            $base32 .= $base32chars[base_convert(str_pad($fiveBitBinaryArray[$i], 5, '0'), 2, 10)];
            $i++;
        }
        if ($padding && ($x = strlen($binaryString) % 40) != 0) {
            if ($x == 8) $base32 .= str_repeat($base32chars[32], 6);
            elseif ($x == 16) $base32 .= str_repeat($base32chars[32], 4);
            elseif ($x == 24) $base32 .= str_repeat($base32chars[32], 3);
            elseif ($x == 32) $base32 .= $base32chars[32];
        }
        return $base32;
    }
    /**
     * Get array with all 32 characters for decoding from/encoding to base32
     *
     * @return array
     */
    protected function _getBase32LookupTable()
    {
        return array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', //  7
            'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', // 15
            'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', // 23
            'Y', 'Z', '2', '3', '4', '5', '6', '7', // 31
            '='  // padding char
        );
    }
}

?>
