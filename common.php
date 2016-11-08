<?php
session_start();
header('Cache-control: private'); // IE 6 FIX

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

$server_url = "/";  // website url

$db_host = "localhost";
$db_user = "root";
$db_pass = "password";
$db_name = "wallet";

$rpc_host = "127.0.0.1";
$rpc_port = "8332";
$rpc_user = "bitcoinrpc";
$rpc_pass = "Cp68nBkCAADKkskaKSskaDKdmSYLtLJ";

$fullname = "Bitcoin"; //Website Title (Do Not include 'wallet')
$short = "BTC"; //Coin Short (BTC)
$blockchain_url = "http://blockchain.info/tx/"; //Blockchain Url
$support = "support@yourwebsite.com"; //Your support eMail
$hide_ids = array(1); //Hide account from admin dashboard
$donation_address = "13jy6rHB7HMgQBoYxQQXSM7TFTZZ6CDAAZ"; //Donation Address

$fee = "0"; //Set a fee to prevent negitive balances. WARNING: This function is incomplete. Setting a fee will show a negitve balance for all new user accounts.

if(isSet($_GET['lang']))
{
$lang = $_GET['lang'];

// register the session and set the cookie
$_SESSION['lang'] = $lang;

setcookie('lang', $lang, time() + (3600 * 24 * 30));
}
else if(isSet($_SESSION['lang']))
{
$lang = $_SESSION['lang'];
}
else if(isSet($_COOKIE['lang']))
{
$lang = $_COOKIE['lang'];
}
else
{
$lang = 'en';
}

switch ($lang) {
  case 'en':
  $lang_file = 'lang.en.php';
  break;

  case 'grc':
  $lang_file = 'lang.grc.php';
  break;

  case 'zho':
  $lang_file = 'lang.zho.php';
  break;

  case 'ita':
  $lang_file = 'lang.ita.php';
  break;

  case 'por':
  $lang_file = 'lang.por.php';
  break;

  case 'hin':
  $lang_file = 'lang.hin.php';
  break;

  case 'spa':
  $lang_file = 'lang.spa.php';
  break;

  case 'tgl':
  $lang_file = 'lang.tgl.php';
  break;

  case 'rus':
  $lang_file = 'lang.rus.php';
  break;

  case 'nld':
  $lang_file = 'lang.nld.php';
  break;

  case 'fra':
  $lang_file = 'lang.fra.php';
  break;

  case 'deu':
  $lang_file = 'lang.deu.php';
  break;

  case 'tur':
  $lang_file = 'lang.tur.php';
  break;

  case 'vie':
  $lang_file = 'lang.vie.php';
  break;

  case 'jpn':
  $lang_file = 'lang.jpn.php';
  break;

  case 'kor':
  $lang_file = 'lang.kor.php';
  break;

  case 'ara':
  $lang_file = 'lang.ara.php';
  break;

  default:
  $lang_file = 'lang.en.php';

}

include_once 'languages/'.$lang_file;

?>
