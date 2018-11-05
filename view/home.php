<?php if (!defined("IN_WALLET")) { die("Auth Error"); } ?>
<div class="login-page">
    <div class="page-header clear-filter" filter-color="green">
      <div class="page-header-image" data-parallax="true" style="background-image:url('../assets/img/bg5.jpg');">
      </div>
      <div class="container" style="height:100vh;">
                <h1><?php echo $lang['PAGE_HEADER']; ?></h1>
                <?php
                if (!empty($error))
                {
                    echo "<p style='font-weight: bold; color: red;'>" . $error['message']; "</p>";
                }
                ?>
	<div class="modal fade modal-mini modal-primary" id="captchaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header justify-content-center">
					<div class="modal-profile">
						<i class="now-ui-icons users_circle-08"></i>
					</div>
				</div>
				<div class="modal-body">
					<p>You need to solve captcha!</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link btn-neutral" data-dismiss="modal">Back</button>
					<button type="button" class="btn btn-link btn-neutral" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

       <div class="card col-md-8">
	<div class="card-header">
		<ul class="nav nav-tabs justify-content-center" role="tablist">
		  <li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#login" role="tab">
				<i class="now-ui-icons ui-1_lock-circle-open"></i>
				<?php echo $lang['FORM_LOGIN']; ?>
			</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#signup" role="tab">
				<i class="now-ui-icons objects_key-25"></i>
				<?php echo $lang['FORM_CREATE']; ?>
			</a>
		  </li>
		</ul>
	</div>
	<div class="card-login card-plain card-body">
		<!-- Tab panes -->
		<div class="tab-content text-center">
			<div class="tab-pane active" id="login" role="tabpanel">
				<form action="index.php" method="POST" class="clearfix">
				    <input type="hidden" name="action" value="login" />
				   <div class="row text-center">
				    <div class="input-group no-border input-lg">
					<div class="input-group-prepend">
					  <span class="input-group-text">
					    <i class="now-ui-icons users_circle-08"></i>
					  </span>
					</div>
					<input type="text" class="form-control" name="username" placeholder="<?php echo $lang['FORM_USER']; ?>"></div>
				    <div class="input-group no-border input-lg">
					<div class="input-group-prepend">
					  <span class="input-group-text">
					    <i class="now-ui-icons text_caps-small"></i>
					  </span>
					</div>
					<input type="password" class="form-control" name="password" placeholder="<?php echo $lang['FORM_PASS']; ?>"></div>
				    <div class="input-group no-border input-lg">
					<div class="input-group-prepend">
					  <span class="input-group-text">
					    <i class="now-ui-icons tech_mobile"></i>
					  </span>
					</div>
					<input type="text" class="form-control" name="auth" placeholder="<?php echo $lang['FORM_2FA']; ?>"></div>
				   </div>
				   <div class="row">
					<div class="col-md-9 text-center">
					<div class="g-recaptcha" style="width: 304px; margin: 0 auto;" data-theme="dark" data-sitekey="6LdAUnIUAAAAAIOylmQeQkZUbec1B75sYJo8veKo"></div>
					</div>
					<div class="col-md-3"><button type="submit" class="btn btn-default"><?php echo $lang['FORM_LOGIN']; ?></button></div>
				   </div>
				</form>
			</div>
			<div class="tab-pane" id="signup" role="tabpanel">
				<form action="index.php" method="POST" class="clearfix">
				    <input type="hidden" name="action" value="register" />
				   <div class="row text-center">
				    <div class="input-group no-border input-lg">
					<div class="input-group-prepend">
					  <span class="input-group-text">
					    <i class="now-ui-icons users_circle-08"></i>
					  </span>
					</div>
<input type="text" class="form-control" name="username" placeholder="<?php echo $lang['FORM_USER']; ?> (Email makes recover possible)"></div>
				    <div class="input-group no-border input-lg">
					<div class="input-group-prepend">
					  <span class="input-group-text">
					    <i class="now-ui-icons text_caps-small"></i>
					  </span>
					</div>
<input type="password" class="form-control" name="password" placeholder="<?php echo $lang['FORM_PASS']; ?>"></div>
				    <div class="input-group no-border input-lg">
					<div class="input-group-prepend">
					  <span class="input-group-text">
					    <i class="now-ui-icons text_caps-small"></i>
					  </span>
					</div>
<input type="password" class="form-control" name="confirmPassword" placeholder="<?php echo $lang['FORM_PASSCONF']; ?>"></div>
				</div>
				<div class="row">
					<div class="col-md-9 text-center">
					<div class="g-recaptcha" style="width: 304px; margin: 0 auto;" data-theme="dark" data-sitekey="6LdAUnIUAAAAAIOylmQeQkZUbec1B75sYJo8veKo"></div>
					</div>
					<div class="col-md-3"><button type="submit" class="btn btn-default"><?php echo $lang['FORM_SIGNUP']; ?></button></div>
				</div>
				</form>
			</div>
		</div>
	</div>
       </div>
      </div>
    </div>
</div>
    <!--recaptcha-->
    <script src='https://www.google.com/recaptcha/api.js'></script>
