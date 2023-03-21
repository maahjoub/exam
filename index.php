<?php
include_once "inc/database.php";
include_once "inc/header.php";
include_once "inc/navbar.php";
include_once "function/function.php";
$stdNum = first($coon, "stdnum", $_SESSION['userID'], "std_id");

?>

<div class="container">
    <div class="top-header">
        <div class="info"> <span><?= isset($_SESSION['fullname']) ? '  مرحبا  : ' . $_SESSION['fullname'] : '' ?></span></div>
        <div class="info"><span><?= isset($_SESSION['fullname']) ? ' رقمك الجامعي هو   : ' . $stdNum['std_num'] : '' ?></span></div>
        <div class="info"></div>
    </div>
</div>

<?php
include_once "inc/footer.php";
?>