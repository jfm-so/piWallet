<?php if (!defined("IN_WALLET")) { die("Auth Error!"); } ?>
<?php
//To enable developer mode (no need for an RPC server, replace this file with the snipet at https://gist.github.com/d3e148deb5969c0e4b60 

class Client {
	private $uri;
	private $jsonrpc;

	function __construct($host, $port, $user, $pass)
	{
		$this->uri = "http://" . $user . ":" . $pass . "@" . $host . ":" . $port . "/";
		$this->jsonrpc = new jsonRPCClient($this->uri);
	}

	function getBalance($user_session)
	{
		return $this->jsonrpc->getbalance("zelles(" . $user_session . ")", 6);
		//return 21;
	}

        function getAddress($user_session)
        {
                return $this->jsonrpc->getaccountaddress("zelles(" . $user_session . ")");
	}

	function getAddressList($user_session)
	{
		return $this->jsonrpc->getaddressesbyaccount("zelles(" . $user_session . ")");
		//return array("1test", "1test");
	}

	function getTransactionList($user_session)
	{
		return $this->jsonrpc->listtransactions("zelles(" . $user_session . ")", 10);
		// 10 can be changed to 1000 if you would like to display ALL (1000) of the users last transaction
		// return $this->jsonrpc->listtransactions("zelles(" . $user_session . ")", 1000);
	}
				
	function getLastTransaction($user_session)
	{
		return $this->jsonrpc->listtransactions("zelles(" . $user_session . ")", 1);
		// this is used to display the transaction that was just made by user_session after a withdraw success
	}

	function getNewAddress($user_session)
	{
		return $this->jsonrpc->getnewaddress("zelles(" . $user_session . ")");
		//return "1test";
	}

	function withdraw($user_session, $address, $amount)
	{
		return $this->jsonrpc->sendfrom("zelles(" . $user_session . ")", $address, (float)$amount, 6);
		//return "ok wow";
	}
	
	function importPrivKey($importedkey,$user_session)
	{
		return $this->jsonrpc->importprivkey($importedkey, "zelles(" . $user_session . ")");
		//we can use this to import the users privkey into their wallet
	}
}
?>
