<?php if (!defined("IN_WALLET")) { die("Auth Error!"); } ?>
    <div class="page-header clear-filter" filter-color="green">
      <div class="page-header-image" data-parallax="true" style="background-image:url('../assets/img/bg5.jpg');">
      </div>
      <div class="container">
        <div class="photo-container">
          <img src="../assets/img/planet_400px.png" alt="">
        </div>
        <h3 style="margin-top:10px;"><?php echo $lang['WALLET_HELLO']; ?>, <strong><?php echo $user_session; ?></strong>!</h3>
<?php
if (!empty($error))
{
    echo "<p class='category' style='font-weight: bold; color: red;'>" . $error['message']; "</p>";
}
?>
        <?php if ($admin) {?><p class="category"><strong><font color="red">[Admin]</font></strong></p><?php }?>
        <div class="content">
          <div class="social-description">
            <h4 style="margin-top:0;"><?php echo $lang['WALLET_BALANCE']; ?></h4>
            <h3 id="balance"><span class="badge badge-default"><?php echo satoshitize($balance); ?></span> <strong><?=$short?></strong></h3>
          </div>
        </div>
      </div>
    </div>
    <div class="section" style="background:none;margin-bottom:-70px;">
      <div class="container">
        <div class="button-container">
	<form style="display:inline;" action="index.php" method="POST">
        <input type="hidden" name="action" value="logout" />
        <button type="submit" class="btn btn-primary btn-round btn-lg"><i class="now-ui-icons sport_user-run" style="font-size: 1.325rem;margin-right:8px;"></i><?php echo $lang['WALLET_LOGOUT']; ?></button>
	</form>
        <button type="submit" class="btn btn-default btn-round btn-lg btn-icon" rel="tooltip" title="Settings" data-placement="top" data-toggle="modal" data-target="#settings"><i class="now-ui-icons ui-1_settings-gear-63"></i></button>
        <button type="submit" class="btn btn-primary btn-round btn-lg" data-toggle="modal" data-target="#send"><i class="now-ui-icons ui-1_send" style="font-size: 1.325rem;margin-right:8px;"></i><?php echo $lang['WALLET_SENDCONF']; ?></button>
        </div>
      </div>
    </div>
    <div class="section" style="padding-top:20px;">
      <div class="container">

<form action="index.php" method="POST">

<?php
if ($admin)
{
  ?>
<p><strong>Admin Links:</strong></p>
  <a href="?a=home" class="btn btn-default">Admin Dashboard</a>

<p><strong><?php echo $lang['WALLET_USERLINKS']; ?></strong></p>
  <?php
}
?>

	<div class="modal fade" id="settings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header justify-content-center">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<i class="now-ui-icons ui-1_simple-remove"></i>
					</button>
					<h4 class="title title-up">Settings</h4>
				</div>
				<div class="modal-body">
					<div class="row">
					<div class="col-xs-6" style="width:49%;text-align:center;">
					<form action="index.php" style="display:inline;" method="POST">
					<input type="hidden" name="action" value="authgen" />
					<button type="submit" class="btn btn-default"><?php echo $lang['WALLET_2FAON']; ?></button>
					</form>
					</div>
					<div class="col-xs-6" style="width:49%;text-align:center;">
					<form action="index.php" style="display:inline;" method="post">
					<input type="hidden" name="action" value="disauth" />
					<button type="submit" class="btn btn-default"><?php echo $lang['WALLET_2FAOFF']; ?></button>
					</form>
					</div>
					</div>

					<div class="col-md-12">
					<strong><?php echo $lang['WALLET_PASSUPDATE']; ?></strong>
					<form action="index.php" method="POST" class="clearfix" id="pwdform">
					    <input type="hidden" name="action" value="password" />
					    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
					    <input type="password" class="form-control" name="oldpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATEOLD']; ?>">
					    <input type="password" class="form-control" name="newpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATENEW']; ?>">
					    <input type="password" class="form-control" name="confirmpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATENEWCONF']; ?>">
					    <button type="submit" class="btn btn-default"><?php echo $lang['WALLET_PASSUPDATECONF']; ?></button>
					</form>
					<p id="pwdmsg"></p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

<form action="index.php" method="POST">
<input type="hidden" name="action" value="support" action="index.php"/>
<button type="submit" class="btn btn-default"><?php echo $lang['WALLET_SUPPORT']; ?></button>
</form>
<p style="font-size:1em;"><?php echo $lang['WALLET_SUPPORTNOTE']; ?></p>

	<div class="modal fade" id="send" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header justify-content-center">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<i class="now-ui-icons ui-1_simple-remove"></i>
					</button>
					<h4 class="title title-up"><?php echo $lang['WALLET_SEND']; ?></h4>
				</div>
				<div class="modal-body">
<form action="index.php" method="POST" class="clearfix" id="withdrawform">
    <input type="hidden" name="action" value="withdraw" />
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
    <input type="text" class="form-control" name="address" placeholder="<?php echo $lang['WALLET_ADDRESS']; ?>">
    <input type="text" class="form-control" name="amount" placeholder="<?php echo $lang['WALLET_AMOUNT']; ?>">
<div class="row">
    <div class="col-xs-6" style="margin:0 auto;"><button type="button" class="btn btn-default" id="donate">Donate <?=$fullname?> wallet's dev!</button></div>
    <div class="col-xs-6" style="margin:0 auto;"><button type="submit" class="btn btn-primary"><?php echo $lang['WALLET_SENDCONF']; ?></button></div>
