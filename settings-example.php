<?php

$server_url = "/";  // ENTER WEBSITE URL ALONG WITH A TRAILING SLASH

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
$blockchain_tx_url = "http://blockchain.info/tx/"; //Blockchain Url
$support = "support@yourwebsite.com"; //Your support eMail
$hide_ids = array(1); //Hide account from admin dashboard
$donation_address = ""; //Donation Address

$reserve = "0"; //This fee acts as a reserve. The users balance will display as the balance in the daemon minus the reserve. We don't reccomend setting this more than the Fee the daemon charges.

?>
