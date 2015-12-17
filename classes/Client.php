<?php if (!defined("IN_WALLET")) { die("Auth Error!"); } ?>
<?php
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
}
?>