</div>
<p id="donateinfo" style="display: none;">Type the amount you want to donate and click <strong>Send</strong></p>
</form>
<p id="withdrawmsg"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

            <p class="title text-center" id="newaddressmsg"></p>
<table class="table table-bordered table-striped" id="alist">
<thead>
<tr>
<td style="padding:0;">
<div class="container">
	<div class="row">
		<div class="col-xs-6" style="margin:auto 0 auto 50px;">
		<?php echo $lang['WALLET_ADDRESS']; ?>: 
		</div>
		<div class="col-xs-6" style="margin:auto 0 auto 25px;">
			<form action="index.php" method="POST" id="newaddressform">
				<input type="hidden" name="action" value="new_address" />
				<button type="submit" class="btn btn-default"><?php echo $lang['WALLET_NEWADDRESS']; ?></button>
			</form>
		</div>
	</div>
</div>
</td>
<td><?php echo $lang['WALLET_QRCODE']; ?>:</td>
</tr>
</thead>
<tbody>
<?php
foreach ($addressList as $address)
{
echo "<tr><td>".$address."</td>";?>
<td style="padding:0;">
	<div class="modal fade" id="<?php echo $address;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header justify-content-center">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<i class="now-ui-icons ui-1_simple-remove"></i>
					</button>
					<h4 class="title title-up">Your QR address</h4>
				</div>
				<div class="modal-body">
					<p style="text-align:center;">
					<img src="<?php echo $server_url;?>qrgen/?address=<?php echo $address;?>" />
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<button class="btn" style="padding:0;margin:0;" data-toggle="modal" data-target="#<?php echo $address;?>">
<img src="<?php echo $server_url;?>qrgen/?address=<?php echo $address;?>" alt="QR Code" style="width:42px;height:42px;border:0;">
</button>
  </td></tr>
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
      <td nowrap class="d-none d-lg-block"><?php echo $lang['WALLET_ADDRESS']; ?></td>
      <td nowrap><?php echo $lang['WALLET_TYPE']; ?>/<?php echo $lang['WALLET_AMOUNT']; ?></td>
      <td nowrap><?php echo $lang['WALLET_FEE']; ?></td>
      <td nowrap><?php echo $lang['WALLET_CONFS']; ?></td>
      <td nowrap><?php echo $lang['WALLET_INFO']; ?></td>
   </tr>
</thead>
<tbody>
   <?php
   $bold_txxs = "";
   foreach($transactionList as $transaction) {
      if($transaction['category']=="send") { $tx_type = 'OUT: <span class="badge badge-danger">'; } else { $tx_type = 'IN: <span class="badge badge-success">'; }
      echo '<tr>
               <td>'.date('n/j/Y h:i a',$transaction['time']).'</td>
               <td class="d-none d-lg-block">'.$transaction['address'].'</td>
               <td>'.$tx_type, abs($transaction['amount']) . '</span></td>
               <td>'.$transaction['fee'].'</td>
               <td>'.$transaction['confirmations'].'</td>
               <td><a href="' . $blockchain_tx_url,  $transaction['txid'] . '" target="_blank">Info</a></td>
            </tr>';
   }
   ?>
   </tbody>
</table>
      </div><!--container-->
    </div><!--section-->
<script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
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
	$("#balance span").remove();
	$("#balance").prepend('<span class="badge badge-default">' + json.balance.toFixed(8) + '</span>');
	$("#alist tbody tr").remove();
	for (var i = json.addressList.length - 1; i >= 0; i--) {
		$("#alist tbody").prepend("<tr><td>" + json.addressList[i] + '</td><td style="padding:0;"> \
	<div class="modal fade" id="' + json.addressList[i] + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true"> \
		<div class="modal-dialog"> \
			<div class="modal-content"> \
				<div class="modal-header justify-content-center"> \
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> \
						<i class="now-ui-icons ui-1_simple-remove"></i> \
					</button> \
					<h4 class="title title-up">Your QR address</h4> \
				</div> \
				<div class="modal-body"> \
					<p style="text-align:center;"> \
					<img src="/qrgen/?address=' + json.addressList[i] + '" /> \
					</p> \
				</div> \
				<div class="modal-footer"> \
					<button type="button" class="btn btn-default" data-dismiss="modal">Back</button> \
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> \
				</div> \
			</div> \
		</div> \
	</div> \
<button class="btn" style="padding:0;margin:0;" data-toggle="modal" data-target="#' + json.addressList[i] + '"> \
<img src="/qrgen/?address=' + json.addressList[i] + '" alt="QR Code" style="width:42px;height:42px;border:0;"> \
</button> \
  </td></tr>');
	}
	$("#txlist tbody tr").remove();
	for (var i = json.transactionList.length - 1; i >= 0; i--) {
		var tx_type = 'IN: <span class="badge badge-success">';
		if(json.transactionList[i]['category']=="send")
		{
			tx_type = 'OUT: <span class="badge badge-danger">';
		}
		$("#txlist tbody").prepend('<tr> \
               <td>' + moment(json.transactionList[i]['time'], "X").format('l hh:mm a') + '</td> \
               <td class="d-none d-lg-block">' + json.transactionList[i]['address'] + '</td> \
               <td>' + tx_type + Math.abs(json.transactionList[i]['amount']) + '</span></td> \
               <td>' + (json.transactionList[i]['fee']?json.transactionList[i]['fee']:'') + '</td> \
               <td>' + json.transactionList[i]['confirmations'] + '</td> \
               <td><a href="' + blockchain_tx_url.replace("%s", json.transactionList[i]['txid']) + '" target="_blank">Info</a></td> \
            </tr>');
	}
}
</script>
