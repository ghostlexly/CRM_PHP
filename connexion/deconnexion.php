<?php
setcookie('AdminRSA', "0", time() + 24*3600, '/', null, false, true);
header('Location: login.php');
?>