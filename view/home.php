<?php if (!defined("IN_WALLET")) { die("Auth Error"); } ?>
                <h1>Welcome to <?=$fullname?> wallet!</h1>
                <?php
                if (!empty($error))
                {
                    echo "<p style='font-weight: bold; color: red;'>" . $error['message']; "</p>";
                }
                ?>
                <p>Log in...</p>
                <form action="index.php" method="POST" class="clearfix">
                    <input type="hidden" name="action" value="login" />
                    <div class="col-md-2"><input type="text" class="form-control" name="username" placeholder="Username"></div>
                    <div class="col-md-2"><input type="password" class="form-control" name="password" placeholder="Password"></div>
<div class="col-md-2"><input type "text" class="form-control" name="auth" placeholder="2factor Auth Code"></div>
                    <div class="col-md-2"><button type="submit" class="btn btn-default">Log in</button></div>
                </form>
                <br />
                <p>...or create a new account:</p>
                <form action="index.php" method="POST" class="clearfix">
                    <input type="hidden" name="action" value="register" />
                    <div class="col-md-2"><input type="text" class="form-control" name="username" placeholder="Username"></div>
                    <div class="col-md-2"><input type="password" class="form-control" name="password" placeholder="Password"></div>
                    <div class="col-md-2"><input type="password" class="form-control" name="confirmPassword" placeholder="Confirm password"></div>
                    <div class="col-md-2"><button type="submit" class="btn btn-default">Sign up</button></div>
                </form>
