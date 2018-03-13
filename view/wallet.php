<?php if (!defined("IN_WALLET")) { die("Auth Error!"); } ?>
<?php
if (!empty($error))
{
    echo "<p style='font-weight: bold; color: red;'>" . $error['message']; "</p>";
}
?>
<p><?php echo $lang['WALLET_HELLO']; ?>, <strong><?php echo $user_session; ?></strong>!  <?php if ($admin) {?><strong><font color="red">[Admin]</font><?php }?></strong></p>
<p><?php echo $lang['WALLET_BALANCE']; ?> <strong id="balance"><?php echo satoshitize($balance); ?></strong> <?=$short?></p>

<form action="index.php" method="POST">

<br />
<?php
if ($admin)
{
  ?>
<p><strong>Admin Links:</strong></p>
  <a href="?a=home" class="btn btn-default">Admin Dashboard</a>

<br />
<br />
<p><strong><?php echo $lang['WALLET_USERLINKS']; ?></strong></p>
  <?php
}
?>
<form>
        <input type="hidden" name="action" value="logout" />
        <button type="submit" class="btn btn-default"><?php echo $lang['WALLET_LOGOUT']; ?></button>
</form>
<form action="index.php" method="POST">
<input type="hidden" name="action" value="support" action="index.php"/>
<button type="submit" class="btn btn-default"><?php echo $lang['WALLET_SUPPORT']; ?></button>
</form>

<form action="index.php" method="POST">
<form>
<input type="hidden" name="action" value="authgen" />
<button type="submit" class="btn btn-default"><?php echo $lang['WALLET_2FAON']; ?></button>
</form><p>
<form action="index.php" method="post">
<form>
<input type="hidden" name="action" value="disauth" />
<button type="submit" class="btn btn-default"><?php echo $lang['WALLET_2FAOFF']; ?></button>
</form>

<br>

<br />

<br />
<p><strong><?php echo $lang['WALLET_PASSUPDATE']; ?></strong></p>
<form action="index.php" method="POST" class="clearfix" id="pwdform">
    <input type="hidden" name="action" value="password" />
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
    <div class="col-md-2"><input type="password" class="form-control" name="oldpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATEOLD']; ?>"></div>
    <div class="col-md-2"><input type="password" class="form-control" name="newpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATENEW']; ?>"></div>
    <div class="col-md-2"><input type="password" class="form-control" name="confirmpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATENEWCONF']; ?>"></div>
    <div class="col-md-2"><button type="submit" class="btn btn-default"><?php echo $lang['WALLET_PASSUPDATECONF']; ?></button></div>
</form>
<p id="pwdmsg"></p>
<br />
<p style="font-size:1em;"><?php echo $lang['WALLET_SUPPORTNOTE']; ?></p>
<br />
<p><strong><?php echo $lang['WALLET_SEND']; ?></strong></p>
<button type="button" class="btn btn-default" id="donate">Donate to <?=$fullname?> wallet's owner!</button><br />
<p id="donateinfo" style="display: none;">Type the amount you want to donate and click <strong>Withdraw</strong></p>
<form action="index.php" method="POST" class="clearfix" id="withdrawform">
    <input type="hidden" name="action" value="withdraw" />
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
    <div class="col-md-4"><input type="text" class="form-control" name="address" placeholder="<?php echo $lang['WALLET_ADDRESS']; ?>"></div>
    <div class="col-md-2"><input type="text" class="form-control" name="amount" placeholder="<?php echo $lang['WALLET_AMOUNT']; ?>"></div>
    <div class="col-md-2"><button type="submit" class="btn btn-default"><?php echo $lang['WALLET_SENDCONF']; ?></button></div>
</form>
<p id="withdrawmsg"></p>
<br />
<p><strong><?php echo $lang['WALLET_USERADDRESSES']; ?></strong></p>
<form action="index.php" method="POST" id="newaddressform">
	<input type="hidden" name="action" value="new_address" />
	<button type="submit" class="btn btn-default"><?php echo $lang['WALLET_NEWADDRESS']; ?></button>
</form>
<p id="newaddressmsg"></p>
<br />
<table class="table table-bordered table-striped" id="alist">
<thead>
<tr>
<td><?php echo $lang['WALLET_ADDRESS']; ?>:</td>
<td><?php echo $lang['WALLET_QRCODE']; ?>:</td>
</tr>
</thead>
<tbody>
<?php
foreach ($addressList as $address)
{
echo "<tr><td>".$address."</t>";?>
<td><a href="<?php echo $server_url;?>qrgen/?address=<?php echo $address;?>">
  <img src="<?php echo $server_url;?>qrgen/?address=<?php echo $address;?>" alt="QR Code" style="width:42px;height:42px;border:0;"></td><tr>
<?php
}
?>
</tbody>
</table>
<p><?php echo $lang['WALLET_LAST10']; ?></p>
<table class="table table-bordered table-striped" id="txlist">
<thead>
   <tr>
      <td nowrap><?php echo $lang['WALLET_DATE']; ?></td>
      <td nowrap><?php echo $lang['WALLET_ADDRESS']; ?></td>
      <td nowrap><?php echo $lang['WALLET_TYPE']; ?></td>
      <td nowrap><?php echo $lang['WALLET_AMOUNT']; ?></td>
      <td nowrap><?php echo $lang['WALLET_FEE']; ?></td>
      <td nowrap><?php echo $lang['WALLET_CONFS']; ?></td>
      <td nowrap><?php echo $lang['WALLET_INFO']; ?></td>
   </tr>
