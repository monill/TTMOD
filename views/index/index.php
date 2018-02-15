
Index page

<?php
use App\Models\PrivilegedUser;
use App\Models\Role;
use App\Libs\Helper;
?>

<br /><br />
<a href="<?= url("/login"); ?>"> Login </a>
<br /><br />
<a href="<?= url("/signup");  ?>"> Signup </a>
<br /><br />
<a href="<?= url("/home");  ?>"> Home </a>
<br /><br />



<?php

echo strtotime(date("Y-m-d H:i:s")) - (3600 * 24);
echo "<br />";
echo date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")) - 7200 * 24);
echo "<br />";
echo "<br />";

echo Helper::plus7Days();


?>

<?php $u = PrivilegedUser::getByUsername("Bot"); ?>
<br /><br />
<?php
if ($u->hasPrivilege("viewtorrents")) {
    echo "viewtorrents";
}
?>
