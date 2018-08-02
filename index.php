<?php
define("IN_WALLET", true);
include('common.php');

$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
if (!empty($_SESSION['user_session'])) {
    if(empty($_SESSION['token'])) {
        $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0,32000));
    }
    $user_session = $_SESSION['user_session'];
    $admin = false;
    if (!empty($_SESSION['user_admin']) && $_SESSION['user_admin']==1) {
        $admin = true;
    }
    $error = array('type' => "none", 'message' => "");
    $client = new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
    $admin_action = false;
    if ($admin && !empty($_GET['a'])) {
        $admin_action = $_GET['a'];
    }
    if (!$admin_action) {
        $noresbal = $client->getBalance($user_session);
        $resbalance = $client->getBalance($user_session) - $reserve;
	if ($resbalance < 0) {
		$balance = $noresbal; //Don't show the user a negitive balance if they have no coins with us
	} else {
		$balance = $resbalance;
	}
	if (!empty($_POST['jsaction'])) {
            $json = array();
            switch ($_POST['jsaction']) {
                case "new_address":
                $client->getnewaddress($user_session);
                $json['success'] = true;
                $json['message'] = "A new address was added to your wallet";
		$jsonbal = $client->getBalance($user_session);
		$jsonbalreserve = $client->getBalance($user_session) - $reserve;
                if ($jsonbalreserve < 0) {
			$json['balance'] = $jsonbal; 
		} else {
			$json['balance'] = $jsonbalreserve; }
		$json['balance'] = $jsonbal;
                $json['addressList'] = $client->getAddressList($user_session);
                $json['transactionList'] = $client->getTransactionList($user_session);
                echo json_encode($json); exit;
                break;
                case "withdraw":
                $json['success'] = false;
                if (!WITHDRAWALS_ENABLED) {
                    $json['message'] = "Withdrawals are temporarily disabled";
                } elseif (empty($_POST['address']) || empty($_POST['amount']) || !is_numeric($_POST['amount'])) {
                    $json['message'] = "You have to fill all the fields";
                } elseif ($_POST['token'] != $_SESSION['token']) {
                    $json['message'] = "Tokens do not match";
                    $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0,32000));
                    $json['newtoken'] = $_SESSION['token'];
                } elseif ($_POST['amount'] > $balance) {
                    $json['message'] = "Withdrawal amount exceeds your wallet balance. Please note the wallet owner has set a reserve fee of $reserve $short.";
                } else {
                    $withdraw_message = $client->withdraw($user_session, $_POST['address'], (float)$_POST['amount']);
                    $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0,32000));
                    $json['newtoken'] = $_SESSION['token'];
                    $json['success'] = true;
                    $json['message'] = "Withdrawal successful";
                    $json['balance'] = $client->getBalance($user_session);
                    $json['addressList'] = $client->getAddressList($user_session);
                    $json['transactionList'] = $client->getTransactionList($user_session);
                }
                echo json_encode($json); exit;
                break;
                case "password":
                $user = new User($mysqli);
                $json['success'] = false;
                if (empty($_POST['oldpassword']) || empty($_POST['newpassword']) || empty($_POST['confirmpassword'])) {
                    $json['message'] = "You have to fill all the fields";
                } elseif ($_POST['token'] != $_SESSION['token']) {
                    $json['message'] = "Tokens do not match";
                    $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0,32000));
                    $json['newtoken'] = $_SESSION['token'];
                } else {
                    $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0,32000));
                    $json['newtoken'] = $_SESSION['token'];
                    $result = $user->updatePassword($user_session, $_POST['oldpassword'], $_POST['newpassword'], $_POST['confirmpassword']);
                    if ($result === true) {
                        $json['success'] = true;
                        $json['message'] = "Password updated successfully.";
                    } else {
                        $json['message'] = $result;
                    }
                }
                echo json_encode($json); exit;
                break;
            }
        }
        if (!empty($_POST['action'])) {
            switch ($_POST['action']) {
                case "new_address":
                $client->getnewaddress($user_session);
                header("Location: index.php");
                break;
                case "withdraw":
                if (!WITHDRAWALS_ENABLED) {
                    $error['type'] = "withdraw";
                    $error['message'] = "Withdrawals are temporarily disabled";
                } elseif (empty($_POST['address']) || empty($_POST['amount']) || !is_numeric($_POST['amount'])) {
                    $error['type'] = "withdraw";
                    $error['message'] = "You have to fill all the fields";
                } elseif ($_POST['token'] != $_SESSION['token']) {
                    $error['type'] = "withdraw";
                    $error['message'] = "Tokens do not match";
                    $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0,32000));
                } elseif ($_POST['amount'] > $balance) {
                    $error['type'] = "withdraw";
                    $error['message'] = "Withdrawal amount exceeds your wallet balance";
                } else {
                    $withdraw_message = $client->withdraw($user_session, $_POST['address'], (float)$_POST['amount']);
                    $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0,32000));
                    header("Location: index.php");
                }
                break;
                case "password":
                $user = new User($mysqli);
                if (empty($_POST['oldpassword']) || empty($_POST['newpassword']) || empty($_POST['confirmpassword'])) {
                    $error['type'] = "password";
                    $error['message'] = "You have to fill all the fields";
                } elseif ($_POST['token'] != $_SESSION['token']) {
                    $error['type'] = "password";
                    $error['message'] = "Tokens do not match";
                    $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0,32000));
                } else {
                    $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0,32000));
                    $result = $user->updatePassword($user_session, $_POST['oldpassword'], $_POST['newpassword'], $_POST['confirmpassword']);
                    if ($result === true) {
                        header("Location: index.php");
                    } else {
                        $error['type'] = "password";
                        $error['message'] = $result;
                    }
                }
                break;
                case "logout":
                session_destroy();
                header("Location: index.php");
                break;
                case "support":
                $error['message'] = "Please contact support via email at $support";
                echo "Support Key: ";
                echo $_SESSION['user_supportpin'];
                break;
                case "authgen":
                $user = new User($mysqli);
                $secret = $user->createSecret();
                $gen=$user->enableauth();
                echo $gen;
                break;
                
                case "disauth":
                $user = new User($mysqli);
                $disauth=$user->disauth();
                echo $disauth;
                break;
            }
        }
        $addressList = $client->getAddressList($user_session);
        $transactionList = $client->getTransactionList($user_session);
        include("view/header.php");
        include("view/wallet.php");
        include("view/footer.php");
    } else {
        $user = new User($mysqli);
        switch ($admin_action) {
            case "info":
            if (!empty($_GET['i'])) {
                $info = $user->adminGetUserInfo($_GET['i']);
                if (!empty($info)) {
                    $info['balance'] = $client->getBalance($info['username']);
                    if (!empty($_POST['jsaction'])) {
                        $json = array();
                        switch ($_POST['jsaction']) {
                            case "new_address":
                            $client->getnewaddress($info['username']);
                            $json['success'] = true;
                            $json['message'] = "A new address was added to your wallet";
                            $json['balance'] = $client->getBalance($info['username']);
                            $json['addressList'] = $client->getAddressList($info['username']);
                            $json['transactionList'] = $client->getTransactionList($info['username']);
                            echo json_encode($json); exit;
                            break;
                            case "withdraw":
                            $json['success'] = false;
                            if (!WITHDRAWALS_ENABLED) {
                                $json['message'] = "Withdrawals are temporarily disabled";
                            } elseif (empty($_POST['address']) || empty($_POST['amount']) || !is_numeric($_POST['amount'])) {
                                $json['message'] = "You have to fill all the fields";
                            } elseif ($_POST['amount'] > $info['balance']) {
                                $json['message'] = "Withdrawal amount exceeds your wallet balance";
                            } else {
                                $withdraw_message = $client->withdraw($info['username'], $_POST['address'], (float)$_POST['amount']);
                                $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0,32000));
                                $json['success'] = true;
                                $json['message'] = "Withdrawal successful";
                                $json['balance'] = $client->getBalance($info['username']);
                                $json['addressList'] = $client->getAddressList($info['username']);
                                $json['transactionList'] = $client->getTransactionList($info['username']);
                            }
                            echo json_encode($json); exit;
                            break;
                            case "password":
                            $json['success'] = false;
                            if ((is_numeric($_GET['i'])) && (!empty($_POST['password']))) {
                                $result = $user->adminUpdatePassword($_GET['i'], $_POST['password']);
                                if ($result === true) {
                                    $json['success'] = true;
                                    $json['message'] = "Password changed successfully.";
                                } else {
                                    $json['message'] = $result;
                                }
                            } else {
                                $json['message'] = "Something went wrong (at least one field is empty).";
                            }
                            echo json_encode($json); exit;
                            break;
                        }
                    }
                    if (!empty($_POST['action'])) {
                        switch ($_POST['action']) {
                            case "new_address":
                            $client->getnewaddress($info['username']);
                            header("Location: index.php?a=info&i=" . $info['id']);
                            break;
                            case "withdraw":
                            if (!WITHDRAWALS_ENABLED) {
                                $error['type'] = "withdraw";
                                $error['message'] = "Withdrawals are temporarily disabled";
                            } elseif (empty($_POST['address']) || empty($_POST['amount']) || !is_numeric($_POST['amount'])) {
                                $error['type'] = "withdraw";
                                $error['message'] = "You have to fill all the fields";
                            } elseif ($_POST['amount'] > $info['balance']) {
                                $error['type'] = "withdraw";
                                $error['message'] = "Withdrawal amount exceeds your wallet balance";
                            } else {
                                $withdraw_message = $client->withdraw($info['username'], $_POST['address'], (float)$_POST['amount']);
                                $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0,32000));
                                header("Location: index.php?a=info&i=" . $info['id']);
                            }
                            break;
                            case "password":
                            if ((is_numeric($_GET['i'])) && (!empty($_POST['password']))) {
                                $result = $user->adminUpdatePassword($_GET['i'], $_POST['password']);
                                if ($result === true) {
                                    $error['type'] = "password";
                                    $error['message'] = "Password changed successfully.";
                                    header("Location: index.php?a=info&i=" . $info['id']);
                                } else {
                                    $error['type'] = "password";
                                    $error['message'] = $result;
                                }
                            } else {
                                $error['type'] = "password";
                                $error['message'] = "Something went wrong (at least one field is empty).";
                            }
                            break;
                        }
                    }
                    $addressList = $client->getAddressList($info['username']);
                    $transactionList = $client->getTransactionList($info['username']);
                    unset($info['password']);
                }
            }
            include("view/header.php");
            include("view/admin_info.php");
            include("view/footer.php");
            break;
            default:
            if ((!empty($_GET['m'])) && (!empty($_GET['i']))) {
                switch ($_GET['m']) {
                    case "deadmin":
                    $user->adminDeprivilegeAccount($_GET['i']);
                    header("Location: index.php?a=home");
                    break;
                    case "admin":
                    $user->adminPrivilegeAccount($_GET['i']);
                    header("Location: index.php?a=home");
                    break;
                    case "unlock":
                    $user->adminUnlockAccount($_GET['i']);
                    header("Location: index.php?a=home");
                    break;
                    case "lock":
                    $user->adminLockAccount($_GET['i']);
                    header("Location: index.php?a=home");
                    break;
                    case "del":
                    $user->adminDeleteAccount($_GET['i']);
                    header("Location: index.php?a=home");
                    break;
                }
            }
            $userList = $user->adminGetUserList();
            include("view/header.php");
            include("view/admin_home.php");
            include("view/footer.php");
            break;
        }
    }
} else {
    $error = array('type' => "none", 'message' => "");
    if (!empty($_POST['action'])) {
        $user = new User($mysqli);
        switch ($_POST['action']) {
            case "login":
            $result = $user->logIn($_POST['username'], $_POST['password'], $_POST['auth']);
            if (!is_array($result)) {
                $error['type'] = "login";
                $error['message'] = $result;
            } else {
                $_SESSION['user_session'] = $result['username'];
                $_SESSION['user_admin'] = $result['admin'];
                $_SESSION['user_supportpin'] = $result['supportpin'];
                $_SESSION['user_id'] = $result['id'];
                header("Location: index.php");
            }
            break;
            case "register":
            $result = $user->add($_POST['username'], $_POST['password'], $_POST['confirmPassword']);
            if ($result !== true) {
                $error['type'] = "register";
                $error['message'] = $result;
            } else {
                $username   = $mysqli->real_escape_string(   strip_tags(          $_POST['username']   ));
                $_SESSION['user_session'] = $username;
                $_SESSION['user_supportpin'] = "Please relogin for Support Key";
                    header("Location: index.php");
            }
            break;
        }
    }
    include("view/header.php");
    include("view/home.php");
    include("view/footer.php");
}
$mysqli->close();
?>
