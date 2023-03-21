<?php
include "inc/database.php";
include "function/function.php";
?>
<div class="container">
    <div class="nav">
        <table>
            <tr>
                <td><a href="index.php">الرئيسية</a></td>
                <td><a href="about.html">عن الموقع</a></td>
                <td style="border: 1px solid #555">
                    <?php
                    if (!isset($_SESSION['fullname'])) { ?>
                        <a href="login.php">تسجيل الدخول</a>
                    <?php } else { ?>
                        <a href="logout.php">تسجيل الخروج</a>
                    <?php } ?>
                </td>
                <td style="border: 1px solid #555" class="<?= $_SESSION['type'] != 1 ?  'admin' :  '' ?>">
                    <a href=" sinup.php">تسجيل جديد</a>
                </td>
                <td style="border: 1px solid #555; " class="<?= $_SESSION['type'] != 1 ?  'admin' :  '' ?>">
                    <a href=" subject.php"> اضافة مادة</a>
                </td>
                <td style="border: 1px solid #555;  " class="<?= $_SESSION['type'] != 1 ?  'admin' :  '' ?>">
                    <a href=" section.php"> اضافة قسم</a>
                </td>
            </tr>
        </table>
    </div>
</div>