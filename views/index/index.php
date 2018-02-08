
Index page

<br /><br />
<a href="<?= url("/login"); ?>"> Login </a>
<br /><br />


<a href="<?= url("/signup");  ?>"> Signup </a>
<br /><br />

<?php

echo strtotime(date("Y-m-d H:i:s")) - (3600 * 24);
echo "<br />";

echo date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")) - 3600 * 24);

$cookieParams = session_get_cookie_params();

echo var_dump($cookieParams);

?>
