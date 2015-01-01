<?php
session_start();

define("WITHDRAWALS_ENABLED", true); //Disable withdrawals during maintenance

include('jsonRPCClient.php');
include('classes/Client.php');
include('classes/User.php');

// function by zelles to modify the number to bitcoin format ex. 0.00120000
function satoshitize($satoshitize) {
   return sprintf("%.8f", $satoshitize);
}

// function by zelles to trim trailing zeroes and decimal if need
function satoshitrim($satoshitrim) {
   return rtrim(rtrim($satoshitrim, "0"), ".");
}

$server_url = "https://dogecoinewallet.com";  // website url

$db_host = "localhost";
$db_user = "root";
$db_pass = "password";
$db_name = "wallet";

$rpc_host = "localhost";
$rpc_port = "22555";
$rpc_user = "dogecoinrpc";
$rpc_pass = "Cp68nBkCAADKkskaKSskaDKdmSYLtLJ";

$fullname = "Dogecoin"; //Coin Name (Dogecoin)
$short = "DOGE"; //Coin Short (DOGE)
$blockchain_url = "http://dogechain.info/tx/"; //Blockchain Url

$hide_ids = array(6); //Hide account from admin dashboard
$donation_address = "DMnvFcv8QFcCHYJkaaJJQxLx1onPRKvhAB"; //Donation Address
?>
