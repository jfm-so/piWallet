<?php if (!defined("IN_WALLET")) { die("Auth Error!"); } ?>
<?php
if (!empty($error))
{
    echo "<p style='font-weight: bold; color: red;'>" . $error['message']; "</p>";
}
if (!empty($msg))
{
    echo "<p style='font-weight: bold; color: green;'>" . $msg['message']; "</p>";
}
?>
<a href="?" class="btn btn-default">Go back to wallet</a>
<br /><br />
<p>List of all users:</p>
<table class="table table-bordered table-striped" id="userlist">
<thead>
   <tr>
      <td nowrap>Username</td>
      <td nowrap>Created</td>
      <td nowrap>Is admin?</td>
      <td nowrap>Is locked?</td>
      <td nowrap>IP</td>
      <td nowrap>Info</td>
      <td nowrap>Delete</td>
   </tr>
</thead>
<tbody>
   <?php
   foreach($userList as $user) {
      echo '<tr>
               <td>' . $user['username'] . '</td>
               <td>' . $user['date'] . '</td>
               <td>' . ($user['admin'] ? '<strong>Yes</strong> <a href="?a=home&m=deadmin&i=' . $user['id'] . '">De-admin</a>' : 'No <a href="?a=home&m=admin&i=' . $user['id'] . '">Make admin</a>') . '</td>
               <td>' . ($user['locked'] ? '<strong>Yes</strong> <a href="?a=home&m=unlock&i=' . $user['id'] . '">Unlock</a>' : 'No <a href="?a=home&m=lock&i=' . $user['id'] . '">Lock</a>') . '</td>
               <td>' . $user['ip'] . '</td>
               <td>' . '<a href="?a=info&i=' . $user['id'] . '">Info</a>' . '</td>
                       <td>' . '<a href="?a=home&m=del&i=' . $user['id'] . '" onclick="return confirm(\'Are you sure you really want to delete user ' . $user['username'] . ' (id=' . $user['id'] . ')?\');">Delete</a>' . '</td>
            </tr>';
   }
   ?>
   </tbody>
</table>