</thead>
<tbody>
   <?php
   $bold_txxs = "";
   foreach($transactionList as $transaction) {
      if($transaction['category']=="send") { $tx_type = '<b style="color: #FF0000;">Sent</b>'; } else { $tx_type = '<b style="color: #01DF01;">Received</b>'; }
      echo '<tr>
               <td>'.date('n/j/Y h:i a',$transaction['time']).'</td>
               <td>'.$transaction['address'].'</td>
               <td>'.$tx_type.'</td>
               <td>'.abs($transaction['amount']).'</td>
               <td>'.$transaction['fee'].'</td>
               <td>'.$transaction['confirmations'].'</td>
               <td><a href="' . $blockchain_tx_url,  $transaction['txid'] . '" target="_blank">Info</a></td>
            </tr>';
   }
   ?>
   </tbody>
</table>
<script type="text/javascript">
var blockchain_tx_url = "<?=$blockchain_tx_url?>";
$("#withdrawform input[name='action']").first().attr("name", "jsaction");
$("#newaddressform input[name='action']").first().attr("name", "jsaction");
$("#pwdform input[name='action']").first().attr("name", "jsaction");
$("#donate").click(function (e){
  $("#donateinfo").show();
  $("#withdrawform input[name='address']").val("<?=$donation_address?>");
  $("#withdrawform input[name='amount']").val("0.01");
});
$("#withdrawform").submit(function(e)
{
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data, textStatus, jqXHR) 
        {
            var json = $.parseJSON(data);
            if (json.success)
            {
              $("#withdrawform input.form-control").val("");
            	$("#withdrawmsg").text(json.message);
            	$("#withdrawmsg").css("color", "green");
            	$("#withdrawmsg").show();
            	updateTables(json);
            } else {
            	$("#withdrawmsg").text(json.message);
            	$("#withdrawmsg").css("color", "red");
            	$("#withdrawmsg").show();
            }
            if (json.newtoken)
            {
              $('input[name="token"]').val(json.newtoken);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //ugh, gtfo    
        }
    });
    e.preventDefault();
});
$("#newaddressform").submit(function(e)
{
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data, textStatus, jqXHR) 
        {
            var json = $.parseJSON(data);
            if (json.success)
            {
            	$("#newaddressmsg").text(json.message);
            	$("#newaddressmsg").css("color", "green");
            	$("#newaddressmsg").show();
            	updateTables(json);
            } else {
            	$("#newaddressmsg").text(json.message);
            	$("#newaddressmsg").css("color", "red");
            	$("#newaddressmsg").show();
            }
            if (json.newtoken)
            {
              $('input[name="token"]').val(json.newtoken);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //ugh, gtfo    
        }
    });
    e.preventDefault();
});
$("#pwdform").submit(function(e)
{
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data, textStatus, jqXHR) 
        {
            var json = $.parseJSON(data);
            if (json.success)
            {
               $("#pwdform input.form-control").val("");
               $("#pwdmsg").text(json.message);
               $("#pwdmsg").css("color", "green");
               $("#pwdmsg").show();
            } else {
               $("#pwdmsg").text(json.message);
               $("#pwdmsg").css("color", "red");
               $("#pwdmsg").show();
            }
            if (json.newtoken)
            {
              $('input[name="token"]').val(json.newtoken);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //ugh, gtfo    
        }
    });
    e.preventDefault();
});

function updateTables(json)
{
	$("#balance").text(json.balance.toFixed(8));
	$("#alist tbody tr").remove();
	for (var i = json.addressList.length - 1; i >= 0; i--) {
		$("#alist tbody").prepend("<tr><td>" + json.addressList[i] + "</td></tr>");
	}
	$("#txlist tbody tr").remove();
	for (var i = json.transactionList.length - 1; i >= 0; i--) {
		var tx_type = '<b style="color: #01DF01;">Received</b>';
		if(json.transactionList[i]['category']=="send")
		{
			tx_type = '<b style="color: #FF0000;">Sent</b>';
		}
		$("#txlist tbody").prepend('<tr> \
               <td>' + moment(json.transactionList[i]['time'], "X").format('l hh:mm a') + '</td> \
               <td>' + json.transactionList[i]['address'] + '</td> \
               <td>' + tx_type + '</td> \
               <td>' + Math.abs(json.transactionList[i]['amount']) + '</td> \
               <td>' + (json.transactionList[i]['fee']?json.transactionList[i]['fee']:'') + '</td> \
               <td>' + json.transactionList[i]['confirmations'] + '</td> \
               <td><a href="' + blockchain_tx_url.replace("%s", json.transactionList[i]['txid']) + '" target="_blank">Info</a></td> \
            </tr>');
	}
}
</script>
