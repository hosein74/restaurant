<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 5/31/2018
 * Time: 4:42 PM
 */

require_once 'function.php';
require_once 'model/request.php';
require_once getLang();

if (isset($_POST['count']) )
{
    setRequest($_POST['count']);
    setcookie("card", "", time() - 3600);
    header("location:request.php")
    ?>
<?php
}
else
redirect("login.php");

