<?php if (!defined("IN_WALLET")) { die("Auth Error"); } ?>
                <h1><?php echo $lang['PAGE_HEADER']; ?></h1>
                <?php
                if (!empty($error))
                {
                    echo "<p style='font-weight: bold; color: red;'>" . $error['message']; "</p>";
                }
                ?>
                <p><?php echo $lang['FORM_LOGIN']; ?></p>
                <form action="index.php" method="POST" class="clearfix">
                    <input type="hidden" name="action" value="login" />
                    <div class="col-md-2"><input type="text" class="form-control" name="username" placeholder="<?php echo $lang['FORM_USER']; ?>"></div>
                    <div class="col-md-2"><input type="password" class="form-control" name="password" placeholder="<?php echo $lang['FORM_PASS']; ?>"></div>
<div class="col-md-2"><input type "text" class="form-control" name="auth" placeholder="<?php echo $lang['FORM_2FA']; ?>"></div>
                    <div class="col-md-2"><button type="submit" class="btn btn-default"><?php echo $lang['FORM_LOGIN']; ?></button></div>
                </form>
                <br />
                <p><?php echo $lang['FORM_CREATE']; ?></p>
                <form action="index.php" method="POST" class="clearfix">
                    <input type="hidden" name="action" value="register" />
                    <div class="col-md-2"><input type="text" class="form-control" name="username" placeholder="<?php echo $lang['FORM_USER']; ?>"></div>
                    <div class="col-md-2"><input type="password" class="form-control" name="password" placeholder="<?php echo $lang['FORM_PASS']; ?>"></div>
                    <div class="col-md-2"><input type="password" class="form-control" name="confirmPassword" placeholder="<?php echo $lang['FORM_PASSCONF']; ?>"></div>
                    <div class="col-md-2"><button type="submit" class="btn btn-default"><?php echo $lang['FORM_SIGNUP']; ?></button></div>
                </form>
